<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="This page shows a specific vehicle in a detailed view.">
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
    <h1><?php echo $invMake . " ". $invModel;?></h1>

 <?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;}
?>


<?php
if (isset($_SESSION['message'])) {
 echo ($_SESSION['message']);
 $_SESSION['message'] = '';
}
?>

<?php
if (isset($message)) {
    echo $message;
   }
?>

<h2>Customer Reviews:</h2>
<?php
if (isset($_SESSION['loggedin'])){
     require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/review-form.php';
}
else {
    echo '<h3>New reviews may be added by "logging in" <a href="/phpmotors/accounts/?action=login-view">Click here to Log in</a></h3>';
}
?>

<?php if(isset($reviewDisplay) & count($reviews) > 0){
  echo ($reviewDisplay);
}
 else {
    echo "<p>Be the first to write a review.</p>";
 }
?></main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>