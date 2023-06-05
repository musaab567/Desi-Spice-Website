<?php 
require_once('dbConnector.php');

//Custom function to sanitize user info sent to server
function secureInfo($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//custom function to sanitize and validate user email
function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

$to_email = 'mmusaab2000@gmail.com';

//sending the name as the mail subject
$subject = secureInfo($_REQUEST['name']);

$message = secureInfo($_REQUEST['message']);
$user_email = $_REQUEST['email'];
$headers = 'From: '.$user_email;

//check if the email address is invalid $secure_check
$secure_check = sanitize_my_email($to_email);

if ($secure_check == false) {
    echo "Invalid input";
} else { //save info to database and send email 

    $query = "INSERT INTO contact_table (name,email,message,date_received) 
    VALUES('$subject','$user_email','$message',NOW())";
    $result = mysqli_query($dbc,$query);
    if($result){
        ini_set("smtp","smtp.mailtrap.io");
        ini_set("smtp_port","2525");
        ini_set("auth_username","2223af1c6d6100");
        ini_set("auth_password","d4084bb0a0f143");
        mail($to_email, $subject, $message, $headers);
        echo "This email is sent using PHP Mail";
        echo '<a href="../html/index.php"><br><button>Go Back</button></a>';
    }else{
        echo 'error occured while saving data '.mysqli_error($dbc);
    }
    mysqli_close($dbc);
    exit();

}
?>