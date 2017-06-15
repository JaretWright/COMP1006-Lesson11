<?php
    $pageTitle = '404';
    $content = 'My page data';
    require_once ('header.php');
    echo '<main class="container">
            <h1>What were you thinking?  That link is broken</h1>
            <img height="400" src="images/404%20surpise.jpg">
            <p>'.$content.'</p>
        </main>';
    require_once ('footer.php');
?>
