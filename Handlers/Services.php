<?php
class Services {
    private $connection;
    
    // Constructor for Services
    function __construct($conn) {
        $this->connection = $conn;
    }

}

class UserServices extends Services{
    private $connection;
    
    // Constructor for UserServices
    public function __construct( $conn ) {
        $this->connection = $conn;
        parent::__construct( $conn );
    }

    // This function returns an user instance of the user with the given id
    public function GetUserById($userId) {
        $query = "SELECT * FROM users WHERE `id`=?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result, 'user');
    }

    // This function returns an user instance of the user with the given activationCode
    public function GetUserByActivationCode($activationCode) {
        $query = "SELECT * FROM users WHERE `activationCode`=?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $activationCode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_object($result, 'user');
    }
    
    // This function activates the account of the given user. It sets the password to the given password and sets the isActivated boolean to true (1)
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
    
    // This function returns 0 if there are no accounts with the given activationCode and returns 1 if there is an account with the given activationCode
    public function CheckIfActivatioCodeExists($activationCode) {
        $query = "SELECT * FROM users WHERE activationCode = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $activationCode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(empty($row)) {
            return 0;
        }
        else {return 1;}
    }

    // This function returns true if the account with the given activationCode is activated and returns false if the account with the given activationCode is not activated
    public function IsActivated($activationCode) {
        $query = "SELECT `isActivated` FROM users WHERE `activationCode` = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $activationCode);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $gefetchsteResult = mysqli_fetch_array($result);
        return $gefetchsteResult['isActivated'];
    }
    
    // This function returns an array with all the names of the members that are in the same group as the given user
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
    }

    // This function removes the given name from the given names array
    public function RemoveOwnName($eigenNaam, $names) {
        if (($key = array_search($eigenNaam, $names)) !== false) {
            unset($names[$key]);
        }
        return $names;
    }
    
    // This function returns the groepId of the group where the given user is in
    public function GetGroupId($userId) {
        // Gets all groeps where the user is in
        $query = "SELECT groepid FROM koppelusergroep WHERE userId = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        // Makes a new instantie of the groepServices class
        $groepService = new GroepServices($this->connection);

        // Foreach groep check witch is active
        foreach ($row as $groep) {
            if($groepService->IsGroepActive($groep)) {
                return $groep;
            }
        }
    }

    // This function returns the scrummasterId of the group where the given user is in
    public function GetScrummasterId($groepId) {
        $query = "SELECT scrummaster FROM scrumgroepen WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groepId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['scrummaster'];
    }

    // This function saves all the given data from a Retrospective
    public function SaveRetro($userId, $groepId, $scrummasterId, $coachId, $currentWeek, $bijdrage, $meerwaarden, $tegenaan, $tips, $tops) {
        $tips = $this->FormatTipsAndTops($tips);
        $tops = $this->FormatTipsAndTops($tops);
        $query = "INSERT INTO retros (`userId`, `groepId`, `scrummasterId`, `coatchId`, `datum`, `bijdrage`, `meerwaarden`, `tegenaan`, `tips`, `tops`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'iiiissssss', $userId, $groepId, $scrummasterId, $coachId, $currentWeek, $bijdrage, $meerwaarden, $tegenaan, $tips, $tops);
        mysqli_stmt_execute($stmt);
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        return $affectedRows;
    }

    // This function saves all the given data from a Review
    public function SaveReview($userId, $groepId, $scrummasterId, $productownerId, $currentWeek, $backlogitems, $demonstreren, $samenwerking, $todoitems) {
        $query = "INSERT INTO reviews (`userId`, `groepId`, `scrummasterId`, `productownerId`, `datum`, `backlogitems`, `demonstreren`, `samenwerking`, `todoitems`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'iiiisssss', $userId, $groepId, $scrummasterId, $productownerId,$currentWeek, $backlogitems, $demonstreren, $samenwerking, $todoitems);
        mysqli_stmt_execute($stmt);
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        return $affectedRows;
    }

    // This function makes one string of the given array and splits the pieces by |.
    public function FormatTipsAndTops($array) {
        $stringOfArray = implode("| ", $array);
        return $stringOfArray;
    }

    // This function sends an activation email to the given emailaddress with the given activationCode
    public function SendUserActivateEmail($email, $name, $activationCode) {
        include 'config/config.php';
        $root = $url;
        $link = $root . $activationCode;
        $subject="Voltooi registratie";
        $body = "Geachte $name,
        
        Er is door een docent een account voor u aangemaakt, dit account moet nog worden geactiveerd. 
        U kunt dit doen door op de onderstaande link te klikken en een wachtwoord aan te maken.

        $link 
        
        Met vriendelijke groet,
        ScrumApp systeem";
        
        mail($email, $subject, $body);
                    
    }
}

