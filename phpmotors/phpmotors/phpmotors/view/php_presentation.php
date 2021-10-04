<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>Template for PHP Motors Website</title>
        <meta name="description" content="This template will be used for PHP Motors, a ficticious company">
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

    <h1>The For Loop</h1>
    <h4>"Loops through a block of code a specified number of times." (W3 schools) </h4>


    <!-- For Loop -->
    <?php


for ($x = 0; $x <= 10; $x++) {
  //echo "The number is: $x <br>";


  if ($x % 2 == 0){
      echo $x;
  }
}

?>


    <h1>The Foreach Loop</h1>
    <h4>"The foreach loop works only on arrays, and is used to loop through each key/value pair in an array." (W3 schools)</h4>
    <!-- Foreach Loop -->
    <?php

$colors = array("red", "green", "blue", "yellow", "orange", "red");

foreach ($colors as $value) {
  //echo "$value <br>";

  if($value == "red"){
      echo $value;
  }

}



 /*for($x = 0; $x < count($colors); $x++){
    echo "$colors[$x] <br>";
  }
*/
?>
 












    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>