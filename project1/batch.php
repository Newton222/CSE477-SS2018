<?php
require "lib/enigma.inc.php";
$view = new \Enigma\BatchView($system);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The Endless Enigma</title>
  <link href="enigma.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $view->present() ?>
</body>
</html>
