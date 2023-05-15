<?php 
    session_start();
    require 'encrypt.php';
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, sec($_POST['incoming_id']));
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $msg = decrypt($row['msg']);
                $timestamp = $row['msg_date'];
                $date = date( "H:i:s", $timestamp );
                $msg_id = $row['msg_id'];
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div id="outgoing" class="chat outgoing">
                                <div class="details">
                                    <p>'.sec($msg).'<br>
                                        <span class="date_outgoing">'.$date.' UTC
                                            <a class="dustbin" id="dusbin" href="chat?user_id='.$incoming_id.'&delete_message='.$msg_id.'">
                                                Delete
                                            </a>
                                        </span>
                                    </p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div id="incoming" class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'.sec($msg).'<br><span class="date_incoming">'.$date.' UTC</span></p>
                                    
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send messages, they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }
?>