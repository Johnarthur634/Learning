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
<div class="terms-container">
    <h1>Privacy Policy</h1>
    <h3>1. Information We Collect</h3>
    <p>For our e-commerce operations, we collect personal information you provide directly to us when you make a purchase or register for an account. This information includes, but is not limited to, your name, email address, physical address, phone number, and payment details.</p>

    <h3>2. How We Use Your Information</h3>
    <p>We use the information we collect to fulfill your orders, process payments, and provide customer support. We may also use your information to communicate with you about your account, transactions, and promotional offers. We will not share your personal information with third parties for their marketing purposes without your explicit consent.</p>

    <h3>3. Data Security</h3>
    <p>We are committed to protecting your personal information. We use a variety of security technologies and procedures to help protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is 100% secure.</p>

    <h3>4. Third-Party Services</h3>
    <p>We may use third-party services to process payments and handle shipping. These third parties have their own privacy policies, and we encourage you to read them to understand how they will handle your personal information.</p>

    <h3>5. Cookies</h3>
    <p>Our website uses "cookies" to enhance your browsing experience. Cookies are small data files stored on your device that help us improve our site and your experience. You can choose to disable cookies in your browser settings, but this may affect the functionality of the website.</p>

    <h3>6. Your Consent</h3>
    <p>By using our site and providing your information, you consent to this Privacy Policy. If you do not agree with this policy, please do not use our website.</p>

    <h3>7. Changes to This Policy</h3>
    <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page. We advise you to review this policy periodically for any changes.</p>
  
    <div class="button-group">
        <button type="button" onclick="cancelForm()">Cancel</button>
    </div>
</div>

<script>

    function cancelForm() {
    window.location.href = "index.php";
}

</script>