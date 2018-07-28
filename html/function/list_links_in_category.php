<?php
/**
 * This function lists all the links in a category
 */
function list_links_in_category($dbc, $catid)
  {
    try
      {
        $query = $dbc->prepare('SELECT    `url`,
                                          `description`
                                FROM      `link`
                                WHERE     `category` = :cat_id 
                                ORDER BY  `url` ASC;');
        $query->bindValue(':cat_id', $catid, PDO::PARAM_INT);

	// Loop through all rows in the result set
        if ($query->execute())
          {
            while ($row = $query->fetch(PDO::FETCH_ASSOC))
              {
                echo '<p><a href="' . $row['url'] . '">' .
                  $row['url'] . '</a> &ndash; ' .
                  $row['description'] . '</p>';
              }
          }
      }
    catch (PDOException $exception)
      {
        $logdata = $exception->getCode() . ' ' . $exception->getMessage();
        error_log ($logdata);
        die ('Please contact an administrator.');
      }
  }
