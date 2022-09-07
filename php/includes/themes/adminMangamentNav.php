<?php
function check_file()
{
    $this_file = basename($_SERVER['PHP_SELF']);
    $management_files = array("gameRegistration.php","articleRegistration.php","games.php","articles.php","editArticle.php","editGame.php");
    return in_array($this_file,$management_files);
}
?>
<li class="nav-item dropdown drop-down">
    <a class="nav-link dropdown-toggle text-white <?php if(check_file()){echo 'active-nav';}?>" id="navbarDropdownMenuLink" 
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Management
    </a>
    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <h5 class="dropdown-header ml-0 text-center text-black text-bold">Management</h5>
        <div class="dropdown-divider"></div>
        <p class="dropdown-header ml-0 text-center text-black text-bold">Games</p>
        <a class="dropdown-item ml-0" href="gameRegistration.php">Add Game</a>
        <a class="dropdown-item ml-0" href="games.php">Edit Games</a>
        <div class="dropdown-divider"></div>
        <p class="dropdown-header ml-0 text-center text-black text-bold">News</p>
        <a class="dropdown-item ml-0" href="articleRegistration.php">Add Article</a>
        <a class="dropdown-item ml-0" href="articles.php">Edit Articles</a>
        <div class="dropdown-divider"></div>
        <p class="dropdown-header ml-0 text-center text-black text-bold">Topics</p>
        <a class="dropdown-item ml-0" href="topicRequests.php">Topic Requests</a>
    </div>
</li>
