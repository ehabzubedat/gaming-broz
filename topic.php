<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
}

if(isset($_GET['tid'])) {
	$tid = $_GET['tid'];
	$topic = $forumHndlr->selectTopic($db,$tid);
	$user = $userHndlr->getUserDataById($db,array($topic['author_id']));
	$count_comments = $forumHndlr->countComment($db,$tid);
	$comments = $forumHndlr->selectComments($db,$tid);
	$i = 0;
	$len = count($comments);
}
else {
	header("Location: accessDenied.php");
}
?>
  
    <!-- Main -->
    <main>
		<!-- Container -->
		<div class="container forum-container topic-container rounded">
			<!-- Title -->
			<h3 class="text-center rounded  font-weight-bold news-title p-1">Topic</h3>
			<hr class="news-title-hr mb-2">
			<!-- /.Title -->
			<?php if (empty($_SESSION)): ?>
				<div class="alert alert-warning col-12 mb-2" role="alert">
					You must sign in to comment!
					<a href="login.php" class="login-link">Sign in</a>
				</div>
			<?php endif; ?>
			
			<!-- Topic content-->
			<div class="rounded">
				<div class="topic-card-header card-header elegant-color-dark">
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex justify-content-between align-items-center">
							<div class="mr-2">
								<a class="link" href="user_profile.php?uid=<?= $user['id'] ?>"><img class="link-pic rounded-circle" width="45" height="45" src="img/uploads/profile pictures/<?= $user['profile_picture']?>"></a>
							</div>
                            <div class="ml-2">
                                <a class="link" href="user_profile.php?uid=<?= $user['id'] ?>">
                                    <div class="h5 m-0">@<?= $user['username']?></div>
                                </a>
							</div>
						</div>
						<div class="ml-2 float-left">
							<div class="h6 m-0">
								<span class="font-weight-bold text-red bg-white p-1 rounded">
									<i class="fas fa-clock pr-2"></i>
									<?= date("F j, Y, g:i a",strtotime($topic['date_posted'])); ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body elegant-color">
					<h3 class="font-weight-bold text-red bg-white p-2 pl-3 rounded"><?= $topic['title']?></h3>
					<hr class="topics-hr mt-0 mb-3">
					<p class="card-text pl-2"><?= $topic['content']?></p>
				</div>
				<hr class="comment-hr">
				
				<!-- Comments -->
				<?php if ($count_comments > 0): ?>
					<div class="bg-dark p-2">Comments</div>
					<hr class="comment-hr">
					
					<?php
						foreach($comments as $c):
						$comment_user = $userHndlr->getUserDataById($db,array($c['author_id']));
					?>
					<div class="topic-card-comments card-header elegant-color-dark">
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex justify-content-between align-items-center">
								<div class="mr-2">
                                    <a class="link" href="user_profile.php?uid=<?= $comment_user['id'] ?>">
									   <img class="link-pic rounded-circle" width="45" height="45" src="img/uploads/profile pictures/<?= $comment_user['profile_picture']?>">
                                    </a>
								</div>
								<div class="ml-2">
                                    <a class="link" href="user_profile.php?uid=<?= $comment_user['id'] ?>">
									   <div class="h5 m-0">@<?= $comment_user['username']?></div>
                                    </a>
								</div>
							</div>
							<div class="ml-2 float-left">
								<div class="h6 m-0">
									<span class="font-weight-bold text-red bg-white p-1 rounded">
										<i class="fas fa-clock pr-2"></i>
										<?= date("F j, Y, g:i a",strtotime($c['date_posted'])); ?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body elegant-color">
						<p class="card-text pl-2"><?= $c['content']?></p>
					</div>
						
					<?php 

						if ($i != $len - 1){
							echo '<hr class="comment-hr">';
						}	
							
						$i++;
					?>
						
					<?php endforeach; ?>
				<?php endif; ?>
				<!-- Comments -->
				
				<?php if (!empty($_SESSION)): ?>
					<form id="comment-form" action="php/actions/addComment.php?tid=<?= $tid; ?>" method="POST">
						<div class="form-group row">
							<div class="col-12">
								<textarea id="comment-textarea" placeholder="Type your Comment.." name="comment" 
									class="form-control input-box comment" required></textarea>
								
								<div class="col-lg-2 col-md-4 col-sm-12 pl-0 pr-0 pt-1 float-right"><button id="comment-btn" type="submit" name="comment-btn" 
									class="btn btn-block btn-success rm-border">Comment</button></div>
							</div>
						</div>
					</form>
				<?php endif; ?>
			</div>
			<!-- /.Topic content-->

		</div>
		<!-- /.Container -->
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>