<?php 
if($_SESSION['loggedin'] == FALSE || $_SESSION['clientData']['clientLevel'] < 2 ){
    header('Location: /phpmotors/');
    exit;
}

?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?>
        <meta name="description" content="This page is for updating vehicles">
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
    <h1> 
    <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
    elseif(isset($invMake) && isset($invModel)) { 
        echo "Modify$invMake $invModel"; }?></h1>
 

    <?php
if (isset($message)) {
 echo $message;
}
?>
 </div>
    <form action="/phpmotors/vehicles/index.php" method="post">
    
    
    

    <label for="classificationId">Classification:</label>
<?php
if (!empty($classificationList)){
    echo $classificationList;
    }
?>
<br>
<label for="invMake">Make: </label><br>
<input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
<br>
  <label for="invModel">Model:</label><br>
  <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

  <textarea name="invDescription" id="invDescription" required>
<?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

  <label for="invImage">Image path:</label><br>
  <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }  ?>required><br>
  <label for="invThumbnail">Thumbnail path:</label><br>
  <input type="text" id="invThumbnail" name="invThumbnail" value ="/phpmotors/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>required><br>
  <label for="invPrice">Price:</label><br>
  <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }  ?>required pattern="^[0-9]*$"><br>
  <label for="invStock">Stock:</label><br>
  <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }  ?>required pattern="^[0-9]*$"><br>
  <label for="invColor">Color:</label><br>
  <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>required><br>


  <input type="submit" name="submit" value="Update Vehicle">
  <input type="hidden" name="action" value="updateVehicle">
  <input type="hidden" name="invId" value="
<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
elseif(isset($invId)){ echo $invId; } ?>
">
  </form>


    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>