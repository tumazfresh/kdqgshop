<?php

require 'dbcon.php';

if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM tb_messages WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $message = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Message Fetch Successfully by id',
            'data' => $message
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Message Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}



if(isset($_POST['delete_message']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']); 

    $query = "DELETE FROM tb_messages WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Message Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Message Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


?>