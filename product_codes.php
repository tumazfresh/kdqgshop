<?php
require 'dbcon.php';

if (isset($_POST['save_product'])) {
    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $subcategory = mysqli_real_escape_string($con, $_POST['subcategory_accessories']);
    $productname = mysqli_real_escape_string($con, $_POST['productname']);
    $productdesc = mysqli_real_escape_string($con, $_POST['productdesc']);
    $color = mysqli_real_escape_string($con, $_POST['color']);
    $memory = mysqli_real_escape_string($con, $_POST['memory']);
    $stock = mysqli_real_escape_string($con, $_POST['Stock']);
    $price = mysqli_real_escape_string($con, $_POST['Price']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $branch = $_SESSION['branch'];

    $image01 = $_FILES['image01']['name'];
    $image01_tmp = $_FILES['image01']['tmp_name'];

    $image02 = $_FILES['image02']['name'];
    $image02_tmp = $_FILES['image02']['tmp_name'];

    $image03 = $_FILES['image03']['name'];
    $image03_tmp = $_FILES['image03']['tmp_name'];

    $image_folder = 'uploaded_img/';

    move_uploaded_file($image01_tmp, $image_folder . $image01);
    move_uploaded_file($image02_tmp, $image_folder . $image02);
    move_uploaded_file($image03_tmp, $image_folder . $image03);

    $query = "INSERT INTO tb_product (brand, category, subcategory, product_name, product_desc, color, memory, image_01, image_02, image_03, Stock, Price, Status, Branch)
          VALUES ('$brand', '$category', '$subcategory', '$productname', '$productdesc', $color, $memory '$image01', '$image02', '$image03', '$stock', '$price', '$status', '$branch')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Product Created Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Product Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['update_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $subcategory = mysqli_real_escape_string($con, $_POST['editsubcategory']);
    $productname = mysqli_real_escape_string($con, $_POST['productname']);
    $productdesc = mysqli_real_escape_string($con, $_POST['productdesc']);
    $color = mysqli_real_escape_string($con, $_POST['color']);
    $memory = mysqli_real_escape_string($con, $_POST['memory']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $status = mysqli_real_escape_string($con, $_POST['edit_status']);

    $image_folder = 'uploaded_img/';
    $image01 = '';
    $image02 = '';
    $image03 = '';

    if ($_FILES['image01']['name']) {
        $image01 = $_FILES['image01']['name'];
        $image01_tmp = $_FILES['image01']['tmp_name'];
        move_uploaded_file($image01_tmp, $image_folder . $image01);
    }

    if ($_FILES['image02']['name']) {
        $image02 = $_FILES['image02']['name'];
        $image02_tmp = $_FILES['image02']['tmp_name'];
        move_uploaded_file($image02_tmp, $image_folder . $image02);
    }

    if ($_FILES['image03']['name']) {
        $image03 = $_FILES['image03']['name'];
        $image03_tmp = $_FILES['image03']['tmp_name'];
        move_uploaded_file($image03_tmp, $image_folder . $image03);
    }

    if (!empty($image01) && !empty($image02) && !empty($image03)) {
    $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
              image_01='$image01', image_02='$image02', image_03='$image03', Stock='$stock', Price='$price', Status='$status'
              WHERE id='$product_id'";
    } elseif (!empty($image01) && !empty($image02)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_01='$image01', image_02='$image02', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } elseif (!empty($image01) && !empty($image03)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_01='$image01', image_03='$image03', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } elseif (!empty($image02) && !empty($image03)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_02='$image02', image_03='$image03', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } elseif (!empty($image01)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_01='$image01', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } elseif (!empty($image02)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_02='$image02', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } elseif (!empty($image03)) {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  image_03='$image03', Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    } else {
        $query = "UPDATE tb_product SET brand='$brand', category='$category', subcategory='$subcategory', product_name='$productname', product_desc='$productdesc', color='$color', memory='$memory',
                  Stock='$stock', Price='$price', Status='$status'
                  WHERE id='$product_id'";
    }


    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Product Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Product Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['product_id'])) {
    $product_id = mysqli_real_escape_string($con, $_GET['product_id']);

    $query = "SELECT * FROM tb_product WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $product = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Product Fetch Successfully by ID',
            'data' => $product
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Product ID Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $query = "DELETE FROM tb_product WHERE id='$product_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Product Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Product Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}