class GroepServices extends Services {
    private $connection;
    
    // Constructor for GroepServices
    public function __construct( $conn ) {
        $this->connection = $conn;
        parent::__construct( $conn );
    }

    // Checks whether a user is in an active groep. Returns 1 if true and 0 if false
    public function IsInActiveGroep($userId) {
        $query = "SELECT groepid FROM koppelusergroep WHERE userId = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $groepid) {
            $isGroepActive = $this->IsGroepActive($groepid);
            if ($isGroepActive) {
                return $isGroepActive;
            }
        }
    }

    // Checks if user is in active groep 
    public function IsGroepActive($groepId) {
        $query = "SELECT endDate FROM scrumgroepen WHERE id = ? AND endDate > NOW()";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groepId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)) {
            return 1;
        }
        else {
            return 0;
        }
    }

    // Returns the current week of the progress. If in first week returns 0, if in second week returns 1 etc...
    public function CurrentWeek($groepId) {
        $query = "SELECT * FROM scrumgroepen WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groepId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $start_date = date('Y-m-d', strtotime($row['startDate']));
        $end_date = date('Y-m-d', strtotime($row['endDate']));
        $current_date = date('Y-m-d');

        $total_weeks = floor((strtotime($end_date) - strtotime($start_date)) / (7 * 24 * 60 * 60));
        $elapsed_weeks = floor((strtotime($current_date) - strtotime($start_date)) / (7 * 24 * 60 * 60));
        return $elapsed_weeks;
    }

    // Returns 1 if the user already filled in a retro this week of the project, and 0 if the user has not already filled in a retro this week of the project.
    public function FilledRetro($groepId) {
        // Gets the start and end date from the users scrumgroep
        $query = "SELECT * FROM scrumgroepen WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groepId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        // Set the start and end dates of the project
        if(!empty($row)) {
            // Get the current week number
            $currentWeek = $this->CurrentWeek($groepId);
            
            // Checks if the retro is already filled in
            $hasFilledIn = $this->CheckRetroWithWeekNumber($groepId, $currentWeek);
    
            if($hasFilledIn) {
                return 1;
            }
            else {return 0;}
        }
        else {
            return new Exception("De gegeven gebruiker zit niet in een scrum groep");
        }
    }

    // Returns 1 if the user already filled in a review this week of the project, and 0 if the user has not already filled in a retro this week of the project.
    public function FilledReview($groepId) {
        // Gets the start and end date from the users scrumgroep
        $query = "SELECT * FROM scrumgroepen WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $groepId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        // Set the start and end dates of the project
        if(!empty($row)) {    
            // Get the current week number
            $currentWeek = $this->CurrentWeek($groepId);
            
            // Checks if the retro is already filled in
            $hasFilledIn = $this->CheckReviewWithWeekNumber($groepId, $currentWeek);
    
            if($hasFilledIn) {
                return 1;
            }
            else {return 0;}
        }
        else {
            return new Exception("De gegeven gebruiker zit niet in een scrum groep");
        }
    }

    // Returns 1 if there is a retro with the given groepId and CurrentWeek
    public function CheckRetroWithWeekNumber($groepId, $currentWeek) {
        $query = "SELECT * FROM retros WHERE groepId = ? AND datum = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $groepId, $currentWeek);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)) {
            return 1;
        }
        else {return 0;}
    }
    
    // Returns 1 if there is a recview with the given groepId and CurrentWeek
    public function CheckReviewWithWeekNumber($groepId, $currentWeek) {
        $query = "SELECT * FROM reviews WHERE groepId = ? AND datum = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $groepId, $currentWeek);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)) {
            return 1;
        }
        else {return 0;}
    }
}
?>