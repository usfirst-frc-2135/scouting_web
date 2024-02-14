<?php
   $file = ($_GET['file']);
   $newPath = ($_GET['newFilePath']);
   error_log(">>>> file = $file");
   
   $contents = file_get_contents($file);
   error_log("   ===>> newPath = $newPath");

  $contents = file_get_contents($file);
  file_put_contents($newPath,$contents);
?>

