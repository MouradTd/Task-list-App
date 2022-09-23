<?php

include("Connect.php");

session_start();


if(!isset($_SESSION["username"]))
{
	header("location:index.php");
}

?>





<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>home</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
 
  <body>
    <div class="circle"></div>
    <style>
        *{ font-family:Poppins, sans-serif}
    
        body {
            background: linear-gradient(to right top, #7AC6F6, #f1f8fc);
    min-height: 100vh;
    }   
    .container{  
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.46);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(1.5px);
        -webkit-backdrop-filter: blur(1.5px);
        border: 1px solid rgba(255, 255, 255, 0.15);    
        border-radius: 1rem;
        margin-top: 3rem;
        padding-top: 1rem;
    } 
    table tr th td{
        /* From https://css.glass */
      background: rgba(255, 255, 255, 0.46);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(1.5px);
      -webkit-backdrop-filter: blur(1.5px);
      border: 1px solid rgba(255, 255, 255, 0.15);
    }
    a {
    padding-right:10px ;
   }
   button:hover {
    background-color: #fff !important;
    color: black !important;
    border-color: #fff !important;
}
   
    </style>
    <!-- Add Task Modal -->
  <div class="modal fade" id="AddTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"> Add Task</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <form id="savetask">
       <div class="modal-body">

       <div id="errorMessage" class="alert alert-warning d-none"></div>
        <div class="mb-3">
            <label for="">Task</label>
            <input type="text" name="task" class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
               <option value="Done">Done</option>
               <option value="Undone">Undone</option>
            </select>        
        </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Save Task</button>
       </div>
       </form>
     </div>
   </div>
 </div>
<!-- Edit Task Modal -->
<div class="modal fade" id="EditTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Task </h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <form id="updatetask">
       <div class="modal-body">

       <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
       <input type="hidden" name="idt" id="idt">
        <div class="mb-3">
            <label for="">Task</label>
            <input type="text" name="task" id="task" class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="">Status</label>
            <select class="form-select" aria-label="Default select example" name="status" id="status">
               <option value="Done">Done</option>
               <option value="Undone">Undone</option>
            </select>        
        </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Edit Task</button>
       </div>
       </form>
     </div>
   </div>
 </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <button type="button" class="btn btn-outline-dark btn-lg float-end" data-bs-toggle="modal" data-bs-target="#AddTaskModal">
                              Add Task
                           </button>
                           <a href="logout.php"class="btn btn-outline-danger btn-lg " id="a">Log out</a>
                           <br><br>
                <div class="">
                    <div class="" style="padding-left:27rem;padding-bottom:1rem; ">
                        <h3 >Welcome,<?php echo $_SESSION["username"] ?> to your task-list
                            <!-- Button trigger modal -->
                          

                        </h3>
                    </div>
                    <div >
                        <table id="table"class="table table-striped table-bordered" >
                            <thead>
                                <tr>
                                    
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th class=""float-end>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select b.* from tb_user t, tb_todos b where t.Id = b.idu and t.username ='".$_SESSION["username"]."' ";
                                $result=mysqli_query($con, $query);
                                if(mysqli_num_rows($result)>0){
                                    foreach ($result as $task ) {
                                        ?>
                                        <tr>
                                            <td><?= $task['todo']?></td>
                                            <td><?= $task['status']?></td>
                                            <td>
                                                <button type="button" value="<?=$task['idt'];?>"class="editTaskbtn btn btn-outline-info btn-sm  ">Edit</button>
                                                <button type="button" value="<?=$task['idt'];?>"class="deleteTaskbtn btn btn-outline-danger btn-sm  ">Delete</button>

                                            </td>

                                        </tr>
                                        <?php

                                    }
                                }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Links for Bootstrap and JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- Alertify JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).on('submit','#savetask', function(e){
            e.preventDefault(); 

            var formData = new FormData(this);
            formData.append('save_task',true);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData:false,
                contentType:false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.stat == 422)
                    {

                        $('#errorMessage').removeClass('d-none');
                         $('#errorMessage').text(res.message);
                    }
                    else if((res.stat == 200))
                    {
                        $('#errorMessage').addClass('d-none');
                        $('#AddTaskModal').modal('hide');
                        $('#savetask')[0].reset();
                        alertify.set('notifier','position', 'top-center');
                        alertify.success(res.message);
                        $('#table').load(location.href + " #table");
                    }
                }
            });
        });

        $(document).on('click','.editTaskbtn', function () {
            var task_id = $(this).val();
            //alert(task_id);
            $.ajax({
                type: "GET",
                url: "code.php?task_id=" + task_id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.stat == 404)
                    {
                        alert(res.message);
                    }
                    else if((res.stat == 200))
                    {
                        $('#idt').val(res.data.idt);
                        $('#task').val(res.data.todo);
                        $('#status').val(res.data.status);
                        $('#EditTaskModal').modal('show');
                    }
                }
            });
        });

        $(document).on('submit','#updatetask', function(e){
            e.preventDefault(); 

            var formData = new FormData(this);
            formData.append('update_task',true);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData:false,
                contentType:false,
                success: function (response) {
                     var res = jQuery.parseJSON(response);
                     if(res.stat == 422)
                     {

                         $('#errorMessageUpdate').removeClass('d-none');
                          $('#errorMessageUpdate').text(res.message);
                     }
                     else if((res.stat == 200))
                     {
                         $('#errorMessageUpdate').addClass('d-none');
                         $('#EditTaskModal').modal('hide');
                         $('#updatetask')[0].reset();
                         alertify.set('notifier','position', 'top-center');
                        alertify.success(res.message);
                         $('#table').load(location.href + " #table");
                     }
                }
            });
        });

        $(document).on('click','.deleteTaskbtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this Task ?')){

                var task_id = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_task':true,
                        'task_id':task_id
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                    if(res.stat == 500)
                    {
                        alertify.set('notifier','position', 'top-center');
                        alertify.error(res.message);
                    }else{
                        alertify.set('notifier','position', 'top-center');
                        alertify.error(res.message);
                        $('#table').load(location.href + " #table");

                    }
                    }
                });
            }
        });
    </script>
  </body>
</html>