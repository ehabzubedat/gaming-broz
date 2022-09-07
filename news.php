<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
	include "php/includes/themes/header.php";
}

$first_article = $articleHndlr->selectLatestArticle($db);
$articles = $articleHndlr->selectAllArticlesDescByDate($db);
$i = 0;
$len = count($articles);
?>
  
    <!-- Main -->
    <main>
		<!-- Container -->
		<div class="container news-container rounded">

			<!-- Section: Content -->
			<section class="magazine-section white-text">

				<!-- Section heading -->
				<h3 class="text-center rounded  font-weight-bold news-title p-1">News</h3>
				<hr class="news-title-hr">

				<!-- Grid row -->
				<div class="row justify-content-center">

					<!-- Grid column -->
					<div class="col-lg-8 col-md-12">

						<!-- Featured news -->
						<div id="latest-news-image" class="single-news mb-4 mt-4">

							<!-- Image -->
							<div class="view overlay rounded z-depth-1-half mb-4">
								<img class="img-fluid" src="img/uploads/articles/<?= $first_article[0]['image']; ?>"
									alt="Sample image">
								<div class="mask waves-effect waves-light">
									<!-- Card content -->
									<div class="card-body text-white rgba-black-light p-3">
										<!-- Data -->
										<div class="news-data d-flex justify-content-between">
											<h6 class="font-weight-bold text-red">
												<i class="fas fa-newspaper pr-2 mb-0" aria-hidden="true"></i>Latest Article
											</h6>
											<p class="font-weight-bold">
												<i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i> Posted:
												<?php echo date("F j, Y, g:i a",strtotime($first_article[0]['date_posted'])); ?>
											</p>
										</div>
                                        <?php if($first_article[0]['last_updated'] != null): ?>
                                        <div class="news-data d-flex justify-content-end">
											<p class="font-weight-bold">
                                                <i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i> 
												Last updated: <?= date("F j, Y, g:i a",strtotime($first_article[0]['last_updated'])) ?>
											</p>
										</div>
                                        <?php endif; ?>
										<span class="font-weight-bold text-red bg-white p-1 rounded">
											<i class="fas fa-gamepad pr-1 mb-0" aria-hidden="true"></i>
											<?php 
												$game = $gameHndlr->selectGameById($db,$first_article[0]['game_id']);
												echo $game['name'];
											?>
										</span>
										<h3 class="font-weight-bold"><a><?= $first_article[0]['title']; ?></a></h3>
										<hr>
										<p class="limit-3">
											<?= $first_article[0]['content']; ?>
										</p>
										<p id="latest-article-id" class="d-none"><?= $first_article[0]['id']; ?></p>
									</div>
								</div>
							</div>

						</div>
						<!-- /.Featured news -->
						
						<hr class="my-5">
						
						<!-- Section heading -->
						<h3 class="text-center rounded  font-weight-bold news-title p-1">All News</h3>
						<hr class="news-title-hr">
						
						<?php foreach($articles as $a): ?>
						<!-- Small news -->
						<div class="single-news mb-4">

							<!-- Grid row -->
							<div class="row">

								<!-- Grid column -->
								<div class="col-md-5">

									<!-- Image -->
									<div class="view rounded mb-4">
										<img class="img-fluid w-100" src="img/uploads/articles/<?= $a['image']; ?>" 
											alt="Sample image">
									</div>

								</div>
								<!-- /.Grid column -->

								<!-- Grid column -->
								<div class="col-md-7 mt-2">

									<!-- Excerpt -->
									<p class="font-weight-bold mb-0">
										<span class="font-weight-bold text-red bg-white p-1 rounded">
											<i class="fas fa-gamepad pr-1 mb-2" aria-hidden="true"></i>
											<?php 
												$game = $gameHndlr->selectGameById($db,$a['game_id']);
												echo $game['name'];
											?>
										</span>
										<br>
										<span class="p-1">
											<i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i>
											<?= date("F j, Y, g:i a",strtotime($a['date_posted'])); ?>	
										</span>
                                        <br>
                                        <?php if($a['last_updated'] != null): ?>
                                        <span class="p-1">
                                            <i class="fas fa-clock pr-1 mb-0" aria-hidden="true"></i>
                                            Last updated: <?= date("F j, Y, g:i a",strtotime($a['last_updated'])); ?>	
										</span>
                                        <?php endif; ?>
									</p>
									<div>
										<div class="col-12 pl-0 mb-2">
											<h4 class="font-weight-bold"><?= $a['title']; ?></h4>
										</div>
										<a href="article.php?id=<?= $a['id']; ?>" class="text-white text-decoration-none">See More..
											<i class="text-white fa fa-angle-double-right pl-2" aria-hidden="true"></i>
										</a>
									</div>
									
								</div>
								<!-- /.Grid column -->

							</div>
							<!-- Grid row -->

						</div>
						<!-- /.Small news -->
						
						<?php 

							if ($i != $len - 1){
								echo "<hr>";
							}	
							
							$i++;
						?>
						
						<?php endforeach; ?>

						
					</div>
					<!-- /.Grid column -->

				</div>
				<!-- /.Grid row -->

			</section>
			<!-- /.Section: Content -->

		</div>
		<!-- /.Container -->
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>