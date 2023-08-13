<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\Clients;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\OrderedBook;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider;

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
        $dataProvider=new ActiveDataProvider([
            'query'=>Book::findBySql("select * from book order by book_isbn limit 3")
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
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
        $dataProvider=new ActiveDataProvider([
            'query'=>Book::findBySql("select * from book")
        ]);
        return $this->render('books',['dataProvider'=>$dataProvider]);
    }

    public function actionCart()
    {
        $cartItems = Yii::$app->session->get('cartItems', []);
    
        return $this->render('cart', [
            'cartItems' => $cartItems,
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
            $cartItems = Yii::$app->session->get('cartItems', []);
            $cartItems[] = $book;
            Yii::$app->session->set('cartItems', $cartItems);
        }
        
        return $this->redirect(Yii::$app->request->referrer ?: ['index']); // Redirect to previous page
    }
    
    public function actionRemoveItem($book_isbn)
    {
        if (Yii::$app->session->has('cartItems')) {
            $cartItems = Yii::$app->session->get('cartItems');
    
            // Find the item in the cart and remove it
            $updatedCartItems = array_filter($cartItems, function ($item) use ($book_isbn) {
                return $item['book_isbn'] !== $book_isbn;
            });
    
            // Save the updated cart items to the session
            Yii::$app->session->set('cartItems', $updatedCartItems);
        }
    
        return $this->redirect(['site/cart']); // Redirect back to the cart page
    }
     
    public function actionPayments(){
        return $this->render('payments');
    }
     /**
     * Logs out the current user.
     *
     * @return mixed
     */

     public function actionCheckout()
     {
         $model = new Clients();
         $cartItems = Yii::$app->session->get('cartItems', []);
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Save the client information in the session
            Yii::$app->session->set('clientInfo', $model->id);
         }
    
         if ($this->request->isPost) {
             if ($model->load($this->request->post()) && $model->validate()) {
                 $transaction = Yii::$app->db->beginTransaction();
                 try {
                     if ($model->save()) {
                         $cartItems = Yii::$app->session->get('cartItems', []);
     
                         foreach ($cartItems as $item) {
                             $orderedBook = new OrderedBook();
                             $orderedBook->book_title = $item['book_title'];
                             $orderedBook->book_isbn = $item['book_isbn'];
                             $orderedBook->book_price = $item['book_price'];
                             $orderedBook->order_id = $model->id; // Assuming the 'id' is the client ID
                             if (!$orderedBook->save()) {
                                 Yii::error($orderedBook->getErrors(), 'ordered-book-save');
                             }
                         }
     
                         $transaction->commit();
                         Yii::$app->session->setFlash('success', 'Data saved successfully.');
                         Yii::$app->session->remove('cartItems');
                     } else {
                         Yii::$app->session->setFlash('error', 'Error saving data.');
                         Yii::error($model->getErrors(), 'checkout-save');
                     }
                 } catch (\Exception $e) {
                     $transaction->rollBack();
                     Yii::$app->session->setFlash('error', 'An error occurred while processing your order.');
                     Yii::error($e->getMessage(), 'checkout-exception');
                 }
             } else {
                 Yii::$app->session->setFlash('error', 'Validation failed.');
                 Yii::error($model->getErrors(), 'checkout-validation');
             }
         }
         
         return $this->render('checkout', [
             'model' => $model,
             'cartItems'=>$cartItems
            
         ]);
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
