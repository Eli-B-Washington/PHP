<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Image Managment</title>
        <meta name="description" content="The image admin page is used to update images for the phpmotors website">
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
    <h1>Image Management</h1>
    <p>Welcome to the image management page.  Please choose one of the options presented below:</p>
    <h2>Add New Vehicle Image</h2>
    <div class="errorMessage">
<?php
 if (isset($message)) {
  echo $message;
 } ?>
    </div>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invId">Vehicle</label>

	<?php echo $prodSelect; ?>
    
    <br>
    <br>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
    <br>
 <label for='file1'>Upload Image:</label>
 <input type="file" name="file1" id="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>


<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html><?php unset($_SESSION['message']); ?>

