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

$requests = $forumHndlr->selectAllTopicRequests($db);
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
                if(isset($_GET['status']) && isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        if($_GET['status'] == 'accept') {
                            echo '<div>
                                    <b class="mb-2 mt-0 form-text alert alert-success" id="topic-request-alert">
                                        Topic request has been accepted successfully.
                                    </b>
                                </div>';
                        }
                        else if($_GET['status'] == 'ignore'){
                            echo '<div>
                                    <b class="mb-2 mt-0 form-text alert alert-success" id="topic-request-alert">
                                        Topic request has been ignored successfully.
                                    </b>
                                </div>';
                        }
                    }
                    else{
                        echo '<div>
                                <b class="mb-2 mt-0 form-text alert alert-success" id="topic-request-alert">
                                    Error..Something went wrong.
                                </b>
                            </div>';
                    }
                }
                ?>
				<div class="col-md-4 pl-0 pb-2">
					<input type="text" id="searchbox" class="form-control" placeholder="Search...">
				</div>
				<div class="table-responsive">
					<table id="dtTopicRequests" class="table table-bordered table-dark table-striped" cellspacing="0" width="100%">
						<thead class="white-text">
							<tr>
								<th class="th-sm">Category ID</th>
								<th class="th-sm">Aurhor</th>
								<th class="th-sm">Title</th>
                                <th class="th-sm">Content</th>
                                <th class="th-sm">Date Reqested</th>
                                <th class="th-sm">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($requests as $r): ?>
							<tr>
								<td><?= $r['category_id']; ?></td>
								<td>
                                    <a href="user_profile.php?uid=<?= $r['author_id'] ?>" class="link">
                                        <?php
                                            $user_data = $userHndlr->getUserDataById($db,array($r['author_id']));
                                            if(!empty($user_data)){
                                                echo $user_data['username'];
                                            }
                                        ?>
                                    </a>
                                </td>
                                <td><?= $r['title']; ?></td>
                                <td><?= $r['content']; ?></td>
                                <td><?= $r['date_requested']; ?></td>
								<td>
									<a href="php/actions/topicRequest.php?action=accept&id=<?= $r['id'] ?>" class="btn btn-success w-100">
                                        accept
                                    </a>
                                    <a href="php/actions/topicRequest.php?action=ignore&id=<?= $r['id']; ?>" class="btn btn-danger w-100 mt-2">
                                        ignore
                                    </a>
                                </td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Category ID</th>
								<th>Aurhor</th>
								<th>Title</th>
                                <th>Content</th>
                                <th>Date Reqested</th>
                                <th>Actions</th>
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