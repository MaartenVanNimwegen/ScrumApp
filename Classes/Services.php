<?php
class Services {
    private $connection;
    
    function __construct($conn) {
        $this->connection = $conn;
    }

}

class UserServices extends Services{
    private $connection;
    public function __construct( $conn ) {
        $this->connection = $conn;
        parent::__construct( $conn );
    }
    public function GetUserById($userId) {
        $query = "SELECT * FROM users WHERE `id`=?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result, 'user');
    }

    public function GetUserByActivationCode($activationCode) {
        $query = "SELECT * FROM users WHERE `activationCode`=?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $activationCode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result, 'user');
    }
    
    public function ActivateAccount($user, $password) {
        if($user->isActivated == 1 && $user->password != null) {
            return;
        }
        $encryptedPassword = md5($password);
        $query = "UPDATE users SET `password` = ?, `isActivated` = 1 WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'si', $encryptedPassword, $user->id);
        mysqli_stmt_execute($stmt);
    }

    public function IsActivated($activationCode) {
        $query = "SELECT `isActivated` FROM users WHERE `activationCode` = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $activationCode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $gefetchsteResult = mysqli_fetch_array($result);
        return $gefetchsteResult['isActivated'];
    }

    public function SendUserActivateEmail($email, $activationCode) {
        // send activation email to the user's email address with the activation code
    }
}
