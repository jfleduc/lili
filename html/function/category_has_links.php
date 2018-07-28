<?php
/**
 * This function checks whether or not the supplied category id
 * has links in the database
 */
function category_has_links($dbc, $catid)
  {
    try
      {
        $query = $dbc->prepare('SELECT COUNT(*)
                                FROM  `link`
                                WHERE `link`.`category` = :cat_id;');
        $query->bindValue(':cat_id', $catid, PDO::PARAM_INT);
        $query->execute();
        $link_count = $query->fetchColumn();
      }
    catch (PDOException $exception)
      {
        $logdata = $exception->getCode() . ' ' . $exception->getMessage();
        error_log ($logdata);
        die ('Please contact an administrator.');
      }
    if ($link_count > 0)
      {
        return true;
      }
    else
      {
        return false;
      }
  }
