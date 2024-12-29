<?php
// Include your database connection if needed
include('header.php');
?>

<!-- Container -->
<div class="container my-5 ">

<div class="bg-white p-6 rounded-2 mb-6">
<h3 class=" text-dark fw-bold">Need Assistance? We're Here to Help!</h3>
<p class=" text-muted mb-5">
    Our support team is here to assist you with any questions or issues you may have. 
    Whether it's managing agents, troubleshooting, or updating branch details, 
    we're committed to providing a seamless experience. Don't hesitate to reach out to us anytime!
</p>
</div>

    <!-- Grid Container for Support Cards -->
    <div class="row g-4">
        
        <!-- Card 2 - Troubleshooting Issues -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-tools" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Troubleshooting Issues</h5>
                    <p class="card-text text-muted">Experiencing issues? Our support team is ready to help you diagnose and resolve them quickly.</p>
                </div>
            </div>
        </div>


        <!-- Card 4 - Delivery Issues -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-truck" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Delivery Issues</h5>
                    <p class="card-text text-muted">Facing delivery problems? We can help resolve them swiftly.</p>
                </div>
            </div>
        </div>

    

        <!-- Card 6 - System Updates -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-sync-alt" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">System Updates</h5>
                    <p class="card-text text-muted">Stay updated with the latest system changes and improvements. We provide easy-to-understand guides on new features.</p>
                </div>
            </div>
        </div>

        <!-- Card 7 - Account Management -->
        <div class="col-md-4">
            <div class="card rounded-3 shadow-sm h-100">
                <div class="p-4 text-center">
                    <i class="fas fa-id-card" style="color: #696cff; font-size: 60px;"></i>
                    <h5 class="card-title mt-2 text-dark fw-bold">Account Management</h5>
                    <p class="card-text text-muted">Need help with managing your account settings? We're here to assist you with account-related issues.</p>
                </div>
            </div>
        </div>

        <!-- Card 8 - Contact Support -->
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

    </div>

</div>

<?php include("footer.php") ?>