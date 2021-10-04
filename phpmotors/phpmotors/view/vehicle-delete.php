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
    <h1> 
    <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
    elseif(isset($invMake) && isset($invModel)) { 
        echo "Delete $invMake $invModel"; }?></h1>
    
    <?php
if (isset($message)) {
 echo $message;
}
?>


   <form method="post" action="/phpmotors/vehicles/">
<fieldset>
	<label for="invMake">Vehicle Make</label>
	<input type="text" required readonly name="invMake" id="invMake" <?php
if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

	<label for="invModel">Vehicle Model</label>
	<input type="text" required readonly name="invModel" id="invModel" <?php
if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

	<label for="invDescription">Vehicle Description</label>
	<textarea name="invDescription" readonly id="invDescription"><?php
if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
?></textarea>

<input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

	<input type="hidden" name="action" value="deleteVehicle">
	<input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
echo $invInfo['invId'];} ?>">

</fieldset>
</form>









    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>