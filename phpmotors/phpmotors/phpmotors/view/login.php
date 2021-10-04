<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="This is the login page for PHP Motors">
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
    <h1>Sign in</h1>

    <?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>
    <form method="post" action="/phpmotors/accounts/">
  <label for="clientEmail">Email:</label><br>
  <input type="text" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required placeholder="Enter a valid email address"><br>

  <label for="clientPassword">Password:</label><br>
  <span>Passwords must be at least 8 characters and contain 2 number, 1 capital letter and 1 special character</span><br>
  <input type="text" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
  <br><input type="submit" name="submit" id="logbtn" value="Login">
  <input type="hidden" name="action" value="login">
  <input type="hidden" name="action" value="login">
</form>
<a href="/phpmotors/accounts/index.php?action=registration">Not a member yet?</a>

    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>