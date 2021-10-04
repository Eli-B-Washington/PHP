<form class="review-form" action="/phpmotors/reviews/index.php" method="post">
  <label for="clientname">Name:</label><br>
  <input type="text" required readonly id="clientname" name="clientname" value =
   <?php if(isset($_SESSION['clientData']['clientId'])){ echo substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'] ;} 
elseif(isset($clientId)){ echo $clientFirstName; } ?> ><br>

  <label for="reviewText">Review:</label><br>
  <textarea required id="reviewText" name="reviewText"></textarea>
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
  <input type="submit" name="submit" class="btn" id="reviewbtn" value="Add Review">
  <input type="hidden" name="action" value="add-review">
</form>