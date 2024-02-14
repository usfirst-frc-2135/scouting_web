<?php
   $file = ($_GET['file']);
   $newPath = ($_GET['newFilePath']);
   
   // Get the contents of the file to download.
   $contents = file_get_contents($file);

   // Copy the contents to the newPath.
   file_put_contents($newPath,$contents);
   error_log("Downloaded file '$file' to '$newPath'");
?>

