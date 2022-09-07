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

$articles = $articleHndlr->selectAllArticles($db);
?>
  
    <!-- Main -->
    <main>
		<div class="profile_container">
			<?php 
				/* Profile navbar (with profile pic and username) */
				include "php/includes/themes/profileNav.php"; 
			?>
			<div class="container col-md-12">
                <?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                       echo '<div>
                                <b class="mb-2 mt-0 form-text alert alert-success" id="game-alert">
                                    Article has been deleted successfully.
                                </b>
                            </div>';
                    }
                    else {
                        echo '<div>
                                <b class="mb-2 mt-0 form-text alert alert-danger" id="game-alert">
                                    Error..Failed to delete article!
                                </b>
                            </div>';
                    }
                }
                ?>
				<div class="col-md-4 pl-0 pb-2">
					<input type="text" id="searchbox" class="form-control" placeholder="Search...">
				</div>
				<div class="table-responsive">
					<table id="dtArticles" class="table table-bordered table-dark table-striped">
						<thead class="white-text">
							<tr>
								<th scope="col">Title</th>
								<th class="width-100" scope="col">Image</th>
								<th scope="col">Posted on</th>
								<th class="width-100" scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($articles as $a): ?>
							<tr>
								<td><?= $a['title']; ?></td>
								<td>
									<img src="img/uploads/articles/<?= $a['image'] ?>" class="img-fluid img-table w-50" 
										alt="Responsive image">	
								</td>
								<td><?= date("d/m/Y, g:i a",strtotime($a['date_posted'])); ?></td>
								<td>
									<a href="editArticle.php?id=<?= $a['id'] ?>" class="btn btn-warning w-100">Edit</a>
                                    <a onclick=" return confirm('Are you sure you want to delete this article?')" 
										href="php/actions/deleteArticle.php?id=<?= $a['id'] ?>" class="btn btn-danger w-100  mt-2">Delete</a>
                                </td>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th scope="col">Title</th>
								<th scope="col">Image</th>
								<th scope="col">Posted on</th>
								<th scope="col">Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>