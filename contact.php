<?php include('./include/header.php'); ?>
<link rel="stylesheet" href="./assets/contact.css">

<?php
// Vérifie si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les valeurs du formulaire
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Construit le corps de l'e-mail
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Envoie l'e-mail
    $to = 'alessand1.ad@gmail.com';
    $subject = 'New contact form submission';
    $headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


    if(mail($to, $subject, $email_content, $headers)) {
        echo "Email sent successfully";
    } else {
        echo "Email sending failed";
    }
}
?>



<h1 class="text-center">Contactez-nous</h1>

<form method="post" class="text-center border border-light p-5 my_form" action="">
    <!-- Name input -->
    <div class="form-outline mb-4">
        <input type="text" id="form4Example1" class="form-control" name="name" />
        <label class="form-label" for="form4Example1">Name</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="form4Example2" class="form-control" name="email" />
        <label class="form-label" for="form4Example2">Email address</label>
    </div>

    <!-- Message input -->
    <div class="form-outline mb-4">
        <textarea class="form-control" id="form4Example3" rows="4" name="message"></textarea>
        <label class="form-label" for="form4Example3">Message</label>
    </div>

    <!-- Checkbox -->
    <div class="form-check d-flex justify-content-center mb-4">
        <input class="form-check-input me-2" type="checkbox" value="" id="form4Example4" checked />
        <label class="form-check-label" for="form4Example4">
            Send me a copy of this message
        </label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Send</button>
</form>

<?php include('./include/footer.php'); ?>