<?php
function accountToevoegen($conn)
{
    if (isset($_POST['submit'])) {

        $naam = $_POST['naam'];
        $email = $_POST['e-mail'];
        $role = $_POST['role'];
        $guid = uniqid();
        
        $query = "INSERT INTO users (`naam`, `email`, `role`, `activationCode`) VALUES ('$naam', '$email', $role, '$guid');";
        $result = mysqli_query($conn, $query);
         

         $userService = new UserServices($conn);
         $userService->SendUserActivateEmail($email, $naam, $guid);
        }
}

function accountVerwijderen($id_to_delete, $conn)
{
    $sql = "DELETE FROM users WHERE id = $id_to_delete";
    $result = mysqli_query($conn, $sql);
}

