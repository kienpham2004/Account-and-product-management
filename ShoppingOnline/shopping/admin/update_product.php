<?php

use function PHPSTORM_META\type;

session_start();
error_reporting(0);
include("include/db_connection.php");
if (strlen($_SESSION['id'] == 0)) {
    header("location:logout.php");
} else {
    $uid = intval($_GET['uid']);
    if (isset($_POST['updateProduct'])) {
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $productname = $_POST['productName'];
        $productcompany = $_POST['productCompany'];
        $productprice = $_POST['productprice'];
        $productpricebd = $_POST['productpricebd'];
        $productdescription = $_POST['productDescription'];
        $productscharge = $_POST['productShippingcharge'];
        $productavailability = $_POST['productAvailability'];
        $updateImage1 = $_FILES['updateImage1']['name'];
        $updateImage2 = $_FILES['updateImage2']['name'];
        $updateImage3 = $_FILES['updateImage3']['name'];

        move_uploaded_file($updateImage1 = $_FILES['updateImage1']['tmp_name'],"productimages/$uid/". $updateImage1 = $_FILES['updateImage1']['name']);
        move_uploaded_file($updateImage2 = $_FILES['updateImage2']['tmp_name'],"productimages/$uid/". $updateImage2 = $_FILES['updateImage2']['name']);
        move_uploaded_file($updateImage3 = $_FILES['updateImage3']['tmp_name'],"productimages/$uid/". $updateImage3 = $_FILES['updateImage3']['name']);
         $sql = mysqli_query($con, "UPDATE  products 
                                   SET category='$category',subCategory='$subcategory',
                                   productName='$productname',productCompany='$productcompany',
                                   productPrice='$productprice',productDescription='$productdescription',
                                   shippingCharge='$productscharge',productAvailability='$productavailability',
                                   productPriceBeforeDiscount='$productpricebd', productImage1 = '$updateImage1',
                                   productImage2 = '$updateImage2', productImage3 = '$updateImage3'
                                   WHERE id='$uid' ");
        header("location:manage_products.php");
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
                            <h3>Update Product</h3>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT products.*,
                            category.categoryName AS catname,
                            category.id AS cid,
                            subcategory.subcategory AS subcatname,
                            subcategory.id AS subcatid 
                            FROM products 
                            JOIN category 
                            ON category.id=products.category 
                            JOIN subcategory 
                            ON subcategory.id=products.subCategory 
                            WHERE products.id='$uid'";
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <!----------FORM CREATE CATEGORY----------->
                        <form method="POST" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category:</label>
                                <select class="form-control" name="category" onchange="getSubcat(this.value);" required>
                                    <option value="<?php echo htmlentities($row['cid']); ?>"><?php echo htmlentities($row['catname']); ?></option>
                                    <?php $query = mysqli_query($con, "select * from category");
                                    while ($rw = mysqli_fetch_array($query)) {
                                        if ($row['catname'] == $rw['categoryName']) {
                                            continue;
                                        } else {
                                    ?>
                                            <option value="<?php echo $rw['id']; ?>"><?php echo $rw['categoryName']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sub Category:</label>
                                <select class="form-control" name="subcategory" id="subcategory">
                                    <option value="<?php echo htmlentities($row['subcatid']); ?>"><?php echo htmlentities($row['subcatname']); ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Name:</label>
                                <input type="text" class="form-control" required name="productName" value="<?php echo htmlentities($row['productName']); ?>" autofocus>
                            </div>

                            <div class="form-group">
                                <label>Product Company:</label>
                                <input type="text" class="form-control" required name="productCompany" value="<?php echo htmlentities($row['productCompany']); ?>" autofocus>
                            </div>

                            <div class="form-group">
                                <label>Product Price Before Discount</label>
                                <input type="text" class="form-control" required name="productpricebd" value="<?php echo htmlentities($row['productPriceBeforeDiscount']); ?>" autofocus>
                            </div>

                            <div class="form-group">
                                <label>Product Price After Discount(Selling Price):</label>
                                <input type="text" class="form-control" name="productprice" value="<?php echo htmlentities($row['productPrice']); ?>" autofocus required>
                            </div>

                            <div class="form-group">
                                <label>Product Shipping Charge:</label>
                                <input type="text" class="form-control" name="productShippingcharge" value="<?php echo htmlentities($row['shippingCharge']); ?>" autofocus required>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Product Availability:</label>
                                <select class="form-control" name="productAvailability" id="exampleFormControlSelect1" required>
                                    <option value="<?php echo htmlentities($row['productAvailability']); ?>"><?php echo htmlentities($row['productAvailability']); ?></option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Desription:</label>
                                <textarea class="form-control" name="productDescription" id="exampleFormControlTextarea1" value="<?php echo htmlentities($row['productDescription']); ?>" required></textarea>
                            </div>

                            <div class="control-group">
                                <label>Image 1 current</label>
                                <img src="productimages/<?php echo htmlentities($uid); ?>/<?php echo htmlentities($row['productImage1']); ?>" width="200" height="100"> <input type="file" required name="updateImage1">Change Image</input>
                            </div>
                            <br>
                            <div class="control-group">
                                <label>Image 2 current</label>
                                <img src="productimages/<?php echo htmlentities($uid); ?>/<?php echo htmlentities($row['productImage2']); ?>" width="200" height="100"> <input type="file" required name="updateImage2">Change Image</input>
                            </div>
                            <br>
                            <div class="control-group">
                                <label>Image 3 current</label>
                                <img src="productimages/<?php echo htmlentities($uid); ?>/<?php echo htmlentities($row['productImage3']); ?>" width="200" height="100"> <input type="file" required name="updateImage3">Change Image</input>
                            </div>
                            <button type="submit" name="updateProduct" class="btn btn-warning">Update</button>
                        </form>
                    <?php } ?>
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
        <script src="ckeditor\ckeditor.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            CKEDITOR.replace('productDescription');
        </script>
        <script>
            function getSubcat(val) {
                $.ajax({
                    type: "POST",
                    url: "get_subcat.php",
                    data: "cat_id=" + val,
                    success: function(data) {
                        $("#subcategory").html(data);
                    }
                });
            }
        </script>
    </div>

</body>

</html>