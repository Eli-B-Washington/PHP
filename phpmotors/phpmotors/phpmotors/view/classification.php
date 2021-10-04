<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
        <meta name="description" content="This view will show a selection of vehicles vehicle">
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
    <h1><?php echo $classificationName; ?> vehicles</h1>
    <?php if(isset($message)){
 echo $message; }
 ?>
 <?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>