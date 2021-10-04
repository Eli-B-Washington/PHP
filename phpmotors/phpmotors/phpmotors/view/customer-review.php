<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>PHP Motors Website - Add a Review</title>
        <meta name="description" content="PHP Motors add a review page">
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
    <h1>Add Customer Review</h1>
    <form>
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname">
  <input type="hidden" name="invId" <?php if(isset($invId)){echo "value='$invPrice'";}  ?>>
  <input type="hidden" name="clientId" <?php if(isset($clientId)){echo"value='$invPrice'";}  ?>>
  <input type="submit" name="submit" class="btn" id="reviewbtn" value="Review">
  <input type="hidden" name="action" value="review">
</form>
<?php

?>

    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>