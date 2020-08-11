<?php
session_start();
error_reporting(0);
include("include/db_connection.php");
if (strlen($_SESSION['id'] == 0)) {
    header("location:logout.php");
} else {
    if (isset($_POST['createCategory'])) {

        $categoryName = $_POST['categoryName'];
        $categoryDescription = $_POST['categoryDescription'];
        $query = mysqli_query($con, "INSERT INTO category(categoryName,categoryDescription) value ('$categoryName','$categoryDescription')");
        $_SESSION['msg'] = '<div class="alert alert-success" style="width: 40%;   margin-left:auto; margin-right:auto;">
        <h5 style="text-align: center;">Category Create!</h5> </div>'; 
       
    } else {
        if (isset($_GET['id'])) {
            $adminid = $_GET['id'];
            $sql = mysqli_query($con, "DELETE FROM category WHERE id='$adminid'");
            $_SESSION['delete'] = '<div class="alert alert-danger" style="width: 20%;   margin-left:auto; margin-right:auto;">
            <h5 style="text-align: center;">Delete complete!</h5>
            </div>';
        } 
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="asset/vendor/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .form {
            width: 60%;
            margin-left: auto;
            margin-right: auto;
            height: auto;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include("include/sidebar.php");
        ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php
                include("include/header.php");
                ?>
                <!-- input search -->
                <div>
                    <!--------TITLE-------->
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:center;">
                            <h3>Create Category</h3>
                        </div>
                    </div>

                    <!----------FORM CREATE CATEGORY----------->
                    <form method="POST" class="form">                                      
                        <?php echo $_SESSION['msg']; ?> <?php echo $_SESSION['msg'] = ""; ?>
                        <div class="form-group">
                            <label>Category Name:</label>
                            <input type="text" class="form-control" required placeholder="Enter name catagory" name="categoryName" autofocus >
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea class="form-control" name="categoryDescription" rows="3"></textarea>
                        </div>

                        <button type="submit" name="createCategory" class="btn btn-warning">Create</button>
                    </form>
                   <br>
                    <!-----------SHOW LIST CATEGORY--------------->
                    <div class=container><hr class="sidebar-divider"></div>
                    <br>
                    <div class="container-fluid">
                        
                        
                        <?php echo $_SESSION['delete']; ?> <?php echo $_SESSION['delete'] = ""; ?>
                        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="80%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Category Description </th>
                                    <th>Create Date</th>
                                    <th>Updation Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            </tbody class="animate__fadeInUp">
                            <?php $cnt = 1;
                            $ret = mysqli_query($con, "SELECT * FROM category");
                            while ($row = mysqli_fetch_array($ret)) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['categoryName']; ?></td>
                                    <td><?php echo $row['categoryDescription']; ?></td>
                                    <td><?php echo $row['creationDate']; ?></td>
                                    <td><?php echo $row['updationDate']; ?>
                                    <td style="display: flex;">
                                        <!-- update -->
                                        <a href="update_category.php?uid=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;                                
                                        <!-- Delete -->
                                        <a  href="create_category.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php $cnt++;
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ---------------------------------------- -->

            </div>
            <?php include("include/footer.php"); ?>
        </div>
        <script src="asset/vendor/jquery/jquery.min.js"></script>
        <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="asset/js/sb-admin-2.min.js"></script>
        <script src="asset/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="asset/js/modal-manageusers.js"></script>


    </div>

</body>

</html>