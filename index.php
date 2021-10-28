<?php

$insert = false;   
$update = false;   
$delete = false;   

$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    echo "sorry connection was not successfull".mysqli_connect_error();
}

if(isset($_GET['delete'])){
  $slno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `slno` = $slno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 
  if(isset($_POST['slnoEdit'])){
    // echo "Yes";
    $slno = $_POST["slnoEdit"];
    $title = $_POST["titleEdit"];
    $Description = $_POST["DescriptionEdit"];

    $sql = "UPDATE `notes` SET `title` = '$title', `Description` = '$Description' WHERE `notes`.`slno` = $slno";
    
    $result = mysqli_query($conn, $sql); 

    if($result){
      // echo "We updated the record successfully";
      $update = true;
    }
    else{
      echo "We could not update the record successfully";
    }
  }
  else{ 

    
    $title = $_POST["title"];
    $Description = $_POST["Description"];
    
    $sql = "INSERT INTO `notes` (`title`, `Description`) VALUES ('$title', '$Description')";
    
    $result = mysqli_query($conn, $sql);
    
    if($result){
      // echo "<br>The record has been inserted successfully";
      $insert = true;
    }
    else{
      echo "<br>The record was not inserted successfully because of this error--->".mysqli_error($conn);
    }
  }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous">
    </script>
    
    
    <title>Note Making Site</title>

  </head>
  <body>
 <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Model
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/CRUD/index.php" method="post">
      <div class="modal-body">
      <input type="hidden" name="slnoEdit" id="slnoEdit">
            <div class="mb-3"> 
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="titleEdit" id="titleEdit" aria-describedby="emailHelp">
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" placeholder="Type here" id="DescriptionEdit" name="DescriptionEdit" style="height: 100px"></textarea>
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="/crud/image.png" height="42px" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      
      <?php
        if($insert){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your note has been inserted successfully.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
      }
      ?>
      <?php
        if($delete){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your note has been deleted successfully.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
      }
      ?>
      <?php
        if($update){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Success!</strong> Your note has been updated successfully.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
      }
      ?>

      <div class="container my-5">
          <h2>Add a Note</h2>
          <form action="/CRUD/index.php" method="post">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" placeholder="Type here" id="Description" name="Description" style="height: 100px"></textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-primary my-3">Add Note</button>
              </div>
            </form>
          </div>
          
          <div class="container my-4">
            
            
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">Sl.No</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
  <tbody>
    <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);

        $slno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $slno = $slno + 1;
          // echo var_dump($row);
          echo "<tr>
          <th scope='row'>".$slno."</th>
          <td>".$row['title']."</td>
          <td>".$row['Description']."</td>
          <td> <button class='edit btn btn-sm btn-primary' id=".$row['slno'].">Edit</button>
           <button class='delete btn btn-sm btn-primary' id=d".$row['slno'].">Delete</button> </td>  
          </tr>";
        }
        
        
        
        ?>
    
  </tbody> 
</table>
</div>
<hr>

      
      <!-- <h1>Hello, world!</h1> -->
      
      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
  </script>

<script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
        console.log("edit", );   
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        Description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, Description);
        titleEdit.value = title;
        DescriptionEdit.value = Description;
        slnoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle'); 
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
        console.log("edit", );   
        slno = e.target.id.substr(1,);
        
        
        if(confirm("Are you sure you want to delete this note")){
          console.log("yes");
          window.location = `/crud/index.php?delete=${slno}`;
        }
        else{
          console.log("no");
        }
        })
      })
    </script>

  </body>
</html> 