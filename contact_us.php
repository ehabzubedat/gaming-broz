<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
}
?>

    <!-- Main -->
    <main>
		<div class="container contact-us-container">
			<div class="row justify justify-content-center">
				<div class="col-11 col-md-8 col-lg-6 col-xl-5 contact-us-container">
					<form class="contact-form" id="contact-form" name="contact-form" action="php/actions/mail.php" method="POST">
						<div class="card black contact-us-card">
							<div class="row mt-0 contact-us-dom">
								<div class="col-md-12 mb-1">
									<h2 class="contact-us-title">Contact Us</h2>
									<h4 class="contact-us-subtitle">We would love to help!</h4>
									<p id="status" class="d-none"></p>
								</div>
							</div>
							<div class="form-group row mb-3">
								<div class="col-md-12 mb-0">
									<input id="name" type="text" placeholder="Full Name" name="name" 
										class="form-control input-box rm-border" required>
								</div>
							</div>
							<div class="form-group row mb-3">
								<div class="col-md-12 mb-0">
									<input id="email" type="email" placeholder="Email" name="email" 
										class="form-control input-box rm-border" required>
								</div>
							</div>
							<div class="form-group row mb-3">
								<div class="col-md-12 mb-0">
									<input id="subject" type="text" placeholder="Subject" name="subject" 
										class="form-control input-box rm-border" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 mb-2">
									<textarea id="message" placeholder="Type your message.." name="message" 
										class="form-control input-box rm-border" required></textarea>
								</div>
							</div>
							<div class="form-group row justify-content-center mb-0 text-center">
								<div class="col-md-12 px-3"> 
									<button id="send-mail-btn" type="submit" name="send-mail" 
										class="btn btn-block btn-success rm-border">Send</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>