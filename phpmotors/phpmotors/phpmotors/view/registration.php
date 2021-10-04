<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="PHP Motors Registration Page">
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
    <h1>Register</h1>
    <?php
if (isset($message)) {
 echo $message;
}
?>
    <form action="/phpmotors/accounts/index.php" method="post">
    <label for="clientFirstname">First Name:</label><br>
  <input type="text" id="clientFirstname" name="clientFirstname"  <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>required><br>
 

  <label for="clientLastname">Last Name:</label><br>
  <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>required><br>

  <label for="clientEmail">Email:</label><br>
  <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required placeholder="Enter a valid email address"><br>

   
  <label for="clientPassword">Password:</label><br>
  <span>Passwords must be at least 8 characters and contain 2 number, 1 capital letter and 1 special character</span><br>
  <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

  <input type="submit" name="submit" id="regbtn" value="Register">
  <input type="hidden" name="action" value="register">
  </form>
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>