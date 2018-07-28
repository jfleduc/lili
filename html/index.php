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
 * Include the functions related to category
 */
include('function/category_has_links.php');
include('function/list_links_in_category.php');
?>

<?php
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
// Loop through all category in the database
try
  {
    $query = $dbconn->prepare('SELECT `id`,
                                      `description`
                                FROM  `category`
                            ORDER BY  `description` ASC');
    // Loop through all rows in the result set
    if ($query->execute())
      {
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
          {
            $category_id   = $row['id'];
            $category_desc = $row['description'];
            if (category_has_links($dbconn, $category_id)) 
              {
                echo '<h2>' . $category_desc . '</h2>';
                list_links_in_category ($dbconn, $category_id);
              }
          }
      }	
  }
catch (PDOException $exception)
  {
    $logdata = $exception->getCode() . ' ' . $exception->getMessage();
    error_log ($logdata);
    die ('Please contact an administrator.');
  }
?>

<?php
/**
 * Include the page footer that ends the HTML for this page
 */
include('include/footer.php');
?>
