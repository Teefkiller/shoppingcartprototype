<!-- connect file -->
<?php


include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title=$_POST['product_title'];
    $product_description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_categories=$_POST['product_categories'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_satuts= true;
    // acessing images
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];
      // acessing image temporary name
      $temp_image1=$_FILES['product_image1']['tmp_name'];
      $temp_image2=$_FILES['product_image2']['tmp_name'];
      $temp_image3=$_FILES['product_image3']['tmp_name'];
    //checking empty condition 
    if ($product_title=='' or $product_categories=='' or
     $product_keywords=='' or $product_categories=='' or  $product_brands=='' or  $product_price=='' or  $product_image1==''
     or $product_image2==''or $product_image3=='' ) {
        echo "<script>alert('please fill all available fields')</script>";
        exit();
    }else {
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");
        //insert query
        $insert_product= "INSERT INTO products (product_title, product_description,
         products_keywords,category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status 
        ) VALUES ('$product_title','$product_description','$product_keywords',
        '$product_categories',' $product_brands','$product_image1','$product_image2', '$product_image3',
        '$product_price',Now(),'$product_satuts' )";
        $result_query=mysqli_query($conn,$insert_product);
        if ($result_query) {
            echo "<script>alert('sucessfully inserted products')</script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert product</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet" 
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous">
      <!-- font awesome link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
   integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
       crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- css file -->
      <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-light">
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert products </h1>
        <!-- create form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">
                    Product title
                </label>
                <input type="text" name="product_title" id="product_title" class="form-control" 
                placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="form-outline mb-4 ">
                <label for="description" class="form-label">
                    Product description
                </label>
                <input type="text" name="description" id="description" class="form-control" 
                placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- keywords -->
            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label">
                    Product keyword
                </label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="form-outline mb-4 ">
                <select name="product_categories" id="" class="form-select">
                    <option value="" >Select categories</option>
                    <?php
                    $select_query= "SELECT * FROM categories";
                    $result_query= mysqli_query($conn, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)) {
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo " <option value='$category_id' >$category_title</option>";
                       
                    }
                ?>
                   
                </select>
            </div>
            <!-- brands -->
            <div class="form-outline mb-4 ">
                <select name="product_brands" id="" class="form-select">
                    <option value="" >Select a brand</option>
                    <?php
                    $select_query= "SELECT * FROM brands";
                    $result_query= mysqli_query($conn, $select_query);
                    while($row=mysqli_fetch_assoc($result_query)) {
                        $brands_title=$row['brand_title'];
                        $brands_id=$row['brand_id'];
                        echo " <option value='$brands_id' >$brands_title</option>";
                       
                    }
                    ?>
                   
                </select>
               
            </div>
            <!-- image1 -->
            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label">
                    Product image 1
                </label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" 
                 required="required">
            </div>
           <!-- image2 -->
           <div class="form-outline mb-4">
                <label for="product_image2" class="form-label">
                    Product image 2
                </label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" 
                 required="required">
           </div>
            <!-- image3 -->
            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label">
                    Product image 3
                </label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" 
                 required="required">

                 </div>
                  <!-- Price -->
            <div class="form-outline mb-4">
                <label for="product_price" class="form-label">
                    Product price
                </label>
                <input type="text" name="product_price" id="product_price" class="form-control" 
                placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- insert -->
            <div class="form-outline mb-4">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert products">
            </div>
        </form>
    </div>
    
</body>
</html>