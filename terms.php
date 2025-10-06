<?php
    // terms.php
    // This file will be fetched by JavaScript for the Terms Modal
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

    .policy-links {
    font-size: 1.1rem;
    padding: 15px 0;
}

.policy-links a {
    color: #cc0000; /* Red color for links */
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}

.policy-links a:hover {
    text-decoration: underline;
}

/* Update close button selectors to be specific for each modal */
.terms-close-btn { /* New class for Terms close button */
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.privacy-close-btn { /* New class for Privacy close button */
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

/* Ensure the existing .close-btn hover/focus still works, or update to use the new classes */
.terms-close-btn:hover, .terms-close-btn:focus,
.privacy-close-btn:hover, .privacy-close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>

<div class="terms-container" id="termsContent">
    <a href="index.php"></a>
    <h1>Terms and Conditions for E-commerce</h1>
    <h3>1. Introduction</h3>
    <p>Welcome to our website. By using our e-commerce platform and purchasing products from us, you agree to comply with and be bound by the following terms and conditions. These terms govern your use of the website and all transactions conducted through it.</p>

    <h3>2. Products and Services</h3>
    <p>All products listed on our website are subject to availability. We reserve the right to limit the quantity of products we supply; to refuse any order; or to discontinue any product at any time. All descriptions of products or product pricing are subject to change at any time without notice, at our sole discretion.</p>

    <h3>3. Order and Payment</h3>
    <p>By placing an order, you agree to pay the total amount for the products ordered, including any shipping fees and applicable taxes. We accept various forms of payment, which are specified on our website. All payments are subject to verification and authorization by the payment provider.</p>

    <h3>4. Shipping and Delivery</h3>
    <p>We will ship products to the address you provide during the checkout process. We are not responsible for delays in shipping or delivery due to circumstances beyond our control, such as carrier delays, bad weather, or customs issues.</p>

    <h3>5. Returns and Refunds</h3>
    <p>Our return policy allows for returns of products within a specified number of days from the date of purchase. To be eligible for a return, your item must be unused and in the same condition that you received it. A refund will be processed upon inspection of the returned item, minus any shipping and handling charges.</p>

    <h3>6. User Conduct</h3>
    <p>You agree not to use the website for any unlawful purpose or in any way that could damage, disable, or impair the site or interfere with any other party's use of the site.</p>

    <h3>7. Intellectual Property</h3>
    <p>All content on this site, including text, graphics, logos, images, and product designs, is our property and is protected by intellectual property laws. You may not use, reproduce, or distribute any content without our express written permission.</p>

    <h3>8. Governing Law</h3>
    <p>These terms and conditions are governed by and construed in accordance with the laws of [Your Jurisdiction], and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
    


    <div class="button-group">
        <button type="button" onclick="cancelForm()">Cancel</button>
    </div>
</div>

<script>

    function cancelForm() {
    window.location.href = "index.php";
}

</script>

