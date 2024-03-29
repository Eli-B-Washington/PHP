<?php

/*
* Vehicle Controller
*/
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../model/vehicle-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';


session_start();

$classifications = getClassifications();
$navList = buildNavlist($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}




$classificationList = '<select name="classificationId" id="classificationId">';
foreach ($classifications as $classification) {
 $classificationList .= "<option value='$classification[classificationId]'";
 if(isset($classificationId)){
     if($classification['classificationId'] === $classificationId){
         $classificationList .=' selected';
     }

 }
 $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';




switch ($action) {
    case 'classify':
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        if(empty($classificationName)){
            $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit; 
           }
           $addclassificationOutcome = addClassification($classificationName);
           if($addclassificationOutcome  === 1){
            $message = "";
            header('Location: http://localhost/phpmotors/vehicles/');
            include '../view/vehicle-man.php';
            exit;

           } else {
            $message = "<p class='errorMessage'>Sorry, the vehicle classification '$classificationName', has not been added to the system. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
           }
    break;
    case 'inventory':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));


        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invDescription) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }

           $addvehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice,
           $invStock, $invColor, $classificationId);

           if($addvehicleOutcome === 1){
            $message = "<p>Thanks for adding the $invColor $invModel to the system.</p>";
            include '../view/add-vehicle.php';
            exit;
           } else {
            $message = "<p class='errorMessage'>Sorry the $invColor $invModel has not been added to the system. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
           }
    break;

    case 'add-classification':
    include '../view/add-classification.php';
    break;
    case 'add-vehicle':
    include '../view/add-vehicle.php';
    break;
    
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;

        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
             $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-update.php';
            exit;
           break;

           case 'updateVehicle':
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            if (empty($classificationId) || empty($invMake) || empty($invModel) 
            || empty($invDescription) || empty($invImage) || empty($invThumbnail)
            || empty($invPrice) || empty($invStock) || empty($invColor)) {
          $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
             include '../view/vehicle-update.php';
         exit;
        }
        
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult) {
         $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
             include '../view/vehicle-update.php';
             exit;
            }
        break;

        
        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
                include '../view/vehicle-delete.php';
                exit;
                break;

        case 'deleteVehicle':
                    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
                    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
                    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
                    
                    $deleteResult = deleteVehicle($invId);
                    if ($deleteResult) {
                        $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    } else {
                        $message = "<p class='notice'>Error: $invMake $invModel was not
                    deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    }
                    break;

                    
        
                        case 'classification':
                            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
                            $vehicles = getVehiclesByClassification($classificationName);
                            if(!count($vehicles)){
                             $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
                            } else {
                             $vehicleDisplay = buildVehiclesDisplay($vehicles);
                            }
                            include '../view/classification.php';
                            break;
                            
                            case 'vehicleInfo':
                                $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
                                $vehicle = getInvItemInfo($invId);
                                $thumbnails = getThumbnailById($invId);
                                $invMake = $vehicle['invMake'];
                                $invModel = $vehicle['invModel'];
                                $vehicleDisplay = buildVehiclesDisplayFull($vehicle, $thumbnails);

                                $reviews = getReviewItemInfo($invId);
                                $reviewDisplay = buildReviewDisplay($reviews);
                                include '../view/vehicle-detail.php';
                                break;
    default:
    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
    break;
   }
