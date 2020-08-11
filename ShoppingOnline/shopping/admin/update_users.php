<?php
session_start();
error_reporting(0);

include("include/db_connection.php");
if (strlen($_SESSION['id'] == 0)) {
    header("location:logout.php");
} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $contact = $_POST['contactno'];
        $shippingAddress = $_POST['shippingAddress'];
        $password = $_POST['password'];
        $shippingCity = $_POST['shippingCity'];
        $shippingState = $_POST['shippingState'];
        $shippingPincode = $_POST['shippingPincode'];
        $billingAddress = $_POST['billingAddress'];
        $billingCity = $_POST['billingCity'];
        $billingState = $_POST['billingState'];
        $billingPincode = $_POST['billingPincode'];
        $updatitonDate = $_POST['updatitonDate'];
        $uid = intval($_GET['uid']);
        $query = mysqli_query($con, "UPDATE users SET contactno='$contact',shippingAddress='$shippingAddress',name ='$name', password ='$password',shippingCity='$shippingCity',shippingState='$shippingState', shippingPincode='$shippingPincode',billingAddress='$billingAddress',billingCity='$billingCity',billingState='$billingState', billingPincode='$billingPincode'  WHERE id='$uid'");
        $_SESSION['msg'] = "Profile Updated successfully";
        header("location:manage-users.php");
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
                            <h3>Update User</h3>
                        </div>
                    </div>
                <p align="center" style="color:#F00;"><?php echo $_SESSION['msg']; ?><?php echo $_SESSION['msg'] = ""; ?></p>
                <div class="container"> <?php
                                        $ret = mysqli_query($con, "SELECT * FROM users WHERE id='" . $_GET['uid'] . "'");
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Contact:</label>
                                <input type="text" class="form-control" name="contactno" value="<?php echo $row['contactno']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Shipping Address:</label>
                                <input type="text" class="form-control" name="shippingAddress" value="<?php $row['shippingAddress']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Shipping State:</label>
                                <input type="text" class="form-control" name="shippingState" value="<?php $row['shippingState']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Shipping City:</label>
                                <input type="text" class="form-control" name="shippingCity" value="<?php $row['shippingCity']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Shipping Pin Code:</label>
                                <input type="text" class="form-control" name="shippingPincode" value="<?php $row['shippingPincode']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Billing Address:</label>
                                <input type="text" class="form-control" name="billingAddress" value="<?php echo $row['billingAddress']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Billing State:</label>
                                <input type="text" class="form-control" name="billingState" value="<?php echo $row["billingState"]; ?>">
                            </div>
                            <div class="form-group">
                                <label>Billing City:</label>
                                <input type="text" class="form-control" name="billingCity" value="<?php echo $row["billingCity"]; ?>">
                            </div>
                            <div class="form-group">
                                <label>Billing Pin Code:</label>
                                <input type="text" class="form-control" name="billingPincode" value="<?php echo $row['billingPincode']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Updation Date:</label>
                                <input type="text" class="form-control" name="updatitonDate" value="<?php echo $row['updatitonDate']; ?>">
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