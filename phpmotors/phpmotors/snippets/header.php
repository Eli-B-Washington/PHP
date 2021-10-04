<div>
    <img src="/phpmotors/images/logo.png" alt="PHP Motors Logo">
    
    <?php

    if (isset($_SESSION['loggedin'])) {
            $link = ($_SESSION['clientData']['clientFirstname']);
            echo'<p><a href="/phpmotors/accounts/">'.'Welcome '.$link." | ".'</a>
            <a href="/phpmotors/accounts/index.php?action=logout">'.'Logout'.'</a></p>';     
    }
        else{
            echo '<p><a href="/phpmotors/accounts/index.php?action=login-view">My Account</a></p>';
        }
    
        
    ?>
    </div>