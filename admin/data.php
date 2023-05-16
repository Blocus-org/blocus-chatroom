<br>
<?php
    include_once "../php/config.php";
    if (!isset($_SESSION['unique_id'])) {
        header("location:../login"); 
    }elseif (!isset($admin_unique_id) && !isset($admin_username) && !isset($admin_password) OR $admin_interface === false) {
        if ($_SESSION['unique_id'] !== $admin_unique_id) {
            header("location:../dashboard");
        }else {
            echo "Admin interface is disabled. Take a look to php/config.php to manage admin interface.<br><a href='../dashboard'>go back to dashboard</a>";
        }
    die();
    }elseif ($_SESSION['unique_id'] !== $admin_unique_id) {
        header("location:../dashboard.php");
    }
    while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<div>
                        <div class="user-admin-int">
                            <img class="user-admin-icon" src="../php/images/'. $row['img'] .'" alt="">
                            <p class="text">  '. sec($row['email']).'</p><br>
                            <a class="nuke-img" href ="user-manager?delete_user'.$row['unique_id'].'"><p>Delete user</p></a>
                        </div>
                    </div>';
    }
?>
