<?php
if($_SESSION['loggedin'] == FALSE || $_SESSION['clientData']['clientLevel'] < 2 ){
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>PHP Motors Website Add Classification Page</title>
        <meta name="description" content="This page is to add vehicle classification for PHP Motors">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    </head>
    <body>
    <div class="wrapper">
    <header>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    <nav>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> 
    </nav>
    </header>
    <main>
    <h1>Add Classification</h1>
    <?php
if (isset($message)) {
 echo $message;
}
?>
    
    <form action="/phpmotors/vehicles/index.php" method="post">

    <label for="classificationName">Classification Name:</label><br>
  <input type="text" id="classificationName" name="classificationName" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?>required><br>
  <input type="submit" name="submit" id="classbtn" class="btn" value="Classify">
  <input type="hidden" name="action" value="classify">
  </form>
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>