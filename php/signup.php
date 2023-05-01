<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, sec($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, sec($_POST['lname']));
    $email = mysqli_real_escape_string($conn, sec($_POST['email']));
    $password = mysqli_real_escape_string($conn, sec($_POST['password']));
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(isset($email)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This pseudo already exist!";
            }else{
                if(empty($_FILES['image']['tmp_name'])){
                    $ran_id = rand(time(), 100000000);
                    $status = "Active now";
                    $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);
                    $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                    VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', 'default.png', '{$status}')");
                    if($insert_query){
                        $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($select_sql2) > 0){
                            $result = mysqli_fetch_assoc($select_sql2);
                            $_SESSION['unique_id'] = $result['unique_id'];
                            echo "success";
                        }else{
                            echo "This pseudo not Exist!";
                        }
                    }else{
                        echo "Something went wrong. Please try again!";
                    }
                }else{
                    $img = $_FILES['image'];
                    $img_name = sec($img['name']);
                    $img_type = $img['type'];
                    $tmp_name = $img['tmp_name'];
                    $fileSize = filesize($tmp_name);
                    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                    $filetype = finfo_file($fileinfo, $tmp_name);
                    $img_explode = explode('.',$img_name);
                    $time = time();
                    $new_img_name = $time.$img_name;
                    $types = ["image/jpeg" => "jpeg", "image/jpg" => "jpg", "image/png" => "png", "image/JPEG" => "JPEG", "image/JPG" => "JPG", "image/PNG" => "PNG"];
                    if(in_array($filetype, array_keys($types))) {
                        if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                            $ran_id = rand(time(), 100000000);
                            $status = "Active now";
                            $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                            VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                            if($insert_query){
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($select_sql2) > 0){
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo "success";
                                }else{
                                    echo "This pseudo not Exist!";
                                }
                            }else{
                                echo "Something went wrong. Please try again!";
                            }
                        }
                    }               
                }
            }
        }
    }else{
                echo "All input fields with a ' * ' are required!";
    }
?>