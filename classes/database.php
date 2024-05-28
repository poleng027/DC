<?php
class database
{
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=phpoop221','root','');
    }
    function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $stmt = $con->prepare("SELECT * FROM users WHERE user = ?");
        $stmt->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['pass'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
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
        function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture)
        {
            $con = $this->opencon();
            // Save user data along with profile picture path to the database
            $con->prepare("INSERT INTO users (first_name, last_name, birthday, sex, email, user, pass, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture]);
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
        return $con->query("SELECT users.user_id, users.first_name, users.last_name, users.birthday, users.sex, users.user, users.user_profile_picture, CONCAT(user_address.user_street,' ',user_address.user_barangay,' ', user_address.user_city,' ',user_address.user_province,' ') AS address FROM user_address INNER JOIN users ON user_address.user_id = users.user_id")->fetchAll();
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
    $query = $con->prepare("SELECT users.user_id, users.first_name, users.last_name, users.birthday, users.sex, users.user, users.pass, users.user_profile_picture, user_address.user_street, user_address.user_barangay,  user_address.user_city, user_address.user_province FROM user_address INNER JOIN users ON user_address.user_id = users.user_id WHERE users.user_id = ?");
    $query->execute([$user_id]);
    return $query->fetch();
}
catch(PDOException $e){
    return [];
}
}
function UpdateUser($user_id, $fname, $lname, $birthday, $sex, $username, $password) {
    try{
        $con = $this->opencon();
        $query = $con->prepare("UPDATE users SET first_name=?, last_name=?, birthday=?, sex=?, user=?, pass=? WHERE user_id=?");
        return $query->execute([$fname, $lname, $birthday, $sex, $username, $password, $user_id]);
}
catch(PDOException $e){
    $con->rollBack();
    return false;

}
}

function UpdateUserAddress($user_id, $street, $barangay, $city, $province) {
    try{
        $con = $this->opencon();
        $query = $con->prepare("UPDATE user_address SET user_street=?, user_barangay=?, user_city=?, user_province=? WHERE user_id=?");
        return $query->execute([$street, $barangay, $city, $province, $user_id]);
}
catch(PDOException $e){
    $con->rollBack();
    return false;
}
}
function validateCurrentPassword($userId, $currentPassword) {
    // Open database connection
    $con = $this->opencon();

    // Prepare the SQL query
    $query = $con->prepare("SELECT pass FROM users WHERE user_id = ?");
    $query->execute([$userId]);

    // Fetch the user data as an associative array
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // If a user is found, verify the password
    if ($user && password_verify($currentPassword, $user['pass'])) {
        return true;
    }

    // If no user is found or password is incorrect, return false
    return false;
}
function updatePassword($userId, $hashedPassword) {
    $con = $this->opencon();
    $query = $con->prepare("UPDATE users SET pass = ? WHERE user_id = ?");
    return $query->execute([$hashedPassword, $userId]);
}
function updateUserProfilePicture($userID, $profilePicturePath) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE users SET user_profile_picture = ? WHERE user_id = ?");
        $query->execute([$profilePicturePath, $userID]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
     }
     function fetchAvailableCourses($userId) {
        try {
            $con = $this->opencon();
            $query = $con->prepare("
                SELECT c.course_id, c.course_name, c.course_description,
                CASE WHEN e.course_id IS NOT NULL THEN 'Enrolled' ELSE 'Not Enrolled' END AS enrolled_status
                FROM courses c
                LEFT JOIN enrollments e ON c.course_id = e.course_id AND e.user_id = ?
                WHERE e.course_id IS NULL OR e.user_id != ?
            ");
            $query->execute([$userId, $userId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            return [];
        }
    }
    
     function fetchSelectedCourses($selectedCourseIds) {
        try {
            $con = $this->opencon();
            $placeholders = str_repeat('?,', count($selectedCourseIds) - 1) . '?';
            $query = $con->prepare("SELECT course_id, course_name, course_description FROM courses WHERE course_id IN ($placeholders)");
            $query->execute($selectedCourseIds);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            return [];
        }
    }
    
}

