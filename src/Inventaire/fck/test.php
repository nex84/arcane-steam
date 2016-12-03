<?php
include("FCKeditor/fckeditor.php") ;
?>
<html>
  <head>
    <title>FCKeditor - Sample</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <form action="resultats.php" method="post">
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Value = 'Default text in editor';
$oFCKeditor->Config['SkinPath'] = 'skins/office2003/' ;
$oFCKeditor->Create() ;
?>
      <br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>