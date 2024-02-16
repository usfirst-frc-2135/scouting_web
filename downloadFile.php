<?php
   $file = ($_GET['file']);
   $newPath = ($_GET['newFilePath']);
   
   // Verify file exists.
   if (!file_exists($file)) {
     error_log("===> file doesn't exist: '$file'");
     echo json_encode(array('success' => 0));
   }
   else {

     error_log("===> file exists: '$file'");
     // Get the contents of the file to download.
     $contents = file_get_contents($file);

     // Copy the contents to the newPath.
     file_put_contents($newPath,$contents);
     error_log("Downloaded file '$file' to '$newPath'");
     echo json_encode(array('success' => 1));
  }
?>

