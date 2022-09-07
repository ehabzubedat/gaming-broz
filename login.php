<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
	header("Location: index.php");
}
else {
	include "php/includes/themes/header.php";
}
?>
  
    <!-- Main -->
    <main>
		<div class="container sign-in-container">
			<div class="row justify justify-content-center">
				<div class="col-11 col-md-8 col-lg-6 col-xl-5 sign-in-container">
					<form id="sign-in-form" class="sign-in-form" action="php/actions/login.php" method="POST">
						<div class="card black">
							<div class="row mt-0">
								<div class="col-md-12">
									<h2 class="sign-in-title">Log In</h2>
									<h4 class="sign-in-subtitle text-center">Welcome back!</h4>
								</div>
							</div>
							<h5 id="login-result" class="d-none alert alert-danger"></h5>
							<div class="form-group row mb-2 login-form-group">
								<div class="input-group col-md-12 mb-0">
									<div class="input-group-prepend">
										<label class="input-group-text" for="username"><i class="fa fa-user" aria-hidden="true"></i></label>
									</div>
									<input type="text" name="username" class="form-control input-box rm-border" placeholder="Username" required>
								</div>
							 </div>
							<div class="form-group row mb-3 login-form-group">
								<div class="input-group col-md-12 mb-0">
									<div class="input-group-prepend">
										<label class="input-group-text" for="password"><i class="fa fa-lock" aria-hidden="true"></i></label>
									</div>
									<input id="login-password" type="password" name="password" 
										class="form-control input-box rm-border border-right-0" placeholder="Password" required>
									<span class="input-group-append bg-white border-left-0 eye-icon-span">
										<span class="input-group-text eye-icon">
										  <i id="toggle-password" class="fa fa-eye eye-pass-toggle" 
											data-toggle="tooltip" data-placement="bottom" title="show password"></i>
										</span>
									</span>
								</div>
                            </div>
							<div class="form-group row justify-content-center mb-4">
								<div class="col-md-12 px-3"> 
									<div>
										<p>Not a user? <a href="signup.php" class="login-link">Sign Up</a></p>
									</div>
									<button id="login-btn" type="submit" name="login" class="btn btn-success btn-block">Login</button>
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