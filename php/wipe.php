<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $unique_id = sec($_SESSION['unique_id']);
        $delete_account = mysqli_real_escape_string($conn, sec($_GET['delete_account']));
        if(isset($delete_account)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id= '{$delete_account}'");
            $row = mysqli_fetch_assoc($sql);
            if($unique_id == $row['unique_id']){
                $sql2 = mysqli_query($conn, "DELETE FROM users WHERE unique_id= '{$delete_account}'");
                $sql3 = mysqli_query($conn, "DELETE FROM messages WHERE outgoing_msg_id= '{$delete_account}'");
            }else{
                $sql2 = mysqli_query($conn, "DELETE FROM users WHERE unique_id= '{$unique_id}'");
                $sql3 = mysqli_query($conn, "DELETE FROM messages WHERE outgoing_msg_id= '{$unique_id}'");
                    echo '
                    <p class="fyou">Are you trying to delete somone eles\'s account? <br> This is not very kind of you... So yours has been deleted instead, have a nice day :)</p>
                    <style>
                        .fyou{
                            background-color: Red !important;
                            color: black !important;
                            margin: auto !important;
                        }
                    </style>';
                if($sql2 && $sql3){
                    session_unset();
                    session_destroy();
                }
                die();
            }
            if($sql2 && $sql3){
                session_unset();
                session_destroy();
                header("location: ../index.php?bye=true");
            }
        }else{
            header("location: ../dashboard.php?del=false");
        }
    }else{  
        header("location: ../login.php?isconnected=false");
    }
?>