<?php
include("header.php");
?>

<section class="page-header bg-tertiary">
	<div class="container">
		<div class="row">
			<div class="col-8 mx-auto text-center">
				<h2 class="mb-3 text-capitalize">Contact Us</h2>
				<ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
					<li class="list-inline-item"><a href="index.php">Home</a></li>
					<li class="list-inline-item">/ &nbsp; <a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="has-shapes">
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-6">
				<div class="section-title text-center">
					<p class="text-uppercase fw-bold mb-3" style="color: black;">Contact With us</p>
					<h1 style="color: #696cff;">Let&rsquo;s Get Connected</h1>
					<p>"Have questions or need assistance? Reach out to us anytime through our contact form, email, or hotline—we’re here to help 24/7!"</p>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="shadow rounded p-5 bg-white">
					<div class="row">
						<div class="col-12 mb-4">
							<h4>Leave Us A Message</h4>
						</div>
						<div class="col-lg-6">
							<div class="contact-form">
								<form method="POST" onsubmit="return validateForm()">
									<div class="form-group mb-4 pb-2">
										<label for="contact_name" class="form-label">Full Name</label>
										<input name="name" type="text" class="form-control shadow-none" id="contact_name" >
										<span id="nameError" style="color: red; display: none;">Please enter your full name.</span>
									</div>
									<div class="form-group mb-4 pb-2">
										<label for="contact_email" class="form-label">Email address</label>
										<input name="email" type="email" class="form-control shadow-none" id="contact_email" >
										<span id="emailError" style="color: red; display: none;">Please enter a valid email address.</span>
									</div>
									<div class="form-group mb-4 pb-2">
										<label for="exampleFormControlTextarea1" class="form-label">Write Message</label>
										<textarea name="message" class="form-control shadow-none" id="exampleFormControlTextarea1" rows="3" ></textarea>
										<span id="messageError" style="color: red; display: none;">Please enter your message.</span>
									</div>
									<button name="sub" class="btn w-100" style="background-color: #696cff;" type="submit">Send Message</button>
								</form>
							</div>
						</div>
						<div class="col-lg-6 mt-5 mt-lg-0">
							<div class="contact-info">
								<div class="block mt-0">
									<h4 class="h5">Still Have Questions?</h4>
									<div class="content">Call Us We Will Be Happy To Help
										<br> <a href="tel:+3301563965">+3301563965</a> 
										<br>Monday - Friday
										<br>9AM TO 8PM PK Time</div>
								</div>
								<div class="block mt-4">
									<h4 class="h5">Pakistan Office</h4>
									<div class="content">231 Street.
										<br>Nazimabad,
										<br>Karachi, Pakistan</div>
								</div>
							
								<div class="block">
									<ul class="list-unstyled list-inline my-4 social-icons">
										<li class="list-inline-item me-3"><a title="Explorer Facebook Profile" style="color: #696cff;" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
										</li>
										<li class="list-inline-item me-3"><a title="Explorer Twitter Profile" style="color: #696cff;" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
										</li>
										<li class="list-inline-item me-3"><a title="Explorer Instagram Profile" style="color: #696cff;" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
if(isset($_POST["sub"])){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$message = $_POST["message"];

	// Insert data into the database
	$insert = "INSERT INTO `contact` (`full_name`, `email`, `message`) VALUES ('$name', '$email', '$message')";
	$done = mysqli_query($connect, $insert);

	// Send email
	$to = $email; 
	$subject = "New Contact Message";
	$headers = "From: no-reply@yourdomain.com\r\n";
	$headers .= "Reply-To: no-reply@yourdomain.com\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8";

	$email_message = "
		<html>
		<head>
			<title>Contact Message</title>
		</head>
		<body>
			<p><strong>Name:</strong> $name</p>
			<p><strong>Email:</strong> $email</p>
			<p><strong>Message:</strong></p>
			<p>$message</p>
		</body>
		</html>
	";

	if (mail($to, $subject, $email_message, $headers)) {
		echo
		"<script>
			alert('Submitted Successfully! We will get back to you soon.');
			window.location.href = 'contact.php';
		</script>";
	} else {
		echo
		"<script>
			alert('Error occurred! Please try again.');
			window.location.href = 'contact.php';
		</script>";
	}
}
include("footer.php");
?>

<script>
function validateForm() {
    var name = document.getElementById("contact_name").value.trim();
    var email = document.getElementById("contact_email").value.trim();
    var message = document.getElementById("exampleFormControlTextarea1").value.trim();

    // Reset error messages
    document.getElementById("nameError").style.display = "none";
    document.getElementById("emailError").style.display = "none";
    document.getElementById("messageError").style.display = "none";

    var valid = true;

    // Validate Name
    if (name === "") {
        document.getElementById("nameError").style.display = "block";
        valid = false;
    }

    // Validate Email
    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (email === "" || !emailPattern.test(email)) {
        document.getElementById("emailError").style.display = "block";
        valid = false;
    }

    // Validate Message
    if (message === "") {
        document.getElementById("messageError").style.display = "block";
        valid = false;
    }

    return valid;
}
</script>
