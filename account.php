<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
	header("Location: login.php");
}
?>
  
    <!-- Main -->
    <main>
		<div class="profile_container">
			<?php 
				/* Profile navbar (with profile pic and username) */
				include "php/includes/themes/profileNav.php"; 
			?>
			<div class="container col-md-6">
				<form id="account-form" class="account-form" action="php/actions/updateAccount.php" method="POST">
                    <div class="form-group row mb-3">
						<div class="input-group col-12 mb-2">
							<b class="form-text col-12 alert" id="account-alert"></b>
						</div>
                        <div class="input-group col-6 mb-0 left-input">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="account_fname"><i class="fa fa-user" aria-hidden="true"></i></label>
                            </div>
                            <input id="account-first-name" type="text" name="account_fname" class="form-control input-box rm-border" 
								placeholder="First name" value="<?= $_SESSION['first_name']; ?>" required>
						</div>
                        <div class="col-6 mb-0 right-input">
                            <input id="account-last-name" type="text" name="account_lname" class="form-control input-box rm-border"
								placeholder="Last name"  value="<?= $_SESSION['last_name']; ?>" required>
                        </div>
						<div class="input-group col-6 mb-0 left-input">
							<b class="form-text col-12 alert alert-danger" id="account-fname-error"></b>
						</div>
						<div class="input-group col-6 mb-0 right-input">
							<b class="form-text col-12 alert alert-danger" id="account-lname-error"></b>
						</div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="input-group col-md-12 mb-0">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="account_email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
							</div>
                            <input id="account-email" type="email" name="account_email" class="form-control" 
								placeholder="Email" value="<?= $_SESSION['email']; ?>" required>
                        </div>
						<div class="input-group col-12 mb-0">
							<b class="form-text col-12 alert alert-danger" id="account-email-error"></b>
						</div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group col-md-12 mb-0">
                            <div class="input-group-prepend">
								<label class="input-group-text" for="account_username"><i class="fa fa-at" aria-hidden="true"></i></label>
							</div>
							<input id="account-username" type="text" name="account_username" class="form-control" 
								placeholder="Username" value="<?= $_SESSION['username']; ?>" required>
                        </div>
						<div class="input-group col-12 mb-0">
							<b class="form-text col-12 alert alert-danger" id="account-username-error"></b>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="account_birthday"><i class="fa fa-birthday-cake"></i></label>
							</div>
							<input id="account-birthday" type="date" class="form-control" name="account_birthday" 
								value="<?= date('Y-m-d',strtotime($_SESSION['birthday'])); ?>" required>
						</div>
						<div class="input-group col-12 mb-0">
							<b class="form-text col-12 alert alert-danger" id="account-birthday-error"></b>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="account_gender">Gender</label>
							</div>
							<select id="account-gender" class="form-control gender-select" name="account_gender" required>
								<option value="">Choose...</option>
                                <option value="male" <?php if($_SESSION['gender'] === 'male'){ echo 'selected="selected"'; } ?>>
									Male
								</option>
                                <option value="female" <?php if($_SESSION['gender'] === 'female'){ echo 'selected="selected"'; } ?>>
									Female
								</option>
                                <option value="other" <?php if($_SESSION['gender'] === 'other'){ echo 'selected="selected"'; } ?>>
									Other
								</option>
							</select>
						</div>
						<div class="input-group col-12 mb-0">
							<b class="form-text col-12 alert alert-danger" id="account-gender-error"></b>
						</div>
					</div>
					<div class="form-group row justify-content-center mb-0">
						<div class="col-md-12 px-3"> 
							<button id="save-account" type="submit" class="btn btn-block btn-success rm-border">Save changes</button>
						</div>
                    </div>
                </form>
			</div>
		</div>

    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>