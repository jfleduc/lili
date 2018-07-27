<?php
/**
 * Set all the constants in the configuration
 */
require_once('../protected/config.php');
/**
 * Open the connection to the database
 */
require_once('../protected/dbconn.php');
/**
 * Set the amount of time for the user's browser to cache this page
 */
header("Cache-Control: max-age=30");
/**
 * Include the page header that starts the HTML for this page
 */
include('include/header.php');
?>

<h1><?php echo TITLE; ?></h1>
<p class="tagline"><?php echo TAGLINE; ?></p>

<?php
/**
 * Include the page footer that ends the HTML for this page
 */
include('include/footer.php');
?>
