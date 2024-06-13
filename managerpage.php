<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['manager_name'])){
   header('location:loginform.php');
}

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['product_description'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_description)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO devices(Name, Price, Photoes, Description) VALUES('$product_name', '$product_price', '$product_image', '$product_description')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM devices WHERE d_id = $id");
   header('location:managerpage.php');
};
if(isset($_GET['delete_order'])){
   $id = $_GET['delete_order'];
   mysqli_query($conn, "DELETE FROM order_details WHERE order_id = $id");
   header('location:managerpage.php');
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cart.css">
   <link rel="stylesheet" href="home.css">
</head>
<body>
<header>
        <h5>welcome <span><?php echo $_SESSION['manager_name'] ?></span></h5>
        <nav>
            <a href="index.html">Home</a>
            <a href="userpage.php">Devices</a>
            <a href="logout.php">SignOut</a>
            
        </nav>
    </header>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <textarea placeholder="enter product description" name="product_description" class="box"></textarea>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>
</div>
</div>
<div class="container">

   <?php

   $select = mysqli_query($conn, "SELECT * FROM devices");
   $orders = mysqli_query($conn, "SELECT * FROM order_details,devices,user_details WHERE order_details.d_id = devices.d_id and order_details.id=user_details.id");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>Description</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['Photoes']; ?>" height="100" alt=""></td>
            <td><?php echo $row['Name']; ?></td>
            <td>$<?php echo $row['Price']; ?>/-</td>
            <td><?php echo $row['Description']?></td>
            <td>
               <a href="managerpage.php?delete=<?php echo $row['d_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>

      <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>order id</th>
            <th>device id</th>
            <th>date</th>
            <th>quantity</th>
            <th>C_ID</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($orders)){ ?>
         <tr>
            <td><?php echo $row['order_id'];?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['quantity']?></td>
            <td><?php echo $row['name']?></td>
            <td>
               <a href="managerpage.php?delete_order=<?php echo $row['order_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>
</body>
</html>

<!-- </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

    custom css file link 
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>manager</span></h3>
      <h1>welcome <span><?php echo $_SESSION['manager_name'] ?></span></h1>
      <p>this is an admin page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html> -->