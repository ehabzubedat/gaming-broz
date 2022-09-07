<?php 
require 'php/init.php';	

if($_SESSION['type'] != "admin") {
	header("Location: accessDenied.php");
}

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
				<form id="game-form" action="php/actions/addGame.php" method="POST">
                 	<div class="form-group row">
						<div class="input-group col-12 mb-2">
							<b class="form-text col-12 alert" id="game-form-alert"></b>
						</div>
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_title">Game</label>
							</div>
							<input id="game-title" type="text" name="game_title" class="form-control" 
								placeholder="Game Name" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_image">Image</label>
							</div>
							<div class="custom-file">
								<input id="game-image" type="file" class="custom-file-input" name="game_image"
									aria-describedby="inputGroupFileAddon01" accept=".jpg, .jpeg" required>
								<label id="game-image-label" class="custom-file-label" for="inputGroupFile01">Choose Game Image</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_download_link">Link 1</label>
							</div>
							<input id="game-download-link" type="text" name="game_download_link" class="form-control" 
								placeholder="Download link" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_trailer_link">Link 2</label>
							</div>
							<input id="game-trailer-link" type="text" name="game_trailer_link" class="form-control" 
								placeholder="Trailer link" required>
						</div>
					</div>
					<div class="form-group row justify-content-center mb-3">
						<div class="col-md-12 px-3"> 
							<button id="add-game" type="submit" class="btn btn-block btn-success rm-border">Add Game</button>
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