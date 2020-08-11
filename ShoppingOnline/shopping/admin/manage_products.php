<?php
session_start();
error_reporting(0);
include("include/db_connection.php");

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['id'])) {
        $adminid = $_GET['id'];
        $sql = mysqli_query($con, "DELETE FROM products WHERE id='$adminid'");
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
                            <h3>Manage Products</h3>
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
                                    <th>ProductName</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Company Name</th>
                                    <th>Product Creation Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            </tbody class="animate__fadeInUp">
                            <?php
                            $cnt = 1;
                            $nameProduct = $_REQUEST['search'];
                            $sql = "SELECT products.*,
                            category.categoryName,
                            subcategory.subcategory 
                            FROM products 
                            JOIN category 
                            ON category.id=products.category 
                            JOIN subcategory 
                            ON subcategory.id=products.subCategory WHERE products.productName like '%" . $nameProduct . "%' ";
                            $res = $con->query($sql);
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['productName']; ?></td>
                                    <td><?php echo $row['categoryName']; ?></td>
                                    <td><?php echo $row['subcategory']; ?></td>
                                    <td><?php echo $row['productCompany']; ?></td>
                                    <td><?php echo $row['postingDate']; ?>
                                    </td>

                                    <td style="display: flex;">
                                        <!-- update -->
                                        <a href="update_product.php?uid=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;
                                        <!-- Delete -->
                                        <a href="manage_products.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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