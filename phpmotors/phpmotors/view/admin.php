<?php 
if($_SESSION['loggedin'] == FALSE){
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title> PHP Motors Account</title>
        <meta name="description" content="Admin page for PHP Motors">
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
    <h1><?php
    echo $_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname'];
    ?></h1>
    <?php 
if($_SESSION['loggedin'] == FALSE){
    header('Location: /phpmotors/');
}
?>
<?php
if ($_SESSION['loggedin'] == True ){
        echo "<p>You are logged in.</p>";
    }
    ?>


<?php
if (isset($message)) {
 echo $message;
}
?>
<?php
if (isset($_SESSION['message'])) {
 echo ($_SESSION['message']);
 $_SESSION['message'] = '';
}
?>

<ul>
    <li>First Name: <?PHP echo $_SESSION['clientData']['clientFirstname'] ?> </li>
    <li>Last Name: <?PHP echo $_SESSION['clientData']['clientLastname'] ?> </li>
    <li>Email Address: <?PHP echo $_SESSION['clientData']['clientEmail'] ?> </li>
    </ul>
    
<br>

<?php
if ($_SESSION['clientData']['clientLevel'] >= 1 ){
        echo "<h2>Account Managment</h2>";
        echo "<p>Please use the link below to update accout information.</p>";
        echo "<p><a href='/phpmotors/accounts/index.php?action=update'>Update Account Information</a></p>";
    }
    ?>

    <?php
    
    if ($_SESSION['clientData']['clientLevel'] > 2 ){
        echo "<h2>Inventory Management</h2>";
        echo "<p>Please use the link below to update vehicle information.</p>";
        echo "<p><a href='/phpmotors/vehicles/'> Vehicle Management </a></p>";
    }
    
    ?>


<?php
    
    if ($_SESSION['clientData']['clientLevel'] >= 1 ){
        echo "<h2>Review Management</h2>";
        echo $reviewList;
        //"<p class='light'><a href='/phpmotors/accounts?action=edit-review&clientId=$reviewList[reviewId]'>Edit</a></p>";
        //echo "<p class='light'><a href='/phpmotors/accounts?action=delete-review&clientId=$review[reviewId]'>Delete</a></p>"; 
    }
    ?>

    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>
