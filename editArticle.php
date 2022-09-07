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
}

if(isset($_GET['id'])) {
    $article = $articleHndlr->selectArticleById($db,$_GET['id']);
}
else{
	header("Location: accessDenied.php");
}

$game = $gameHndlr->selectAllGamesAsc($db);
?>
  
    <!-- Main -->
    <main>
		<div class="profile_container">
			<?php 
				/* Profile navbar (with profile pic and username) */
				include "php/includes/themes/profileNav.php"; 
			?>
			<div class="container col-md-6">
				<form id="edit-article-form" action="php/actions/updateArticle.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                 	<div class="form-group row">
						<div class="input-group col-12">
							<b class="form-text col-12 alert" id="edit-article-form-alert"></b>
						</div>
						<div class="input-group col-12 mb-2">
							<img id="imageView" src="img/uploads/articles/<?= $article['image']; ?>" class="img-fluid img-thumbnail w-100" 
								alt="Responsive image thumbnail">
						</div>
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="article_title">Title</label>
							</div>
							<input id="artilce-title" type="text" name="article_title" class="form-control" 
								placeholder="Title" value="<?= $article['title']; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<div class="input-group-prepend">
								<label class="input-group-text" for="article_image">Image</label>
							</div>
							<div class="custom-file">
								<input id="article-image" type="file" class="custom-file-input" name="article_image"
								  aria-describedby="inputGroupFileAddon01" accept=".jpg, .jpeg" >
								<label id="article-image-label" class="custom-file-label" for="inputGroupFile01">Choose Image</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="input-group col-md-12 mb-0">
							<textarea class="form-control rounded-2" id="exampleFormControlTextarea1" 
							name="article_content" placeholder="Content.." rows="4" required><?= $article['content']; ?></textarea>
						</div>
					</div>
					<div class="form-group row justify-content-center mb-3">
						<div class="col-md-12 px-3"> 
							<button type="submit" name="update_article" class="btn btn-block btn-success rm-border">update article</button>
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