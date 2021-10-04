<?php 
if($_SESSION['loggedin'] == FALSE || $_SESSION['clientData']['clientLevel'] < 2 ){
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="This page is for adding vehicles">
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

    <h1>Add Vehicle</h1>
    <?php
if (isset($message)) {
 echo $message;
}
?>
    <form action="/phpmotors/vehicles/index.php" method="post">
    
    
    

    <label for="classificationId">Classification:</label>
<?php
if (!empty($classificationList)){
    echo $classificationList;
    }
?>
<br>
<label for="invMake">Make: </label><br>
<input type="text" id="invMake" name= "invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?>required>
<br>
  <label for="invModel">Model:</label><br>
  <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?>required><br>

  <label for="invDescription">Description:</label><br>
  <textarea id="invDescription" name="invDescription" rows="4" cols="50" <?php if(isset($invDescription)){echo "value='$invDescription'";}?>required></textarea><br>

  <label for="invImage">Image path:</label><br>
  <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}  ?>required><br>
  <label for="invThumbnail">Thumbnail path:</label><br>
  <input type="text" id="invThumbnail" name="invThumbnail" value ="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>required><br>
  <label for="invPrice">Price:</label><br>
  <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>required pattern="^[0-9]*$"><br>
  <label for="invStock">Stock:</label><br>
  <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";}  ?>required pattern="^[0-9]*$"><br>
  <label for="invColor">Color:</label><br>
  <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?>required><br>


  <input type="submit" name="submit" class="btn" id="inventorybtn" value="Inventory">
  <input type="hidden" name="action" value="inventory">
  </form>


    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>