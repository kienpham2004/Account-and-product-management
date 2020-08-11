<?php
session_start();
error_reporting(0);
include("include/db_connection.php");
if (strlen($_SESSION['id'] == 0)) {
    header("location:logout.php");
} else {
    if (isset($_POST['submit'])) {
        $categoryName = $_POST['categoryName'];
        $categoryDescription = $_POST['categoryDescription'];
        $uid = intval($_GET['uid']);
        $query = mysqli_query($con, "UPDATE category SET categoryName='$categoryName', categoryDescription='$categoryDescription' WHERE id='$uid'");
        $_SESSION['msg'] = "Category Updated Successfully!";
        header("location:create_category.php");
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
    <title>Update User | Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="asset/vendor/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
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
                <!-- Table-->
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align:center;">
                        <h3>Update Category</h3>
                    </div>
                </div>
                <p align="center" style="color:#F00;"><?php echo $_SESSION['msg']; ?><?php echo $_SESSION['msg'] = ""; ?></p>
                <div class="container"> <?php
                                        $ret = mysqli_query($con, "SELECT * FROM category WHERE id='" . $_GET['uid'] . "'");
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Category Name:</label>
                                <input type="text" class="form-control" name="categoryName" value="<?php echo $row['categoryName']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Category Description:</label>
                                <input type="text" class="form-control" name="categoryDescription" value="<?php echo $row['categoryDescription']; ?>" >
                            </div>                        
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success">Update</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <!-- content -->
               
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