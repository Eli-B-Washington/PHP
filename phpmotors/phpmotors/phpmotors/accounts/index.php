<?php

/*
* Accounts Controller
*/
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';


session_start();

$classifications = getClassifications();
$navList = buildNavlist($classifications);



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


if (isset($_SESSION['loggedin'])){
if(isset($_SESSION['clientData']['clientId'])){ $clientId = $_SESSION['clientData']['clientId'];} 
elseif(isset($clientId)){ echo $clientId; };

$reviewItems = getReviewsByClient($clientId);
$reviewList = buildReviewList($reviewItems);
}




switch ($action) {
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
        }



        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
           }

           // Hash the checked password
           $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

           // Send the data to the model
           $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

           if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            include '../view/login.php';
            exit;
           } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
           }


    break;
    case 'login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);
        
        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
         $message = '<p class="notice">Please provide a valid email address and password.</p>';
         include '../view/login.php';
         exit;
        }
        


        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
          $message = '<p class="notice">Please check your password and try again.</p>';
          include '../view/login.php';
          exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array

        

        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        if (isset($_SESSION['loggedin'])){
            if(isset($_SESSION['clientData']['clientId'])){ $clientId = $_SESSION['clientData']['clientId'];} 
            elseif(isset($clientId)){ echo $clientId; };
            
            $reviewItems = getReviewsByClient($clientId);
            $reviewList = buildReviewList($reviewItems);
            }
        // Send them to the admin view
        include '../view/admin.php';
        exit;



    break;
    case 'update':
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
        $clientInfo = getClientInfo($clientId);
        /*if (count($clientInfo) < 1) {
                $message = 'Sorry, no client information could be found.';
            }*/
            include '../view/client-update.php';
            exit;
            break;

            case 'updateClient':
                $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
                $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
                $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
                $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
                if(empty($clientId) || empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                    $message = '<p>Please provide information for all empty form fields.</p>';
                    include '../view/client-update.php';
                    exit; 
                }
                   // Send the data to the model
                   $updateOutcome = updateClientInfo($clientId, $clientFirstname, $clientLastname, $clientEmail);
        
                   if($updateOutcome === 1){
                    $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
                    $_SESSION['clientData']['clientLastname'] = $clientLastname;
                    $_SESSION['clientData']['clientEmail'] = $clientEmail;
                    $message = "<p class='errorMessage'>Thanks for updating your information $clientFirstname.</p>";
                    include '../view/admin.php';
                    exit;
                   } else {
                    $message = "<p class='errorMessage'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
                    include '../view/client-update.php';
                    exit;
                   }
            break;

            case 'updatePassword':
                $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
                $checkPassword = checkPassword($clientPassword);
                $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
                if(empty($checkPassword || checkPassword($clientPassword))){
                    $message2 = "<p class='errorMessage'>Please provide information for all empty form fields or match the requested format.</p>";
                    include '../view/client-update.php';
                    exit; 
                   }
                   // Hash the checked password
                   $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
                   // Send the data to the model
                   $passwordOutcome = updateClientPassword($hashedPassword, $clientId);
                   if($passwordOutcome === 1){
                    $message = "<p class='notice'>Thanks for updating your information.</p>";
                    header('Location: /phpmotors/accounts/?action=login');
                    include '../view/admin.php';
                    exit;
                   } else {
                    $message2 = "<p class='errorMessage'>Sorry but the password update has failed. Please try again.</p>";
                    include '../view/registration.php';
                    exit;
                   }
            break;

            
            

//Reviews Section
            

                case 'editReview':
                            $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
                            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
                            $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
                    
                            if(empty($reviewId) || empty($reviewText) || empty($reviewDate)){
                                $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
                                include '../view/review-edit.php';
                                exit; 
                            }
                               // Send the data to the model
                               $updateOutcome = updateReview($reviewId, $reviewText, $reviewDate);
                    
                               if($updateOutcome === 1){
                                if (isset($_SESSION['loggedin'])){
                                    if(isset($_SESSION['clientData']['clientId'])){ $clientId = $_SESSION['clientData']['clientId'];} 
                                    elseif(isset($clientId)){ echo $clientId; };
                                    
                                    $reviewItems = getReviewsByClient($clientId);
                                    $reviewList = buildReviewList($reviewItems);
                                    }   
                                $message = "<p class='errorMessage'>Thanks for updating your Review.</p>";
                                include '../view/admin.php';
                                exit;
                               } else {
                                $message = "<p class='errorMessage'>Sorry the update failed. Please try again.</p>";  
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
                        $message = "<p class='notice'>Congratulations the Review was successfully deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/accounts/');
                        exit;
                    } else {
                        $message = "<p class='notice'>Error: The Review was not
                    deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    }
                    break;

    case 'logout':
    session_unset();
    session_destroy();
    header('Location: /phpmotors/');
    break;
    case 'registration':
    include '../view/registration.php';
    break;
    default:
    include '../view/admin.php';
   }
?>