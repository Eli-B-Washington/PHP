<?php 
if($_SESSION['loggedin'] == FALSE){
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>PHP Motors Review Delete Page</title>
        <meta name="description" content="This page is for deleting reviews">
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
    <h1>Are you sure you would like to delete the review?</h1>
    
    <?php
if (isset($message)) {
 echo $message;
}
?>

<form action="/phpmotors/accounts/" method="post">

<label for="clientname">Name:</label><br>
<input type="text" readonly id="clientname" name="clientname" value =
   <?php if(isset($_SESSION['clientData']['clientId'])){ echo substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'] ;} 
elseif(isset($clientId)){ echo $clientFirstName; } ?> >
<br>
<label for="reviewText">Review:</label><br>
<textarea readonly
 id="reviewText" name="reviewText"><?php if(isset($reviewInfo['reviewText'])){echo "$reviewInfo[reviewText]";}  ?>
</textarea>




<input type="hidden" name="invId" <?php if(isset($invId)){echo "value='$invId'";}  ?>>
<input type="hidden" name="clientId" value="
<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
elseif(isset($clientId)){ echo $clientId; } ?>
">


<input type="hidden" name="reviewDate" value= "<?php

$d=strtotime('NOW'); 
$date = date('Y-m-d h:i:s', $d);
echo $date;

?>">
 <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo['reviewId'])){
echo $reviewInfo['reviewId'];} ?>">
<input type="submit" name="submit" class="btn" id="reviewbtn" value="Delete Review">
<input type="hidden" name="action" value="deleteReview">
</form>

    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>