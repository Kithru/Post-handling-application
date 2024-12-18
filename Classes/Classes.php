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

}


?>