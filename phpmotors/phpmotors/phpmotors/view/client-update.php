<?php 
if($_SESSION['loggedin'] == FALSE || $_SESSION['clientData']['clientLevel'] < 1 ){
    header('Location: /phpmotors/');
    exit;
}

?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="PHP Motors client update page">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css" media="screen">
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
    <h1>Update Account Information</h1>
    <?php
if (isset($message)) {
 echo $message;
}
?>
    <form action="/phpmotors/accounts/index.php" method="post">
    <label for="clientFirstname">First Name:</label><br>
  <input type="text" id="clientFirstname" name="clientFirstname"  value=<?php echo $_SESSION['clientData']['clientFirstname'] ?> required><br>
 

  <label for="clientLastname">Last Name:</label><br>
  <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value=" . $_SESSION['clientData']['clientLastname']; }?> required><br>

  <label for="clientEmail">Email:</label><br>
  <input type="text" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value=" . $_SESSION['clientData']['clientEmail']; }?> required><br>
  

  <br><input type="submit" name="submit" id="updatebtn" value="Update Information">
  <input type="hidden" name="action" value="updateClient">
  <input type="hidden" name="clientId" value="
  <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
elseif(isset($clientId)){ echo $clientId; } ?>
">
  </form>


  <?php
if (isset($message2)) {
 echo $message2;
}
?>
  <h1>Change Password</h1>  
  <form action="/phpmotors/accounts/index.php" method="post">
  <label for="clientPassword">Password:</label><br>
  <span>Entering a new Password will change the current password.
  Passwords must be at least 8 characters and contain 2 number, 1 capital letter and 1 special character.</span><br>
  <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
  <br><input type="submit" name="submit" id="passwordbtn" value="Update Password">
  <input type="hidden" name="action" value="updatePassword">
  <input type="hidden" name="clientId" value="
<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
elseif(isset($clientId)){ echo $clientId; } ?>
">
  </form>
  
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>