<?php
include('header.php');
?>


<!-- Container -->
<div class="container my-5 ">

<div class="bg-white p-6 rounded-2 mb-6">
<h3 class=" text-dark fw-bold">Need Assistance? We're Here to Help!</h3>
<p class=" text-muted mb-5">
    Our support team is here to assist you with any questions or issues you may have. 
    Whether it's tracking your order, updating delivery details, or resolving any delivery concerns, 
    we're committed to providing a seamless experience. Don't hesitate to reach out to us anytime!
</p>
</div>

    <!-- Grid Container for Support Cards -->
    <div class="row g-4">
        
        <!-- Card 1 - Order Tracking -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-trailer" style="color: #696cff; font-size: 60px;" class="mb-3 d-block"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Order Tracking</h5>
                    <p class="card-text text-muted">Track your shipment in real-time using your <strong>Tracking ID</strong>.</p>
                </div>
            </div>
        </div>

        <!-- Card 2 - Placing an Order -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-cart-plus" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Placing an Order</h5>
                    <p class="card-text text-muted">Refer to our guide or contact support to place an order effortlessly.</p>
                </div>
            </div>
        </div>

    
        <!-- Card 5 - Delivery Problems -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-truck" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Delivery Problems</h5>
                    <p class="card-text text-muted">Facing delivery issues? We're here to resolve them quickly.</p>
                </div>
            </div>
        </div>

        <!-- Card 6 - Contact Support -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-headset" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Contact Support</h5>
                    <p class="card-text text-muted">
                        📞 <a href="tel:+123456789" class="text-muted text-decoration-none">+1-234-567-89</a>
                    </p>
                    <p class="card-text text-muted">
                        ✉️ <a href="mailto:support@yourdomain.com" class="text-muted text-decoration-none">support@yourdomain.com</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Card 8 - Shipping Options -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-shipping-fast" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Shipping Options</h5>
                    <p class="card-text text-muted">Explore various shipping options available for your orders.</p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include("footer.php") ?>
