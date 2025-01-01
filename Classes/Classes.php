<?php
require_once "../Classes/DBConnect.php";

class Classmanager {

    public function login($email,$password) {       
        $con = DBConnect::getConnection();
        $query = "SELECT * FROM `user` WHERE `email`='$email' ";
        $results = mysql_query($query, $con) or die(mysql_error());
            $count=mysql_num_rows($results);
            $row = mysql_fetch_assoc($results);
            $_SESSION['userid'] = $row['userid'];
            $hashedPassword = $row['password'];
        
            if (password_verify($password, $hashedPassword)) {
                return "verified";
            } else {
                return "Incorrect";
            }
    }

    public function register($email,$password) {
        
        $con = DBConnect::getConnection();
        $duplicate = $this->checkduplicate($email,$password);
        if ($duplicate != '1') {
            $date_with_time = date("Y-m-d H:i:s");
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $email = mysql_real_escape_string($email);
            $password = mysql_real_escape_string($password);
            $sql = "INSERT INTO user (email, password, added_date) VALUES ('$email', '$hashedPassword', '$date_with_time')";
            $results = mysql_query($sql, $con) or die("couldn't execute the sql");
            if ($results) {
                return 'added';
            } else {
                return 'failed';
            }
        }  else {
            return 'duplicate';
        }
    }  

    public function checkduplicate($email,$password) {
        $con = DBConnect::getConnection();

        $query = "SELECT * FROM `user` WHERE `email`='$email' LIMIT 1";
        $results = mysql_query($query, $con) or die(mysql_error());
        $count=mysql_num_rows($results);
            if($count>0){
                    return 1;
            }else{
                return 0;
            }
    }

}


?>
