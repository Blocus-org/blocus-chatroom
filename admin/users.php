<?php
    session_start();
    include_once "../php/config.php";
    if(!isset($_SESSION['unique_id'])){
        header("location:../login"); 
    }elseif(!isset($admin_unique_id) && !isset($admin_username) && !isset($admin_password) OR $admin_interface === false){
        if ($_SESSION['unique_id'] !== $admin_unique_id) {
            header("location:../dashboard");
        }else{
            echo "Admin interface is disabled. Modify php/config.php to manage admin interface.<br><a href='../dashboard'>go back to dashboard</a>";
        }
    die();
    }elseif ($_SESSION['unique_id'] !== $admin_unique_id) {
        header("location:../dashboard");
    }

    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "<br>No users to manage at this time";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>