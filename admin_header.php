<?php
if(isset($message)){
    foreach($message as $message){
        echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<header class="header">

    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
            </div>
            <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        </div>
    </div>
    <div class="header-2">
        <div class="flex">
            <nav class="navbar">
                <a href="admin_page.php">Dashboard</a>
                <a href="admin_products.php">Stock</a>
                <a href="admin_orders.php">Orders</a>
                <a href="admin_users.php">Users</a>
                <a href="admin_contacts.php">Messages</a>
            </nav>

            <div class="icons">
                <div id="user-btn" class="fas fa-user"></div>
            </div>



            <div class="user-box">
                <h1 style="margin-bottom: 10px">Current Account</h1>

                <p>Admin Name: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">Wish to Logout?</a>
            </div>


        </div>

    </div>
</header>