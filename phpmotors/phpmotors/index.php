<?php

// Get the database connection file
//require_once 'library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
//require_once 'model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/main-model.php';

//require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/functions.php';


// Create or access a Session
session_start();

$classifications = getClassifications();
//var_dump($classifications);

//echo '<pre>' . print_r($classifications, true) . '</pre>';
//exit;

$navList = buildNavlist($classifications);

function buildNavlist($classifications){ 
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
  .urlencode($classification['classificationName']).
  "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>'; 
  return $navList;
  }


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }

switch ($action){
    case 'something':
 
     break;
    
    default:
     include 'view/home.php';
   }

   ?>