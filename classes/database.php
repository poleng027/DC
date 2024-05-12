<?php
class database
{
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=phpoop_221','root','');
    }
    function check($username, $password){
        $con = $this->opencon();
        $query = "SELECT * from users WHERE user='".$username."'&&pass='".$password."'";
        return $con->query($query)->fetch();
    }

    function signup($fname, $lname, $birthday, $sex,$username,$password){
        $con = $this->opencon();
        $query = $con->prepare("SELECT user FROM users WHERE user = ?");
        $query->execute([$username]);
        $existingUser =  $query->fetch();

        if($existingUser){
            return false;
        }

        return $con->prepare("INSERT INTO users (first_name,last_name,birthday,sex,user,pass) VALUES (?,?,?,?,?,?)") 
        -> execute([ $fname, $lname, $birthday, $sex,$username,$password]);
    }
    function signupUser($fname, $lname, $birthday, $sex,$username,$password) {
        $con = $this->opencon();
        $query = $con->prepare("SELECT user FROM users WHERE user = ?");
        $query->execute([$username]);
        $existingUser =  $query->fetch();

        if($existingUser){
            return false;
        }

        $con->prepare("INSERT INTO users (first_name,last_name,birthday,sex,user,pass) VALUES (?,?,?,?,?,?)") 
        -> execute([ $fname, $lname, $birthday, $sex,$username,$password]);

        return $con->lastInsertId();
}
    function insertAddress($user_id, $street, $barangay, $city, $province){
        $con = $this->opencon(); 
        //$query = $con->prepare("SELECT user FROM users WHERE user = ?");

        return $con->prepare("INSERT INTO user_address (user_id, user_street, user_barangay, user_city, user_province) VALUES (?,?,?,?,?)") 
        -> execute([$user_id, $street, $barangay, $city, $province]);
    }

    function view() {
        $con = $this->opencon();
        return $con->query("SELECT users.user_id, users.first_name, users.last_name, users.birthday, users.sex, users.user, CONCAT(user_address.user_street,' ',user_address.user_barangay,' ', user_address.user_city,' ',user_address.user_province,' ') AS address FROM user_address INNER JOIN users ON user_address.user_id = users.user_id")->fetchAll();
}

function delete($user_id) {
    try{
        $con = $this->opencon();
            $con->beginTransaction();

            $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
            $query->execute([$user_id]);

            $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
            $query2->execute([$user_id]);

            $con->commit();
            return true;
    } catch (PDOException $e){
        $con->rollBack();
        return false;
}
}
function viewdata($user_id){
    try{
    $con = $this->opencon();
    $query = $con->prepare("SELECT users.user_id, users.first_name, users.last_name, users.birthday, users.sex, users.user, users.pass, user_address.user_street, user_address.user_barangay,  user_address.user_city, user_address.user_province FROM user_address INNER JOIN users ON user_address.user_id = users.user_id WHERE users.user_id = ?");
    $query->execute([$user_id]);
    return $query->fetch();
}
catch(PDOException $e){
    return [];
}
}


}