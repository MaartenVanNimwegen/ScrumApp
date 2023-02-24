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
        if($user->isActivated == 0 && $user->password == null) {
            $encryptedPassword = md5($password);
            $query = "UPDATE users SET `password` = ?, `isActivated` = 1, `activatedOn` = now() WHERE id = ?";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_bind_param($stmt, 'si', $encryptedPassword, $user->id);
            mysqli_stmt_execute($stmt);
        }
        else {return;}
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
    
    public function GetAllNames($userId) {
        $groupId = $this->GetGroupId($userId);
        $query = "SELECT naam FROM users INNER JOIN koppelusergroep ON users.id = koppelusergroep.userId WHERE koppelusergroep.groepid = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groupId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $names = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $names[] = $row[0];
        }

        return $names;
        $otherNames = $this->RemoveOwnName($userId, $names);
        return $otherNames;
    }

    public function RemoveOwnName($userId, $names) {
        $user = $this->GetUserById($userId);
        $eigenNaam = $user->naam;
        if (array_search($eigenNaam, $names) != false) {
            unset($names[$eigenNaam]);
        }
        return $names;
    }
    
    public function GetGroupId($userId) {
        $query = "SELECT groepid FROM koppelusergroep WHERE userId = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }

    //send activation email to the user's email address with the activation code
    public function SendUserActivateEmail($email, $name, $activationCode) {
        $subject="Voltooi registratie";
        $body = "Geachte $name,
        
        Er is door een docent een account voor u aangemaakt, dit account moet nog worden geactiveerd. 
        U kunt dit doen door op de onderstaande link te klikken en een wachtwoord aan te maken.

        $activationCode 
        
        Met vriendelijke groet,
        ScrumApp systeem";
        
        mail(implode(',',$email), $subject, $body);
                     
    }
}
