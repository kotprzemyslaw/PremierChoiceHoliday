<?php
//Connects to the database.
$dbConn = new mysqli('localhost', 'unn_w17018747',
    'Chrzaszczyzewoszyce123', 'unn_w17018747');

//If there is an error while connecting to the database, an error message will be displayed.
if ($dbConn->connect_error) {
    echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n";
    exit;
}
?>