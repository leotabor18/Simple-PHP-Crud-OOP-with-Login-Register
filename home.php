<?php 
  session_start();
  if(!isset($_SESSION['fullname'])){
    header("Location: ../index.php");
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/stylesheet.css">
 
    <title>PHP CRUD</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="../Javascript/jquery-3.6.0.js"></script> 
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg p-1 navbar-dark shadow-sm rounded">
        <div class="container-fluid">
            <a class="navbar-brand"><h2>My Online Diary</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item me-4">
                        <a class="nav-link " aria-current="page" data-bs-toggle="modal" data-bs-target="#Modal">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid main" >
        <div class="row justify-content-center mt-3 me-1">
            <div class="col-lg-7 col-sm-9 col-md-8 align-self-center  ">
            <div class="border p-4 bg-light bg-gradient shadow-sm p-3 mb-2 bg-body rounded d-flex flex-column">
              <h1>Hi <?php echo $_SESSION['fullname']?>!</h1>
              <h4>How's your day going?</h4>
            </div>
            <?php 
                require 'Crud.php';
                $crud = new Crud();
                ?>
            <form method="post" class="form-main border bg-gradient shadow-sm px-4 pt-2 pb-3 mb-2 bg-body rounded">
                <div class="mb-3">
                    <label for="name" class="form-label"></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter title" value="">
                  </div>
                <div class="float-form form-floating">
                    <textarea class="form-control" placeholder="Leave a thoughts here" name="thoughts" id="thoughts" style="height: 100px"></textarea>
                    <label for="thoughts" id="label-thoughts">Your thoughts?</label>
                </div>
                <div class="mt-2 d-flex justify-content-between">
                    <small class="error"></small>
                    <button type="submit" id="btn-submit" class=" btn btn-primary" name="submit" >Save</button>
                  </div>
            </form> 
            
            <div id="parent">
              <?php 
              if(isset($_GET['id'])){
                $data = $crud->_read($_GET['id']);
                if($data > 0){
                  foreach($data as $row){?>
                      <div id="<?php echo $row['id']?>" class="bg-light bg-gradient shadow-sm mb-2 bg-body rounded">
                        <div class="p-3 pb-0 d-flex justify-content-between align-items-center border-bottom">
                          <div>
                            <h5 class="head"><b><?php echo $row['name']?></b></h5>
                          </div>
                          <div class="icon d-flex">
                            <form method="post">
                              <button name="crud_update" type="submit" class="btn p-0" value="<?php echo $row['id']?>"><i class="far fa-edit"></i></button>
                            </form>
                              <button name="crud_delete" value="<?php echo $row['id']?>&&user_id=<?php echo $_GET['id']?>" class="btn-delete btn pt-0 pb-0 px-1" data-bs-toggle="modal" data-bs-target="#Modal-delete"><i class="fas fa-times" ></i></button>
                          </div>
                        </div>
                        <div class="my-2 p-3 d-flex align-items-start flex-column">
                        <em><h5>"<?php echo $row['data_input']?>"</h5></em>
                          <small><?php echo $row['date']?></small>
                        </div>
                      </div>
                      <?php }
                      }
                  }
                  if(isset($_GET['id'])){
                    $crud->_create($_GET['id']);
                    if(isset($_POST['crud_update'])){
                      $id = $_POST['crud_update']; 
                      
                      $query = $crud->_connect()->query("SELECT * FROM thoughts WHERE id='$id'");
                      foreach($query as $row){
                        echo  "<script>
                          document.getElementById(".$id.").innerHTML = ".'"<form method=\"POST\" class=\"border bg-gradient shadow-sm px-4 pt-2 pb-3 mb-2 bg-body rounded\"><div class=\"mb-3\"><label for=\"name\" class=\"form-label\"></label><input type=\"text\" class=\"form-control\" id=\"name-input\" name=\"name\" value=\"'.$row['name'].'\"></div><div class=\"form-group\"><textarea class=\"form-control\" name=\"thoughts\" id=\"thoughts-input\" rows=\"3\">'.$row['data_input'].'</textarea></div><div class=\"d-flex justify-content-between align-items-center\"><small class=\"error\" id=\"error\"></small><div class=\"mt-2 d-flex justify-content-end\"><button class=\"btn btn-secondary me-1\" name=\"cancel\" >Cancel</button><button class=\"btn btn-primary\" id=\"btn-update\" name=\"update\" value=\"'.$id.'\" >Save</button></div></div></form>"'."
                          </script>"; 
                    }
                    
                    } 
                    if(isset($_POST['update'])){
                      $crud->_update($_POST['update']); 
                    }
                  }
                                  
                  ?>
                </div>
            </div>
        </div>
        <footer class="container-fluid developer d-flex justify-content-end align-items-end flex-column">
            <small class="m-0">a Simple PHP Crud website with Login/Register System</small>
            <small class="m-0">Built by Leonardo Tabor</small> 
    </footer>
    </div>   

    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action='/php crud/logout.php' method='POST'>
              <button type="submit" class="btn btn-primary" name="logout">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="Modal-delete" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form  id='form-delete' method='POST'>
              <button type="submit" class="btn btn-primary" name="logout">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>

   <script src="./Javascript/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>