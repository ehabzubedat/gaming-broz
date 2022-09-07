<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
	header("Location: accessDenied.php");
}

if(isset($_GET['cid'])) {
	$cid = $_GET['cid'];
    $categorie = $forumHndlr->selectCategoryById($db,$cid);
    if($cid == 3 && $_SESSION['type'] === 'user' || $cid == 4){
        header("Location: accessDenied.php");
    }
    elseif (empty($categorie)){
        header("Location: forum.php");
    }
}
else {
	header("Location: accessDenied.php");
}
?>
  
    <!-- Main -->
    <main>
		<!-- Container -->
		<div class="container forum-container topic-container rounded col-4">
			<!-- Title -->
			<h3 class="text-center rounded font-weight-bold news-title p-1">Add new topic</h3>
			<hr class="news-title-hr">
			<!-- /.Title -->
			
			<form  id="topic-form" class="col-lg-12" action="php/actions/addTopic.php?cid=<?= $cid; ?>" method="POST">
                <div><b class="mb-2 mt-0 form-text alert" id="topic-alert"></b></div>
				<div class="row justify-content-center">
					<div class="input-group col-md-12 mb-2">
						<div class="input-group-prepend">
							<label class="input-group-text" for="topic">Topic</label>
						</div>
						<input id="topic-input" type="text" name="topic" class="form-control" 
								placeholder="Title" required>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="input-group col-md-12 mb-2">
						<textarea class="form-control rounded-2" id="topic-content" 
							name="content" placeholder="Content.." rows="15" required></textarea>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-12 px-3"> 
						<button id="add-topic" type="submit" class="btn btn-block btn-success rm-border">Add</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.Container -->
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>