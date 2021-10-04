<!DOCTYPE html>
<html lang = "en-us">
    <head>
        <meta charset="utf-8">
        <title>PHP Motors HomePage</title>
        <meta name="description" content="The PHP motors homepage.  A place to buy car parts.">
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
    <h1>Welcome to PHP Motors!</h1>
    <div class="delorean_description">
    <h2>DMC Delorean</h2>
    <ul>
    <li>3 Cup holders</li>
    <li>Superman doors</li>
    <li>Fuzzy Dice!</li>
    </ul>
    </div>
    <div class="delorean_button">
    <img class="delorean_image" src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean Car">
    <button>Own Today</button>
    </div>
    <div class = "delorean_divider">
    <div class = "reviews">
    <h2>DMC Delorean Reviews</h2>
    <ul>
    <li>"So fast its almost like traveling in time." (4/5)</li>
    <li>"Coolest ride on the road." (4/5)</li>
    <li>"I'm feeling Marty McFly" (5/5)</li>
    <li>"The most futuristic ride of our day"</li>
    <li>"80's livin and I love it!" (5/5)</li>
    </ul>
</div>

    
        
    <div class="upgrade">
    <h2>Delorean Upgrades</h2>
    <div class ="upgrades">
    <div>    
    <div>
    <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
    </div>
    <a href="#">Flux Capacitor</a>
    </div>

    <div>
    <div>
    <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
    </div>
    <a href="#">Flame Decals</a>
    </div>

    <div>
    <div>
    <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
    </div>
    <a href="#">Bumper Stickers</a>
    </div>

    <div>
    <div>
    <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
    </div>
    <a href="#">Hub Caps</a>
    </div>
</div>
</div>
</div>
    </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
</div>
    </body>
</html>