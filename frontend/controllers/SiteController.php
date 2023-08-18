<?php

namespace frontend\controllers;

use Codeception\Command\Console;
use common\models\Book;
use common\models\Cart;
use common\models\Clients;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\OrderedBook;
use common\models\Orders;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::findBySql("select * from book order by book_isbn limit 3")
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionBooks()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::findBySql("select * from book")
        ]);
        return $this->render('books', ['dataProvider' => $dataProvider]);
    }

    public function actionCart()
    {
        if (Yii::$app->user->isGuest) {
            // User is a guest, use session cart data
            $cartItems = Yii::$app->session->get('cartItems', []);
        } else {
            // User is logged in, fetch cart data from the database
            $user = Yii::$app->user->identity;
            $cartItems = Cart::find()->where(['user_id' => $user->id])->with('bookIsbn')->all();
        }

        return $this->render('cart', [
            'cartItems' => $cartItems,
        ]);
    }
    /**
     * Displays profile page.
     *
     * @return mixed
     */
    public function actionProfile()
    {
        $user_id = Yii::$app->user->id;
        $profile = User::findOne($user_id);

        if (!$profile) {
            // User profile not found, handle the case as needed (optional)
            Yii::$app->session->setFlash('error', 'User profile not found.');
            return $this->redirect(['site/index']); // Redirect to some appropriate page
        }

        if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated successfully.');
            return $this->refresh();
        }

        return $this->render('profile', [
            'profile' => $profile,
        ]);
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionAddToCart($book_isbn)
    {
        $book = Book::findOne(['book_isbn' => $book_isbn]);

        if ($book) {
            if (!Yii::$app->user->isGuest) {
                $userId = Yii::$app->user->id;
                $cartItem = new Cart(['user_id' => $userId, 'book_isbn' => $book_isbn]);
                $cartItem->save();
            } else {
                $cartItems = Yii::$app->session->get('cartItems', []);
                $cartItems[] = $book;
                Yii::$app->session->set('cartItems', $cartItems);
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    public function actionRemoveItem($book_isbn)
    {
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
            $cartItem = Cart::findOne(['user_id' => $userId, 'book_isbn' => $book_isbn]);
            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            if (Yii::$app->session->has('cartItems')) {
                $cartItems = Yii::$app->session->get('cartItems');
                $updatedCartItems = array_filter($cartItems, function ($item) use ($book_isbn) {
                    return $item['book_isbn'] !== $book_isbn;
                });
                Yii::$app->session->set('cartItems', $updatedCartItems);
            }
        }

        return $this->redirect(['site/cart']); // Redirect back to the cart page
    }

    public function actionPayments()
    {
        return $this->render('payments');
    }

    public function actionCheckout()
    {
        $model = new Clients();
        $cartItems = Yii::$app->session->get('cartItems', []);
        $totalAmount = 0;
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
            $cartItems = Cart::find()->where(['user_id' => $userId])->all();
        } else {
            $cartItems = Yii::$app->session->get('cartItems', []);
        }
        if (Yii::$app->user->isGuest) {
            $totalAmount = array_reduce($cartItems, function ($total, $item) {
                return $total + $item['book_price'];
            }, 0);
        } else {
            $totalAmount = array_reduce($cartItems, function ($total, $item) {
                return $total + $item->bookIsbn->book_price;
            }, 0);
        }
        return $this->render('checkout', [
            'model' => $model,
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]);
    }
    public function actionProcessCheckout()
    {
        $model = new Clients();
        $cartItems = Yii::$app->session->get('cartItems', []);
        $totalAmount = 0;

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;
            $cartItems = Cart::find()->where(['user_id' => $userId])->all();
        } else {
            $cartItems = Yii::$app->session->get('cartItems', []);
        }

        $postData = Yii::$app->request->post();

        if ($model->load($postData) && $model->validate()) {
            // $transaction = Yii::$app->db->beginTransaction();

            try {
                if ($model->save()) {
                    $order = new Orders();
                    $order->client_id = $model->id;
                    $order->order_number = 'ORDER' . date('YmdHis') . mt_rand(1000, 9999);

                    // Store the client form data in session
                    Yii::$app->session->set('clientId', $model->id);
                    Yii::$app->session->set('currentOrderId', $order->order_number);

                    // Calculate total amount based on cart items
                    $totalAmount = array_reduce($cartItems, function ($total, $item) {
                        return $total + $item->bookIsbn->book_price;
                    }, 0);

                    $order->order_total = $totalAmount;
                    $order->payment_status = 0;

                    if ($order->save()) {
                        // $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Data saved successfully.');
                        Yii::$app->session->remove('cartItems');
                    } else {
                        Yii::$app->session->setFlash('error', 'Error saving order.');
                        Yii::error($order->getErrors(), 'order-save');
                        // $transaction->rollBack();
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error saving client information.');
                    Yii::error($model->getErrors(), 'client-save');
                }
            } catch (\Exception $e) {
                // $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'An error occurred while processing your order.');
                Yii::error($e->getMessage(), 'checkout-exception');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Validation failed.');
            Yii::error($model->getErrors(), 'checkout-validation');
        }

        return $this->asJson(['success' => true]);
    }

    public function actionUpdatePaymentStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $postData = Yii::$app->request->post();
        $clientID = isset($postData['clientID']) ? $postData['clientID'] : null;
        $clientFormData = isset($postData['clientFormData']) ? $postData['clientFormData'] : [];
        $paymentMethod = isset($postData['payment_method']) ? $postData['payment_method'] : null;
        $paymentStatus = isset($postData['payment_status']) ? $postData['payment_status'] : null;

        if ($clientID === null || empty($clientFormData) || $paymentMethod === null || $paymentStatus === null) {
            return ['success' => false, 'message' => 'Invalid request parameters'];
        }

        // Find the order based on the client ID
        $order = Orders::findOne(['client_id' => $clientID]);

        if (!$order) {
            return ['success' => false, 'message' => 'Order not found'];
        }

        // Update client-related fields based on $clientFormData
        // Example: Update name, address, etc.
        $order->client->attributes = $clientFormData;

        $order->payment_status = $paymentStatus;
        $order->payment_method = $paymentMethod;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($order->save() && $order->client->save()) {
                $transaction->commit();
                return ['success' => true, 'message' => 'Payment status and client information updated successfully'];
            } else {
                Yii::error($order->getErrors(), 'order-save');
                Yii::error($order->client->getErrors(), 'client-save');
                $transaction->rollBack();
                return ['success' => false, 'message' => 'Failed to update payment status and client information'];
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ['success' => false, 'message' => 'An error occurred while updating payment status and client information'];
        }
    }


    public function actionDownload($file)
    {
        $filePath = Yii::getAlias('@frontend/web/storage/' . $file);

        if (file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath)->send();
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
    }

    public function actionBookDetails($isbn)
    {
        $book = Book::findOne(['book_isbn' => $isbn]);

        if ($book === null) {
            // throw new NotFoundHttpException('Book not found.');
        }

        return $this->render('book-details', [
            'book' => $book,
        ]);
    }

    public function actionClients_form()
    {
        $model = new \common\models\Clients();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
        return $this->render('clients_form', [
            'model' => $model,
        ]);
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAuthorBio()
    {
        return $this->render('authorBio');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
