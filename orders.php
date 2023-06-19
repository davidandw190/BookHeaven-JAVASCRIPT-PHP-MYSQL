<?php

global $conn;
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/user-styling/style.css">
    <link rel="stylesheet" href="css/user-styling/header.css"><link rel="stylesheet" href="css/user-styling/footer.css">

    <style>
        .parallax {
            background:linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('images/book-with-coffee.jpg') no-repeat;
            min-height: 20vh;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;

            height: 50vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="parallax">
    <div class="heading">
        <h3 style="color: var(--light-white)">your orders</h3>
        <p style="color: var(--light-white)"> <a style="color: white" href="home.php" >home</a> / orders </p>
    </div>
</div>


<section class="placed-orders">
    <h1 class="title">placed orders</h1>

    <div class="box-container">
        <?php
        $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Your Orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total Price : <span>$<?php echo $fetch_orders['total_price']; ?></span> </p>
         <p> Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
      </div>

      <?php
       }
      }else{
         echo '<p class="empty">So empty..No orders placed yet!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>