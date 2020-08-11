<?php
session_start();
error_reporting(0);
include("include/db_connection.php");
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
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
    <title>Uses Log | Admin</title>
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
                <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:center;">
                            <h3>User Login</h3>
                        </div>
                    </div>
                <!-- input search -->
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
                <div class="container-fluid">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>User IP</th>
                                <th>Login Time</th>
                                <th>Log Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        </tbody>
                        <?php
                        $cnt = 1;
                        $name = $_REQUEST['search'];
                        $sql = "SELECT * FROM userlog WHERE userEmail LIKE '%" . $name . "%'  ";                
                        $res = $con->query($sql);
                        while ($row = $res->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['userEmail']; ?></td>
                                <td><?php echo $row['userip']; ?></td>
                                <td><?php echo $row['loginTime'] ?></td>
                                <td><?php echo $row['logout']; ?></td>
                                <td><?php echo $row['status'] ? "Offline":"Online" ; ?></td>
                            </tr>
                        <?php
                            $cnt++;
                        }
                        ?>
                        </tbody>
                    </table>
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