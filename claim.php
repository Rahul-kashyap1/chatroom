<?php
$room=$_POST['room'];
if(strlen($room)>20 or strlen($room)<2)
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Please enter between 2 to 20');
    window.location.href='http://localhost/chatroom/';
    </script>");
}

else if(!ctype_alnum($room))
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('please enter an alphanumeric character');
    window.location.href = 'http://localhost/chatroom/';
    </script>");
}

else
{
    include 'db_connect.php';
}
    // check if room already exist 
    $sql="SELECT * FROM `rooms` WHERE roomname='$room'";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('please choose a different name.This room is already claimed');
                window.location.href = 'http://localhost/chatroom/';
            </script>");
        }

        else{
            $sql="INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ('$room', current_timestamp());";
            if(mysqli_query($conn,$sql)){
                $message="Your room is ready and you can chat now";
                echo '<script language="javascript">';
                echo 'alert("'.$message.'");';
                echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';
                echo '</script>';
            }
        }
   }
    

?>