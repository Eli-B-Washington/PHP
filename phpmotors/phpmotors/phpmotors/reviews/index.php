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
            $message = "<p>Thanks for adding the review to the website.</p>";
            $reviewDisplay = buildReviewDisplay($reviews);
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
                    include '../view/review-edit.php';
                    exit;
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