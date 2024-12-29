<?php
include("header.php");
?>


<section class="section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-6">
          <div class="section-title text-center">
            <p class=" text-uppercase fw-bold mb-3" style="color: #696cff;">
              Frequent Questions
            </p>
            <h1>Frequently Asked Questions</h1>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="accordion accordion-border-bottom" id="accordionFAQ">
            <!-- General Information -->
            <div class="accordion-item">
              <h2 style="color: #696cff;">General Information:</h2>
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-shipSmart" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-shipSmart" aria-expanded="true" aria-controls="collapse-shipSmart">
                What is ShipSmart?
              </h6>
              <div id="collapse-shipSmart" class="accordion-collapse collapse border-0 show" aria-labelledby="heading-shipSmart" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  A brief introduction about your courier service, its mission, and the areas you serve.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-services" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-services" aria-expanded="false" aria-controls="collapse-services">
                What services do you offer?
              </h6>
              <div id="collapse-services" class="accordion-collapse collapse border-0" aria-labelledby="heading-services" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Detail the different services, e.g., same-day delivery, international shipping, express courier, etc.
                </div>
              </div>
            </div>

            <!-- Delivery Process -->
            <div class="accordion-item">
              <h2 style="color: #696cff;">Delivery Process:</h2>
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-placeOrder" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-placeOrder" aria-expanded="false" aria-controls="collapse-placeOrder">
                How do I place an order for delivery?
              </h6>
              <div id="collapse-placeOrder" class="accordion-collapse collapse border-0" aria-labelledby="heading-placeOrder" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Explain the process of placing an order, either online through the website or via phone.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-deliveryTime" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-deliveryTime" aria-expanded="false" aria-controls="collapse-deliveryTime">
                How long will my package take to reach its destination?
              </h6>
              <div id="collapse-deliveryTime" class="accordion-collapse collapse border-0" aria-labelledby="heading-deliveryTime" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Mention estimated delivery times, along with the factors that may affect the timing (e.g., distance, weather, holidays).
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-specificTime" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-specificTime" aria-expanded="false" aria-controls="collapse-specificTime">
                Can I choose a specific delivery time?
              </h6>
              <div id="collapse-specificTime" class="accordion-collapse collapse border-0" aria-labelledby="heading-specificTime" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Explain whether users can schedule delivery at a specific time or day, or if deliveries are made within a time window.
                </div>
              </div>
            </div>

            <!-- Tracking and Updates -->
            <div class="accordion-item">
              <h2 style="color: #696cff;">Tracking and Updates:</h2>
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-trackShipment" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-trackShipment" aria-expanded="false" aria-controls="collapse-trackShipment">
                How can I track my shipment?
              </h6>
              <div id="collapse-trackShipment" class="accordion-collapse collapse border-0" aria-labelledby="heading-trackShipment" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Provide instructions on how to use the tracking tool on your website, including what information customers need to track their packages.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-delayedPackage" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-delayedPackage" aria-expanded="false" aria-controls="collapse-delayedPackage">
                What should I do if my package is delayed?
              </h6>
              <div id="collapse-delayedPackage" class="accordion-collapse collapse border-0" aria-labelledby="heading-delayedPackage" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Let users know how they can get in touch with customer support for updates and what steps are taken for delayed shipments.
                </div>
              </div>
            </div>

            <!-- Pricing and Payments -->
            <div class="accordion-item">
              <h2 style="color: #696cff;">Pricing and Payments:</h2>
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-pricing" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-pricing" aria-expanded="false" aria-controls="collapse-pricing">
                How much does it cost to send a package?
              </h6>
              <div id="collapse-pricing" class="accordion-collapse collapse border-0" aria-labelledby="heading-pricing" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Explain how pricing works (based on weight, size, distance, etc.), and whether customers can get quotes online.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-paymentMethods" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-paymentMethods" aria-expanded="false" aria-controls="collapse-paymentMethods">
                What payment methods do you accept?
              </h6>
              <div id="collapse-paymentMethods" class="accordion-collapse collapse border-0" aria-labelledby="heading-paymentMethods" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Mention all accepted payment methods (credit card, PayPal, cash on delivery, etc.).
                </div>
              </div>
            </div>

            <!-- Customer Support -->
            <div class="accordion-item">
              <h2 style="color: #696cff;">Customer Support:</h2>
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-customerSupportContact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-customerSupportContact" aria-expanded="false" aria-controls="collapse-customerSupportContact">
                How can I contact customer support?
              </h6>
              <div id="collapse-customerSupportContact" class="accordion-collapse collapse border-0" aria-labelledby="heading-customerSupportContact" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Provide details on how users can reach customer support, including phone, email, or live chat options.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-supportHours" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-supportHours" aria-expanded="false" aria-controls="collapse-supportHours">
                What are the customer support hours?
              </h6>
              <div id="collapse-supportHours" class="accordion-collapse collapse border-0" aria-labelledby="heading-supportHours" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  Our customer support team is available from 9:00 AM to 5:00 PM, Monday to Saturday.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h6 class="accordion-header accordion-button h5 border-0" id="heading-delayedShipment" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-delayedShipment" aria-expanded="false" aria-controls="collapse-delayedShipment">
                What should I do if my shipment is delayed?
              </h6>
              <div id="collapse-delayedShipment" class="accordion-collapse collapse border-0" aria-labelledby="heading-delayedShipment" data-bs-parent="#accordionFAQ">
                <div class="accordion-body py-0 content">
                  If your shipment is delayed, please contact our support team with your tracking number. We will provide you with an update and resolve the issue promptly.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php
include("footer.php");
?>