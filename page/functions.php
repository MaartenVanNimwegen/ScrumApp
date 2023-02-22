<?php
include 'Classes/scrumGroepClass.php';

function getScrumgroups($conn) 
{
        $stmt = $conn->prepare("SELECT * FROM scrumgroepen");
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
            createUserObject($userQuery);
            showScrumgroups($scrumgroup);
        }
}

function showScrumgroups($scrumgroup)
{
        echo '
        <div class="Scrumgroep">
            <div class="ScrumgroepNaam">' . $scrumgroup->name . '</div>
            <div class="ScrumgroepProject">' . $scrumgroup->project . '</div>
            <div class="ScrumgroepScrummaster">' . $scrumgroup->scrummaster . '</div>
            <div class="ScrumgroepStartDate">' . $scrumgroup->startDate . '</div>
            <div class="ScrumgroepEndDate">' . $scrumgroup->endDate . '</div>
            <div class="ScrumgroepArchived">' . $scrumgroup->archived . '</div>
        </div>
        ';
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

function createUserObject($userQuery)
{
    
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