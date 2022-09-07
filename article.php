<?php 
require 'php/init.php';	

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
?>
  
    <!-- Main -->
    <main>
		<div class="container news-container rounded">

			<!-- Section: Content -->
			<section class="magazine-section white-text">

				<!-- Section heading -->
				<h3 class="text-center rounded  font-weight-bold news-title p-1">News/Article</h3>
				<hr class="news-title-hr">

				<!-- Grid row -->
				<div class="row justify-content-center">

					<!-- Grid column -->
					<div class="col-lg-8 col-md-12">

						<!-- Featured news -->
						<div class="single-news mb-4 mt-4">

							<!-- Image -->
							<div class="view overlay rounded z-depth-1-half mb-4">
								<img class="img-fluid" src="img/uploads/articles/<?= $article['image']; ?>"
									alt="Sample image">
								<div class="mask waves-effect waves-light">
									<!-- Card content -->
									<div class="card-body text-white rgba-black-light p-3">
										<!-- Data -->
										<div class="news-data d-flex justify-content-between">
											<h6 class="font-weight-bold  text-red">
												<i class="fas fa-newspaper pr-2 mb-0" aria-hidden="true"></i>Article<br>
											</h6>
											<p class="font-weight-bold">
												<i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i>
												<?= date("F j, Y, g:i a",strtotime($article['date_posted'])); ?>
											</p>
										</div>
                                        <?php if($article['last_updated'] != null): ?>
                                        <div class="news-data d-flex justify-content-end">
											<p class="font-weight-bold">
                                                <i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i>
												Last updated: <?= date("F j, Y, g:i a",strtotime($article['last_updated'])) ?>
											</p>
										</div>
                                        <?php endif; ?>
									</div>
								</div>
							</div>

						</div>
						<!-- /.Featured news -->
						
						<hr class="mt-5 mb-4">
						
						
						<!-- Article content -->
						<div class="mb-4">

							<!-- Grid row -->
							<div class="row">
								<div class="col-lg-12 col-md-12">
									<span class="font-weight-bold text-red bg-white p-1 rounded">
										<i class="fas fa-gamepad pr-1 mb-3" aria-hidden="true"></i>
										<?php 
											$game = $gameHndlr->selectGameById($db,$article['game_id']);
											echo $game['name'];
										?>
									</span>
									<h3 class="font-weight-bold"><?= $article['title']; ?></h3>
									<p>
										<?= $article['content']; ?>
									</p>
								</div>
							</div>
							<!-- Grid row -->

						</div>
						<!-- /.Article content -->

						
					</div>
					<!-- /.Grid column -->

				</div>
				<!-- /.Grid row -->

			</section>
			<!-- /.Section: Content -->

		</div>
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>