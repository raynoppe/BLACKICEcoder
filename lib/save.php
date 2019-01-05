<?php 
$file = $_REQUEST['file'];
$contents = $_REQUEST['contents'];

if (is_file($file) and is_writable($file)) {
  $savefile = file_put_contents($file, $contents, LOCK_EX);
  echo '{ "status": "saved" }';
} else {
  echo '{ "status": "error" }';
}
?>