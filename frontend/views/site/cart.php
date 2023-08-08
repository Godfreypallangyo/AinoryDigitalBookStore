<?php
$this->title = 'My Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cart">
<div class="container">
    <h1>Shopping Cart</h1>
    <?php if (empty($cartItems)) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item) : ?>
                    <tr>
                        <td><?= Html::encode($item['name']); ?></td>
                        <td><?= $item['price']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</div>

