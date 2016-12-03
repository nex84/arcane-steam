<?php
include("FCKeditor/fckeditor.php") ;
?>
<html>
  <head>
    <title>FCKeditor - resultats</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>

<?php
$sValue = stripslashes( $_POST['FCKeditor1'] ) ;
print_r($sValue);
?>
      <br>
  </body>
</html>
