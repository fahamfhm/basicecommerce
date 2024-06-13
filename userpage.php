<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:loginform.php');
}
if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;
}

if(isset($_GET['order'])){
   $dev = mysqli_query($conn, "SELECT * FROM devices");
   while($row = mysqli_fetch_array($dev)){
         $d_id=$row['d_id'];
      }
   $customer = mysqli_query($conn, "SELECT * FROM user_details");
   while($row = mysqli_fetch_array($customer)){
            $id=$row['id'];
         }
   
   mysqli_query($conn, "INSERT INTO order_details (d_id, date, quantity, id) VALUES ($d_id,now() ,1, $id)");
   header('order.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
   <title>admin page</title>

   
   <link rel="stylesheet" href="css/cart.css">
   <link href="home.css" type="text/css" rel="stylesheet">

</head>
<body>
<header>
        <h5>welcome <span><?php echo $_SESSION['user_name'] ?></span></h5>
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

   <?php

   $select = mysqli_query($conn, "SELECT * FROM devices");
   
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
               <a href="userpage.php?order=<?php echo $row['d_id']; ?>" class="btn"> <i class="fas fa-trash"></i> Order </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>

