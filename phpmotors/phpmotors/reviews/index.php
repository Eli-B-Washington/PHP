<?php
//This is the reviews Controller

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';
require_once '../model/vehicle-model.php';

session_start();

$classifications = getClassifications();
$navList = buildNavlist($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}





switch ($action) {

    case 'add-review':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        $vehicle = getInvItemInfo($invId);
        $thumbnails = getThumbnailById($invId);
        $invMake = $vehicle['invMake'];
        $invModel = $vehicle['invModel'];
        $vehicleDisplay = buildVehiclesDisplayFull($vehicle, $thumbnails);
        $reviews = getReviewItemInfo($invId);
        

        if(empty($reviewText) || empty($reviewDate) || empty($invId) || empty($clientId)){
            $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
            '<p>' . $clientId .  '</p>';
            $reviewDisplay = buildReviewDisplay($reviews);
            include '../view/vehicle-detail.php';
            exit; 
        }
           $addReviewOutcome = addReview($reviewText, $reviewDate, $invId, $clientId);
           if($addReviewOutcome === 1){
            $reviewDisplay = buildReviewDisplay($reviews);
            $message = "<p class='errorMessage'>Thanks for adding your Review.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/?action=vehicleInfo&invId= ' .$invId);
            exit;
           } else {
            $reviewDisplay = buildReviewDisplay($reviews);  
            $message = "<p class='errorMessage'>Sorry the review has not been added to the system. Please try again.</p>";
            include '../view/vehicle-detail.php';
            exit;
           }
        break;
        case 'delete-review':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
            $reviewInfo = getReviewItem($reviewId);
            if (count($reviewInfo) < 1) {
                    $message = 'Sorry, no review information could be found.';
                }
                include '../view/review-delete.php';
                exit;
                break;

            case 'edit-review':
                $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
                $reviewInfo = getReviewItem($reviewId);
                if (count($reviewInfo) < 1) {
                        $message = 'Sorry, no reviews information could be found.';
                    }
                    
                    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-edit.php';
                    exit;
                    break;

             //Reviews Section
            

             case 'editReview':
                $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
                $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
                $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
        
                if(empty($reviewId) || empty($reviewText) || empty($reviewDate)){ 
                    $reviewInfo = getReviewItem($reviewId);    
                    $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
                    include  '../view/review-edit.php';
                    exit;
                }
                   // Send the data to the model
                   $updateOutcome = updateReview($reviewId, $reviewText, $reviewDate);
        
                   if($updateOutcome === 1){
                    if (isset($_SESSION['loggedin'])){
                        if(isset($_SESSION['clientData']['clientId'])){ $clientId = $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; }
                        $reviewItems = getReviewsByClient($clientId);
                        $reviewList = buildReviewList($reviewItems);
                        }   
                    $message = "<p class='errorMessage'>Thanks for updating your Review.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/accounts/');
                    exit;
                   } 
                   else {
                    $message = "<p class='errorMessage'>Sorry the update failed. Please try again.</p>";
                    $_SESSION['message'] = $message;  
                    include '../view/admin.php';
                    exit;
                   }
            break;            

            case 'deleteReview':
            $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_STRING));
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
            $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
            $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

             $deleteResult = deleteReview($reviewId);
             if ($deleteResult) {
            $message = "<p class='errorMessage'>Congratulations the Review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
            } else {
            $message = "<p class='errorMessage'>Error: The Review was not
            deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        }
        break;       
                    
    default:
    if (isset($_SESSION['loggedin'])){
        include '../view/admin.php';
    }
    else{
        include '../phpmotors/';
    }
   }

?>