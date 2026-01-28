<?php
function signUp($connection, $username, $password) {
    $check_query = "SELECT * FROM login WHERE username='$username'";
    $result = mysqli_query($connection, $check_query);

    if(mysqli_num_rows($result) > 0) {
        return "Account name already taken";
    } else {
        $insert_query = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
        mysqli_query($connection, $insert_query);
        return "Account created successfully";
    }
}

function removeAccount($connection, $username, $password) {
    $check_query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $check_query);

    if(mysqli_num_rows($result) == 0) {
        return "Account not found";
    } else {
        $delete_query = "DELETE FROM login WHERE username='$username'";
        mysqli_query($connection, $delete_query);
        return "Account removed successfully";
    }
}
?>
