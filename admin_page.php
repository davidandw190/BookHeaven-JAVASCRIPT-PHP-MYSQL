<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN PANEL</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin-styling/admin_style.css">
    <link rel="stylesheet" href="css/admin-styling/admin_header.css">
    <style>
        /* admin_style.css */

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* General styling */
        .header {
            background-color: #f8f8f8;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            text-decoration: none;
        }

        .logo span {
            font-weight: 400;
        }

        .navbar a {
            font-size: 14px;
            color: #555;
            margin-left: 10px;
            text-decoration: none;
        }

        .icons {
            display: flex;
            align-items: center;
        }

        .icons .fas {
            font-size: 18px;
            color: #333;
            margin-right: 10px;
            cursor: pointer;
        }

        .account-box {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: right;
            z-index: 999;
        }

        .account-box p {
            font-size: 12px;
            color: #555;
            margin: 5px 0;
        }

        .account-box span {
            font-weight: 600;
        }

        .account-box .delete-btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
        }

        .account-box a {
            color: #555;
            text-decoration: none;
        }

        .message {
            display: flex;
            align-items: center;
            background-color: #f44336;
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
        }

        .message span {
            margin-right: 10px;
        }

        .message i {
            color: #fff;
            cursor: pointer;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-100%);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                display: none;
            }

            .icons {
                margin-left: auto;
            }

            .account-box {
                position: static;
                display: block;
                padding: 20px;
                text-align: center;
            }
        }


        /* Dashboard section styles */
        .dashboard {
            max-width: 1200px;
            margin: 50px auto;

            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .box h3 {
            font-size: 36px;
            margin: 0;
        }

        .box p {
            margin: 5px 0 0;
            color: #888;
        }

        /* admin_style.css */

        .box {
            /* Existing styles */

            opacity: 0;
            animation: fade-in 0.5s ease-in-out forwards;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


    </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title" style="margin-top: 80px">dashboard</h1>

   <div class="box-container">

       <!-- Inside the box container -->
<!--       <div class="box" id="box1">-->
<!--            PHP code for total pendings -->
<!--           <h3>$--><?php //echo $total_pendings; ?><!--/-</h3>-->
<!--           <p>Total Pendings</p>-->
<!--       </div>-->

<!--        Add a hidden message box -->
<!--       <div class="message-box" id="messageBox">-->
<!--           <h4>Click received!</h4>-->
<!--       </div>-->

       <!-- Custom admin JavaScript file link -->
       <script src="js/admin_script.js"></script>


       <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_pendings; ?></h3>
         <p>Total Pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>$<?php echo $total_completed; ?></h3>
         <p>completed payments</p>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>



<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

<script>
    // admin_script.js

    document.addEventListener("DOMContentLoaded", function () {
        // Fade in animation for boxes (if not using animate.css)
        const boxes = document.querySelectorAll(".box");
        boxes.forEach((box) => {
            box.style.opacity = "0";
            box.style.animation = "fade-in 0.5s ease-in-out forwards";
        });

        // Show message box on box click
        const messageBox = document.getElementById("messageBox");
        const box1 = document.getElementById("box1");
        box1.addEventListener("click", function () {
            messageBox.style.display = "block";
            setTimeout(function () {
                messageBox.style.display = "none";
            }, 2000);
        });
    });

</script>

</body>
</html>