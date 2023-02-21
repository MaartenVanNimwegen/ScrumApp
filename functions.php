<?php

function ScrumgroepenTonen($conn)
{

    $stmt = $conn->prepare("SELECT * FROM scrumgroepen /* WHERE ID = ? */");
    /*$stmt->bind_param('i', );*/
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();

    foreach ($sql as $row)
    {
        echo "
        <div class='ScrumDashboardGroepjes'>
            <div class=''>$row[1]</div>
            <div class=''>$row[2]</div>
            <div class=''>$row[3]</div>
            <div class=''>
                <div class=''></div>
                
                <form class='' method='post' action='scrumDashboard.php?Groep=$row[0]'>
                <input type='submit' value=' $row[1] Wijzigen' name='Lampwijzigen'class='Lampenoverzichtbutton'>
                </form>
                <form class='' method='post' action='scrumDashboard.php?deleteID=$row[0]'>
                <input type='submit' value=' $row[1] Verwijderen'  name='Lampverwijderen'class='Lampenoverzichtbutton'>
                </form>
                <div class=''></div>
            </div>
        </div>
        ";
    }
}

function DeleteScrumgroep() 
{
 
}

function AddScrumgroep()
{

}

function accountToevoegen($conn)
{
    if(isset($_POST['submit'])) {

        $naam = $_POST['naam'];
        $email = $_POST['e-mail'];
        $role = $_POST['role'];
        $guid = uniqid();
        
        var_dump($naam, $email, $role, $guid);
        $query = "INSERT INTO users (`naam`, `email`, `role`, `activationCode`) VALUES ('$naam', '$email', 0, '$guid');";
        $result = mysqli_query($conn, $query);
         }
}