<?php
    DEFINE('DB_USER', 'root' );
    DEFINE('DB_PASS', '' );
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_NAME', 'desi_spice');

    //$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) OR 
    //die('Unable to make database connection: '.mysqli_connect_error());
    if($dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME)){
        //echo '<p>CONNECTION SUCCESS</p>';
    }
    else{
        die('could not connect to db: '.mysqli_connect_error());
    }
?>