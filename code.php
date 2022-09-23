<?php

session_start();
include("Connect.php");



if(isset($_POST['delete_task'])){

    $task_id = $_POST['task_id'];

    $sql="DELETE FROM tb_todos WHERE idt = '$task_id'";
    $resut=mysqli_query($con, $sql);
    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Task Deleted Succesfully',
        ];
        echo json_encode($res);
        return false;   

    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Task not Deleted'
        ];
        echo json_encode($res);
        return false;   
    }
}





if(isset($_POST['update_task'])){

    $task_id = $_POST['idt'];
    $task=$_POST['task'];
    $status=$_POST['status'];
    
    $sql0="SELECT id FROM `tb_user` where username = '".$_SESSION['username']."';";
    $result=mysqli_query($con, $sql0);
    if($result){
       while($row=mysqli_fetch_assoc($result)){
           $idu=$row['id'];
       }
    }

    if($task == NULL || $status == NULL){
        $res = [
            'stat' => 422,
            'message' => 'All fields must be filled'
        ];
        echo json_encode($res);
        return false;    
    }
    $sql="UPDATE tb_todos SET todo ='$task',status = '$status' WHERE idt = '$task_id'";
    $resut=mysqli_query($con, $sql);

    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Task updated succesfully'
        ];
        echo json_encode($res);
        return ; 
    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Error,Task not processed'
        ];
        echo json_encode($res);
        return false; 
    }



}





if(isset($_GET['task_id'])){
    
    $task_id = mysqli_real_escape_string($con,$_GET['task_id']);
    
    $query1 = "SELECT idt,todo,status FROM tb_todos WHERE idt ='$task_id' ";
    $query_run1 = mysqli_query($con,$query1);
    
    if(mysqli_num_rows($query_run1) == 1){
        $task1 = mysqli_fetch_array($query_run1);
        $res = [
            'stat' => 200,
            'message' => 'Task Found by Id',
            'data' => $task1
        ];
        echo json_encode($res);
        return false;   

    }
    else{
        $res = [
            'stat' => 404,
            'message' => 'Task Id not found'
        ];
        echo json_encode($res);
        return false;   
    }

}




if(isset($_POST['save_task'])){

    $task=$_POST['task'];
    $status=$_POST['status'];
    
    $sql0="SELECT id FROM `tb_user` where username = '".$_SESSION['username']."';";
    $result=mysqli_query($con, $sql0);
    if($result){
       while($row=mysqli_fetch_assoc($result)){
           $idu=$row['id'];
       }
    }

    if($task == NULL || $status == NULL){
        $res = [
            'stat' => 422,
            'message' => 'All fields must be filled'
        ];
        echo json_encode($res);
        return false;    
    }
    $sql="INSERT INTO tb_todos (idu,todo,status) VALUES ('$idu','$task','$status')";
    $resut=mysqli_query($con, $sql);

    if($resut){
        $res = [
            'stat' => 200,
            'message' => 'Task created succesfully'
        ];
        echo json_encode($res);
        return ; 
    }
    else{
        $res = [
            'stat' => 500,
            'message' => 'Error,Task not created'
        ];
        echo json_encode($res);
        return false; 
    }



}







?>