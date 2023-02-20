<?php

class user {
    public $id;
    public $naam;
    public $email;
    public $password;
    public $isActivated;
    public $role;
    public $activationCode;

    public function GetUserByActivationCode($activationCode, $conn) {
        $query = "SELECT * FROM users WHERE `activationCode`='$activationCode'";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_object($result, 'user');
    }

    public function ActivateAccount($user) {
        if($user->isActivated == 1 && $user->password != null){
            return;
        }

        $query = "";
        $result = mysqli_query($conn, $query)
    }
}