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

if(isset($_GET['id'])) {
    $game = $gameHndlr->selectGameById($db,$_GET['id']);
}
else{
	header("Location: accessDenied.php");
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
				<form id="edit-game-form" action="php/actions/updateGame.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                 	<div class="form-group row">
						<div class="input-group col-12">
							<b class="form-text col-12 alert" id="edit-game-form-alert"></b>
						</div>
						<div class="input-group col-12 mb-2">
							<img id="imageView" src="img/uploads/games/<?= $game['photo']; ?>" class="img-fluid img-thumbnail w-100" alt="Responsive image thumbnail">
						</div>
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_title">Game</label>
							</div>
							<input id="game-title" type="text" name="game_title" class="form-control" 
								placeholder="Game Name" value="<?= $game['name']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_image">Image</label>
							</div>
							<div class="custom-file">
								<input id="game-image" type="file" class="custom-file-input" name="game_image"
								  aria-describedby="inputGroupFileAddon01" accept=".jpg, .jpeg" >
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
								placeholder="Download link" value="<?= $game['download_link']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="game_trailer_link">Link 2</label>
							</div>
							<input id="game-trailer-link" type="text" name="game_trailer_link" class="form-control" 
								placeholder="Trailer link" value="<?= $game['trailer_link']; ?>" required>
						</div>
					</div>
					<div class="form-group row justify-content-center mb-3">
						<div class="col-md-12 px-3"> 
							<button type="submit" name="update_game" class="btn btn-block btn-success rm-border">Update Game</button>
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