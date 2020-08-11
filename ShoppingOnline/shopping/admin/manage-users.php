<?php
session_start();
error_reporting(0);
include("include/db_connection.php");

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['id'])) {
        $adminid = $_GET['id'];
        $sql = mysqli_query($con, "DELETE FROM users WHERE id='$adminid'");
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
    <title>Manage Users | Admin</title>
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
                <!-- input search -->

                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:center;">
                            <h3>Manage Users</h3>
                        </div>
                    </div>
                    <div style="margin-bottom:10px; margin-right: 50px; float:right;">
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary " type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table-->
                    <div class="container-fluid">
                        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Contact no</th>
                                    <th>Shippping Address/City/State/Pincode </th>
                                    <th>Billing Address/City/State/Pincode </th>
                                    <th>Reg. Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            </tbody class="animate__fadeInUp">
                            <?php
                            $cnt = 1;
                            $name = $_REQUEST['search'];
                            $sql = "select * from users where name like '%" . $name . "%' or email like '%" . $name . "%'  ";
                            $res = $con->query($sql);
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contactno']; ?></td>
                                    <td><?php echo $row['shippingAddress'] . "," . $row['shippingCity'] . "," . $row['shippingState'] . "-" . $row['shippingPincode']; ?>
                                    </td>
                                    <td><?php echo $row['billingAddress'] . "," . $row['billingCity'] . "," . $row['billingState'] . "-" . $row['billingPincode']; ?>
                                    </td>
                                    <td><?php echo $row['regDate']; ?></td>
                                    <td style="display: flex;">
                                        <!-- update -->
                                        <a href="update_users.php?uid=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;
                                        <!-- Delete -->
                                        <a href="manage-users.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $cnt++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
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
        <script src="js/wow.min.js"></script>

    </div>

</body>

</html>