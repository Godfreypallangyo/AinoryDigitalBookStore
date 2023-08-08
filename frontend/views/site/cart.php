<?php
$this->title = 'My Cart';

?>
<div class="site-cart">
<div class="container">
<div class="row">
        <div class="col-md-12">
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
</div>
</div>

