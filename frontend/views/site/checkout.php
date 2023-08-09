<?php
use yii\helpers\Html;

$this->title = 'CheckOut';
?>
<div class="container py-5>
        <h1 class="mb-4">Checkout</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Purchaser Information</h4>
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                            <!-- Add more fields as needed: city, state, postal code, etc. -->
                            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Order Summary</h4>
                        <ul class="list-group">
                            <!-- Display cart items and their prices -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Book Title 1
                                <span class="badge bg-secondary">$19.99</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Book Title 2
                                <span class="badge bg-secondary">$24.99</span>
                            </li>
                            <!-- Calculate and display total price -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total
                                <span class="badge bg-primary">$44.98</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>