<?php
include '../Classes/scrumGroepClass.php';
include '../Classes/user.php';

function getScrumgroups($conn) 
{
    $stmt = $conn->prepare("SELECT * FROM scrumgroepen");
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();
    return $sql;
}

function getUsersInScrumgroup($scrumgroup, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM koppelusergroep INNER JOIN users ON koppelusergroep.userId = users.id WHERE koppelusergroep.groepid = ?");
    $stmt->bind_param('i', $scrumgroup->id);
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();
    return $sql;
}

function createScrumgroupObject($scrumgroupQuery, $conn)
{            
    foreach ($scrumgroupQuery as $row)
    {
            $scrumgroup = new ScrumGroup($row['0']);
            $scrumgroup->name = $row['1'];
            $scrumgroup->project = $row['2'];
            $scrumgroup->scrummaster = $row['3'];
            $scrumgroup->startDate = $row['4'];
            $scrumgroup->endDate = $row['5'];
            $scrumgroup->archived = $row['6'];
            $userQuery = getUsersInScrumgroup($scrumgroup, $conn);
            $scrumgroup->teamleden = createUserObject($userQuery, $scrumgroup);
            showScrumgroups($scrumgroup);
        }
    }
    
function createUserObject($userQuery, $scrumgroup)
{

    foreach ($userQuery as $row)
    {
        $user = new user();
        $user->id = $row['2'];
        $user->naam = $row['3'];
        $user->email = $row['4'];
        $user->password = $row['5'];
        $user->isActivated = $row['6'];
        $user->role = $row['7'];
        $user->activationCode = $row['8'];
        
        $scrumgroup->teamleden[] = $user;
        
    }
    return $scrumgroup->teamleden;
}
    
function showScrumgroups($scrumgroup)
{
    echo '
        <div class="Scrumgroup">
            <div class="ScrumgroupName">' . $scrumgroup->name . '</div>
            <div class="ScrumgroupProject">' . $scrumgroup->project . '</div>
            <div class="ScrumgroupScrummaster">' . $scrumgroup->scrummaster . '</div>
            <div class="ScrumgroupStartDate">' . $scrumgroup->startDate . '</div>
            <div class="ScrumgroupEndDate">' . $scrumgroup->endDate . '</div>
            <div class="ScrumgroupArchived">' . $scrumgroup->archived . '</div>
            <div class="ScrumgroupTeam">
            ';
            foreach ($scrumgroup->teamleden as $i => $value) 
            {
                echo '<div class"">' . $scrumgroup->teamleden[$i]->naam . '</div>';
            }
    echo "</div></div>";
}

function deleteScrumgroep() 
{
 
}

function addScrumgroep()
{

}

function selectScrummaster($conn)
{
    
}

function accountToevoegen($conn)
{
    if(isset($_POST['submit'])) {

        $naam = $_POST['naam'];
        $email = $_POST['e-mail'];
        $role = $_POST['role'];
        $guid = uniqid();
        
        $query = "INSERT INTO users (`naam`, `email`, `role`, `activationCode`) VALUES ('$naam', '$email', 0, '$guid');";
        $result = mysqli_query($conn, $query);
         }
}