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
        <div class="container sign-up-container">
            <div class="row justify-content-center">
                <div class="col-11 col-md-8 col-lg-6 col-xl-6 sign-up-container">
                    <form id="signup-form" class="contact-form" action="php/actions/register.php" method="POST">
                        <div class="card black mb70">
                            <div class="row mt-0">
                                <div class="col-md-12">
									<h2 class="sign-up-title">Sign Up</h2>
                                </div>
                            </div>
                            <div class="progress-bar-container bg-dark mb-2">
                                <div class="progress-bar bg-success" role="progressbar" id="progress-bar">
                                    <b class="lead" id="progress-text">step-1</b>
                                </div>
                            </div>
                            <h5 id="result" class="alert"></h5>
                            <div id="first">
                                <h4 class="sign-up-subtitle">Personal Information</h4>
                                <div class="form-group col-12 mb-2">
                                    <label for="first-name">Name:</label>
                                    <input id="first-name" type="text" name="first_name" class="form-control"
										placeholder="First Name" required>
                                    <b class="form-text alert alert-danger" id="first-name-error"></b>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <input id="last-name" type="text" name="last_name" class="form-control" 
										placeholder="Last name" required>
                                    <b class="form-text alert alert-danger" id="last-name-error"></b>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label for="birthday">Birthday:</label>
                                    <input id="birthday" type="date" class="form-control" name="birthday" required>
                                    <b class="form-text alert alert-danger" id="birthday-error"></b>
                                </div>
                                <div class="form-group col-12 mb-1">
                                    <label for="gender">Gender:</label>
                                    <select id="gender" class="form-control" name="gender" required>class="mdb-select md-form"
                                        <option value="">Choose...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <b class="form-text alert alert-danger" id="gender-error"></b>
                                </div>
                                <div class="form-group col-12 mb-1">
                                    <a href="#" class="btn btn-success rm-border ml-0" id="next-1">Next</a>
                                </div>
                            </div>
                            <div id="second" class="signup-mb">
                                <h4 class="sign-up-subtitle">Account Information</h4>
                                <div class="form-group col-12">
                                    <label for="email">E-mail:</label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required>
                                    <b class="form-text alert alert-danger" id="email-error"></b>
                                </div>
                                <div class="form-group col-12">
                                    <label for="username">Username:</label>
                                    <input id="username" type="text" name="username" class="form-control" placeholder="Username" autocomplete="new-username" required>
                                    <small  class="text-white">* Username can only contain A-Z / a-z / 0-9 / '-' / '_'.</small>
                                    <b class="form-text alert alert-danger" id="username-error"></b>
                                </div>
                                <div class="form-group col-12">
                                    <a href="#" class="btn danger-color-dark ml-0" id="prev-2">Back</a>
                                    <a href="#" class="btn btn-success" id="next-2">Next</a>
                                </div>
                            </div>
                            <div id="third" class="signup-mb">
                                <h4 class="sign-up-subtitle">Choose Password</h4>
                                <div class="form-group col-12">
                                    <label for="password">Password:</label>
                                    <input id="password" type="password" name="password" class="form-control" 
										placeholder="Password" autocomplete="new-password" required>
                                    <b class="form-text alert alert-danger" id="password-error"></b>
                                </div>
                                <div class="form-group col-12">
                                    <label for="confirm-password">Confirm Password:</label>
                                    <div class="input-group">
                                        <input id="confirm-password" type="password" name="confirm_password" class="form-control" 
											placeholder="Confirm Password" required>
                                        <span class="input-group-append bg-white border-left-0 eye-icon-span">
                                            <span class="input-group-text eye-icon">
												<i id="toggle-password-both" class="fa fa-eye eye-pass-toggle" data-toggle="tooltip" 
													data-placement="bottom" title="show password"></i>
                                            </span>
                                        </span>
                                    </div>  
                                    <small id="passwordHelpInline" class="text-white">
										* Password must be at least 8 characters long.
									</small>
                                    <b class="form-text alert alert-danger" id="confirm-password-error"></b>
                                </div>
                                <div class="form-group col-12">
                                    <a href="#" class="btn danger-color-dark ml-0" id="prev-3">Back</a>
                                    <a href="#" class="btn btn-success" id="next-3">Next</a>
                                </div>
                            </div>
                            <div id="fourth">
                                <h4 class="sign-up-subtitle">Profile Picture</h4>
                                <div class="form-group col-12 mb-0">
                                    <div class="image-container">
										<b class="form-text alert alert-danger mt-0 mb-4" id="image-error"></b>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="profile_picture" 
													class="form-control image-input" accept=".jpg, .jpeg" required>
                                                <label for="imageUpload" class="image-label" data-toggle="tooltip" 
														data-placement="bottom" title="edit">
                                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" class="image-div"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <a href="#" class="btn danger-color-dark ml-0 prev-4" id="prev-4">Back</a>
                                    <button id="sign-up-btn" type="submit" name="register" class="btn btn-success .signup-form-btn">
										Sign Up
									</button>
                                </div>
                            </div>
                            <div id="login-link" class="form-group col-12">
                                <p>Already a user? <a href="login.php" class="login-link">Sign In</a></p>
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