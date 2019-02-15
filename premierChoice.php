<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width"/>
    <title>Title</title>
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
include 'database_conn.php'; // make database connection

/*
 * Query the contents of the database records and groups them by title.
 */
$sql = "Select holidayTitle, holidayDescription, locationName, country, holidayDuration, catDesc, holidayPrice
        FROM PCH_location
        INNER JOIN PCH_holidays
        ON PCH_holidays.locationID = PCH_location.locationID
        INNER JOIN PCH_category
        ON PCH_category.catID = PCH_holidays.catID
        GROUP BY holidayTitle";

$queryResult = $dbConn->query($sql);

/*
 * If query failed, display error message.
 * Else dynamically creates a web page with all the data from the database.
 */
if ($queryResult === false)
{
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
}
else
{
    /*
     * Loops through all the content of database.
     */
    while($rowObj = $queryResult -> fetch_object())
    {
        $imagePath; //Stores the path to the image.
        $category = $rowObj->catDesc; //Stores the holiday category.

        //Assigns appropriate image depending on the category of holiday.
        switch($category)
        {
            case 'Luxury':
                $imagePath = 'img/luxury.png';
                break;
            case 'Tour':
                $imagePath = 'img/tour.png';
                break;
            case 'Safari':
                $imagePath = 'img/safari.png';
                break;
            case 'Golf':
                $imagePath = 'img/golf.png';
                break;
            case 'Weddings':
                $imagePath = 'img/weddings.png';
                break;
            case 'Walking':
                $imagePath = 'img/walking.png';
                break;
            case 'Opera':
                $imagePath = 'img/opera.png';
                break;
        }

        echo "<div class='box'>
                <div class='overlayPosition'>
                    <div class='headingBox'>
                         <div class='headingBox-title'>
                               <p style='font-size:14px; max-height: 10px; text-align: center;'>From <span class='price'>{$rowObj->holidayPrice}</span></p>
                         </div>
                    </div>
                </div>
                
                
                <div class='image-box'>
                    <a href='#'><img src='$imagePath'/></a>
                </div>
                
                <div class='box-bottom'>
                     <div class='box-bottom-title'>{$rowObj->country}, {$rowObj->locationName} - {$rowObj->holidayTitle}</div>
                     <div class='box-bottom-subtitle'>{$rowObj->holidayDescription}</div>
                     <div class='box-bottom-footer'>{$rowObj->holidayDuration} days</div>
                     <div class='box-bottom-category'>$category</div>
                                          
                </div>
               </div>";
    }
}

$queryResult -> close(); //Closes query.
$dbConn -> close(); //Closes database connection.

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
