<?php
session_start();
error_reporting(0);
include('include/db_connection.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['insertProduct'])) {
        $category = $_POST['category'];
        $subcat = $_POST['subcategory'];
        $productname = $_POST['productName'];
        $productcompany = $_POST['productCompany'];
        $productprice = $_POST['productprice'];
        $productpricebd = $_POST['productpricebd'];
        $productdescription = $_POST['productDescription'];
        $productscharge = $_POST['productShippingcharge'];
        $productavailability = $_POST['productAvailability'];
        $productimage1 = $_FILES["productimage1"]["name"];
        $productimage2 = $_FILES["productimage2"]["name"];
        $productimage3 = $_FILES["productimage3"]["name"];


        $query = mysqli_query($con, "SELECT max(id) AS pid FROM products");
        $result = mysqli_fetch_array($query);
        $productid = $result['pid'] + 1;
        $dir = "productimages/$productid";
        if (!is_dir($dir)) {
            mkdir("productimages/" . $productid);
        }
        move_uploaded_file($_FILES["productimage1"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage1"]["name"]);
        move_uploaded_file($_FILES["productimage2"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage2"]["name"]);
        move_uploaded_file($_FILES["productimage3"]["tmp_name"], "productimages/$productid/" . $_FILES["productimage3"]["name"]);
        $sql = mysqli_query($con, "INSERT INTO products(
                                             category,subCategory,
                                             productName,productCompany,
                                             productPrice,productDescription,
                                             shippingCharge,productAvailability,
                                             productImage1,productImage2,
                                             productImage3,productPriceBeforeDiscount) 
                                             VALUES('$category','$subcat',
                                             '$productname','$productcompany',
                                             '$productprice','$productdescription',
                                             '$productscharge','$productavailability',
                                             '$productimage1','$productimage2',
                                             '$productimage3','$productpricebd')");

        $_SESSION['msg'] = "Product Inserted Successfully !!";
    } else {
        $_SESSION['error'] = "Product ko duoc them !!";
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
                            <h3>Insert Product</h3>
                        </div>
                    </div>

                    <!----------FORM CREATE CATEGORY----------->
                    <form method="POST" class="form" enctype="multipart/form-data">
                        <!-- <p style="color: red; text-aglin:center;"><?php echo  $_SESSION['msg']; ?><?php $_SESSION['msg'] == ""; ?></p>
                    <p style="color: red; text-aglin:center;"><?php echo  $_SESSION['error']; ?><?php $_SESSION['error'] == ""; ?></p> -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category:</label>
                            <select class="form-control" name="category" onchange="getSubcat(this.value);" required>
                                <option value =" ">Select Category</option>
                                <?php $query = mysqli_query($con, "SELECT * FROM category");
                                while ( $row = mysqli_fetch_array($query)) { ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['categoryName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <script>
                            function getSubcat( val ) {
                                $.ajax( {
                                    type: "POST",
                                    url: "get_subcat.php",
                                    data: "cat_id=" + val,
                                    success: function(data) {
                                        $("#subcategory").html(data);
                                    }
                                } );                         
                            }
                        </script>
                        <div class="form-group">
                            <label>Sub Category:</label>
                            <select class="form-control" name="subcategory" id="subcategory">
                                                            
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Product Name:</label>
                            <input type="text" class="form-control" required placeholder="Enter name product" name="productName" autofocus>
                        </div>

                        <div class="form-group">
                            <label>Product Company:</label>
                            <input type="text" class="form-control" required placeholder="Enter name product company" name="productCompany" autofocus>
                        </div>

                        <div class="form-group">
                            <label>Product Price Before Discount</label>
                            <input type="text" class="form-control" required placeholder="Enter product price before discount" name="productpricebd" autofocus>
                        </div>

                        <div class="form-group">
                            <label>Product Price After Discount(Selling Price):</label>
                            <input type="text" class="form-control" placeholder="Enter product price affter discount" name="productprice" autofocus required>
                        </div>

                        <div class="form-group">
                            <label>Product Shipping Charge:</label>
                            <input type="text" class="form-control" placeholder="Enter product shipping charge" name="productShippingcharge" autofocus required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Product Availability:</label>
                            <select class="form-control" name="productAvailability" id="exampleFormControlSelect1" required>
                                <option value="">Select</option>
                                <option value="In Stock">In Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" name="productDescription" id="exampleFormControlTextarea1" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Product Image 1:</label>
                            <input type="file" name="productimage1" required>
                        </div>

                        <div class="form-group">
                            <label>Product Image 2:</label>
                            <input type="file" name="productimage2" required>
                        </div>
                        <div class="form-group">
                            <label>Product Image 3:</label>
                            <input type="file" name="productimage3" required>
                        </div>
                        <button type="submit" name="insertProduct" class="btn btn-warning">Create</button>
                    </form>

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

    </div>

</body>

</html>