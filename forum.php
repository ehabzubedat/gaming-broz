<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
    include "php/includes/themes/header.php";
}
// Forum Categories
$categories = $forumHndlr->selectAllForumCategories($db);
?>

<!-- Main -->
<main>
    <!-- Container -->
    <div class="container forum-container rounded">
        <!-- Title -->
        <h3 class="text-center rounded  font-weight-bold news-title p-1">Forums</h3>
        <hr class="news-title-hr mb-2">
        <!-- /.Title -->

        <!-- Search for topic form -->
        <form id="search-topic-form" method="POST">
            <div class="input-group form-2 pl-0 mt-0 mb-0">
                <input id="search-topic-input" class="form-control my-0 py-1 white-border search-topic" type="text" placeholder="Search For A Topic..." aria-label="Search" name="search_text" value="<?php if(isset($_POST['search_text'])) echo $_POST['search_text']?>">
                <div class="input-group-append">
                    <button type="submit" id="search-btn" class="search-btn" name="search-btn">
                        <span class="input-group-text search-box-span" id="search-box-span">
                            <i class="fas fa-search text-grey" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <!-- ./Search for topic form -->
        
        <hr class="forum-hr mt-2">

        <!-- Forum -->
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col" class="pl-3">Forum</th>
                    <th>Topics</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $c): ?>
                <tr>
                    <th scope="row" class="pl-3">
                        <h6>
                            <a href="topics.php?cid=<?= $c['id']; ?>" class="text-white font-weight-bold d-block pt-2">
                                <?= $c['title']; ?>
                            </a>
                        </h6>
                        <p class="forum-subtitle"><?= $c['sub_title']; ?>
                        <p>
                    </th>
                    <td class="align-middle pl-3">
                        <?php 
                            $views = $forumHndlr->countTopicsByCategoryId($db,$c['id']);
                            echo $views;
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--/.Forum -->
    </div>
    <!-- /.Container -->
</main>
<!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>
