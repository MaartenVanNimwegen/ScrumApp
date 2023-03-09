<?php


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
    foreach ($scrumgroupQuery as $row) {
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

    foreach ($userQuery as $row) {
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
    foreach ($scrumgroup->teamleden as $i => $value) {
        echo '
            <div class"">
                <div class"">' . $scrumgroup->teamleden[$i]->naam . '</div>
                <div class""><a href="scrumDashboard.php?deleteUserId=' . $scrumgroup->teamleden[$i]->id . '">Verwijder lid</a></div>
                <div class""><a href="scrumDashboard.php?ScrummaserUserId=' . $scrumgroup->teamleden[$i]->id . '&ScrumgroupId=' . $scrumgroup->id . '">Maak scrummaster</a></div>
            </div>
        ';
    }

    echo "
            <div class''><a href='scrumDashboard.php?addUserId=" . $scrumgroup->id . "'>Voeg lid toe</a></div>
            </div>
            <div class''><a href='scrumDashboard.php?deleteScrumgroupId=" . $scrumgroup->id . "'>Verwijder scrumgroup</a></div>
    </div>";
}

function deleteScrumgroep($conn, $scrumgroupID)
{
    $stmt = $conn->prepare("DELETE FROM koppelusergroep WHERE groepid = ?");
    $stmt->bind_param('i', $scrumgroupID);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM scrumgroepen WHERE id = ?");
    $stmt->bind_param('i', $scrumgroupID);
    $stmt->execute();
    $stmt->close();
}

function deleteUserFromScrumgroup($conn, $userID)
{
    $stmt = $conn->prepare("DELETE FROM koppelusergroep WHERE userId = ?");
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $stmt->close();
}

function addUserToScrumgroup($conn, $user, $scrumgroupID)
{
    echo "$user $scrumgroupID";

    $stmt = $conn->prepare("SELECT id FROM users WHERE naam = ?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();
    $UserID = implode(", ", $sql[0]);

    $stmt = $conn->prepare("INSERT INTO `koppelusergroep` (`userId`, `groepid`) VALUES (?,?)");
    $stmt->bind_param('ii', $UserID, $scrumgroupID);
    $stmt->execute();

    $stmt->close();
}

function addScrumgroup($conn, $scrumgroupName, $scrumgroupProject, $startDate, $endDate)
{
    $scrummaster = 1;
    $stmt = $conn->prepare("INSERT INTO `scrumgroepen` (`naam`, `projectNaam`, `scrummaster`, `startDate`, `endDate`) VALUES (?,?,?,?,?)");
    $stmt->bind_param('ssiss', $scrumgroupName, $scrumgroupProject, $scrummaster, $startDate, $endDate);
    $stmt->execute();

    $stmt->close();
}

function selectScrummaster($conn, $UserID, $scrumgroupID)
{
    $stmt = $conn->prepare("UPDATE `scrumgroepen` SET `scrummaster` = ? WHERE id = ?");
    $stmt->bind_param('si', $UserID, $scrumgroupID);
    $stmt->execute();
}

function accountToevoegen($conn)
{
    include('services.php');
    if (isset($_POST['submit'])) {

        $naam = $_POST['naam'];
        $email = $_POST['e-mail'];
        $role = $_POST['role'];
        $guid = uniqid();
        
        $query = "INSERT INTO users (`naam`, `email`, `role`, `activationCode`) VALUES ('$naam', '$email', $role, '$guid');";
        $result = mysqli_query($conn, $query);
         

         $userService = new UserServices($conn);
         $userService->SendUserActivateEmail($email, $naam, $guid);
        header('Location: Account-dashboard.php');

        }
}

function accountVerwijderen($id_to_delete, $conn)
{
    $sql = "DELETE FROM users WHERE id = $id_to_delete";
    $result = mysqli_query($conn, $sql);
}

