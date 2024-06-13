<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['director_name'])){
   header('location:loginform.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/cart.css">
   <link rel="stylesheet" href="home.css">   

</head>
<body>
<header>
        <h5>welcome <span><?php echo $_SESSION['director_name'] ?></span></h5>
        <nav>
            <a href="index.html">Home</a>
            <a href="userpage.php">Devices</a>
            <a href="logout.php">SignOut</a>
            
        </nav>
    </header>

<div class="container">

   <?php

   $select = mysqli_query($conn, "SELECT * FROM shop_details");
   $manager = mysqli_query($conn, "SELECT * FROM user_details WHERE user_type='manager'");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Shop Name</th>
            <th>Location</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
           <td>
               <a href="directorpage.php?delete=<?php echo $row['s_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>

      <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($manager)){ ?>
         <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
               <a href="directorpage.php?delete_order=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>

</body>
</html>