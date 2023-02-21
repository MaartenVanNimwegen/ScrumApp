<?php

class user {
    
    public $id;
    public $naam;
    public $email;
    public $password;
    public $isActivated;
    public $role;
    public $activationCode;

    public function GetUserById($userId, $conn) {
        $query = "SELECT * FROM users WHERE `id`='$userId'";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_object($result, 'user');
    }

    public function GetUserByActivationCode($activationCode, $conn) {
        $query = "SELECT * FROM users WHERE `activationCode`='$activationCode'";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_object($result, 'user');
    }
    
    public function ActivateAccount($user, $password, $conn) {
        if($user->isActivated == 1 && $user->password != null){
            return;
        }
        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET `password` = '$encryptedPassword', `isActivated` = 1 WHERE id = $user->id";
        mysqli_query($conn, $query);
    }

    public function SendUserActivateEmail() {

    }
}