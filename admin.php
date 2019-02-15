<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header>
        <h1 class ="logo">Premier Choice Holidays</h1>

        <nav>
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="premierChoice.php">View Holidays</a></li>
                <li><a href="admin.html">Admin</a></li>
                <li><a href="credits.html">Credits</a></li>
                <li><a href="wireframe.pdf" target="_blank">Wireframe</a></li>
            </ul>
        </nav>
    </header>
    <div class="wrapper">
        <main>
            <?php
            /*
             * Requests all the input data from the form.
             */
            $holidayTitle = isset($_REQUEST['title']) ? $_REQUEST['title']:null;
            $holidayDescription = isset($_REQUEST['description']) ? $_REQUEST['description']:null;
            $holidayCategoryID = isset($_REQUEST['category']) ? $_REQUEST['category']:null;
            $holidayLocationID = isset($_REQUEST['location']) ? $_REQUEST['location']:null;
            $holidayDuration = isset($_REQUEST['duration']) ? $_REQUEST['duration']:null;
            $holidayPrice = isset($_REQUEST['price']) ? $_REQUEST['price']:null;

            $errors = false;
            ?>

            <h2 style='margin-left: 35%;'>New holiday has been added</h2>

            <?php

            $location; //Stores location of the holiday.
            $country; //Stores the country of the holiday.
            $category; //Stores the category of the holiday.
            $imagePath; //Stores the image path.

             //Assigns location and country depending on the location value that was entered in the form.
            switch($holidayLocationID)
            {
                case 'l1':
                    $location = "Milaidhoo Island";
                    $country = "Maldives";
                    break;
                case 'l2':
                    $location = "Rangali Island";
                    $country = "Maldives";
                    break;
                case 'l3':
                    $location = "Zanzibar";
                    $country = "Tanzania";
                    break;
                case 'l4':
                    $location = "Boston";
                    $country = "USA";
                    break;
                case 'l5':
                    $location = "San Francisco";
                    $country = "USA";
                    break;
                case 'l6':
                    $location = "Nairobi";
                    $country = "Kenya";
                    break;
                case 'l7':
                    $location = "Algarve";
                    $country = "Portugal";
                    break;
                case 'l8':
                    $location = "New York";
                    $country = "USA";
                    break;
                case 'l9':
                    $location = "Sorrento";
                    $country = "Italy";
                    break;
                case 'l10':
                    $location = "Verona";
                    $country = "Italy";
                    break;
            }

            //Assigns appropriate image and category depending on the category value that was entered in the form.
            switch($holidayCategoryID)
            {
                case 'c1':
                    $imagePath = 'img/luxury.png';
                    $category = "Luxury";
                    break;
                case 'c2':
                    $imagePath = 'img/tour.png';
                    $category = "Tour";
                    break;
                case 'c3':
                    $imagePath = 'img/safari.png';
                    $category = "Safari";
                    break;
                case 'c4':
                    $imagePath = 'img/golf.png';
                    $category = "Golf";
                    break;
                case 'c5':
                    $imagePath = 'img/weddings.png';
                    $category = "Weddings";
                    break;
                case 'c6':
                    $imagePath = 'img/walking.png';
                    $category = "Walking";
                    break;
                case 'c7':
                    $imagePath = 'img/opera.png';
                    $category = "Opera";
                    break;
            }

                    echo "<div class='box' style='margin-left: 25%;'>
                        <div class='overlayPosition'>
                            <div class='headingBox'>
                                 <div class='headingBox-title'>
                                       <h3>From <span class='price'>$holidayPrice</span></h3>
                                 </div>
                            </div>
                        </div>
                        
                        <div class='image-box'>
                            <a href='#'><img src='$imagePath'/></a>
                        </div>
                        
                        <div class='box-bottom'>
                         <div class='box-bottom-title'>$country, $location - $holidayTitle</div>
                         <div class='box-bottom-subtitle'>$holidayDescription</div>
                         <div class='box-bottom-footer'>$holidayDuration days</div>
                         <div class='box-bottom-category'>$category</div>
                                              
                    </div>
                   </div>";

            ?>

            <?php
            /*
             * If the request didn't fail, make connection to the database and insert details from the form
             * to the database.
             */
                if($errors == false)
                {
                    include 'database_conn.php';

                    $holidayTitle = $dbConn->real_escape_string($holidayTitle);
                    $holidayDescription = $dbConn->real_escape_string($holidayDescription);
                    $holidayCategoryID = $dbConn->real_escape_string($holidayCategoryID);
                    $holidayLocationID = $dbConn->real_escape_string($holidayLocationID);
                    $holidayDuration = $dbConn->real_escape_string($holidayDuration);
                    $holidayPrice = $dbConn->real_escape_string($holidayPrice);

                    $sql ="INSERT INTO PCH_holidays(holidayTitle, holidayDescription, catID, locationID, holidayDuration, holidayPrice) 
                        values('$holidayTitle', '$holidayDescription', '$holidayCategoryID', '$holidayLocationID', 
                        '$holidayDuration', '$holidayPrice')";

                    $result = $dbConn->query($sql);

                    if($result ===false)
                    {
                        echo "<p>Problem when saving: ".$dbConn->error.". Try again</p>";
                        exit;
                    }

                    $dbConn->close();
                }
            ?>
        </main>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class ="footer-title">Premier Choice Holiday</div>
            </div>

            <div class="footer-bottom">

                <div class="footer-legal">
                    <a href="#">Cookies policy</a>
                </div>

                <div class ="footer-legal">
                    <a href="#">Terms and conditions</a>
                </div>

                <div class="footer-legal">
                    <a href="#">Privacy policy</a>
                </div>

                <div class="footer-copyright">
                    <p>&copy; Premier Choice Holiday 2017. 15 Stepney Lane, New Castle Upon Tyne, UK.
                        VAT number 766572347. Company number 3781284</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>