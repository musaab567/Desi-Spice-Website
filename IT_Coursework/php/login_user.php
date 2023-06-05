<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
    ob_start();
    @session_start();
    require_once('dbConnector.php');
    function logsecure($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $poserrors = array();
        //email and password validation
        if(!empty($_REQUEST['username']) && !empty($_REQUEST['password'])){
            $username = mysqli_real_escape_string($dbc,logsecure($_REQUEST['username']));
            $pass = mysqli_real_escape_string($dbc, logsecure($_REQUEST['password']));
        }
        else{
            $poserrors[]="both username and password fields must be set!";
        }
        //pre query for login validation
        $query = "SELECT email,user_password FROM user_table WHERE (email='$username')";
        $result = mysqli_query($dbc,$query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $validemail = $row['email'];
            $validpass = $row['user_password'];

            //validating login
            if(!($validemail == $email) && !($validpass == $pass)){
                $poserrors[] = "wrong email/password combination";
            }

        }else{
            $poserrors[] = "you are not a registered member yet";
        }
        
            
        if(empty($poserrors)){
            $_SESSION['username'] = $validemail;
            header('Location: http://localhost/IT_COURSEWORK/html/index.php');
            mysqli_close($dbc);
            exit();
        }else{
            include_once('../html/login_form.html');
            echo '<div class="container" style="text-align: center;"><h1 class="w3-text-green">Error!</h1>
            <p class="w3-text-green">the following error(s) occurred:<br />';
            foreach ($poserrors as $msg) {
                echo "- <strong><span class=\"error-msg\">$msg</span></strong><br />\n";
            }
        }
    }else{
        include_once('../html/login_form.html');
    }

    /*
        the SQL queries performed in this file can otherwise be written or done with stored procedures as follows
        $query = "SELECT username,password FROM students WHERE $email = ? AND $password = ?";
        $stmt = mysqli_prepare($dbc,$query);
        mysqli_stmt_bind_param($stmt,'ss',$email,$password);
        $email=$_POST['email'];
        $password=$_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    */
?>

</body>
</html>