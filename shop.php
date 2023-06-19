<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

// Handle search query
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT * FROM `products` WHERE name LIKE '%$search%'";
    $search_result = mysqli_query($conn, $search_query) or die('Search query failed');
} else {
    // Fetch latest products
    $search_result = mysqli_query($conn, "SELECT * FROM `products` ORDER BY id DESC") or die('Failed to fetch products');
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');
        $message[] = 'product added to cart!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/user-styling/style.css">
    <link rel="stylesheet" href="css/user-styling/header.css">
    <link rel="stylesheet" href="css/user-styling/footer.css">
    <link rel="stylesheet" href="css/user-styling/shop.css">

    <style>
        /* Search Bar */
        .search-bar {
            display: flex;
            align-items: center;
            max-width: 400px;
            margin: 0 auto;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar input[type="text"] {
            flex: 1;
            border: none;
            background: none;
            outline: none;
            padding: 5px;
        }

        .search-bar button {
            border: none;
            background: none;
            outline: none;
            cursor: pointer;
            padding: 5px;
        }

        .parallax {
            background:linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('images/shop-book-small.jpg') no-repeat;
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
        <h3 style="color: var(--light-white)">Our Shop</h3>
        <p style="color: var(--light-white)"><a style="color: white" href="home.php">Home</a> / Shop</p>

        <form action="" method="post" class="search-form">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search for books">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

<section class="products">
    <h1 class="title">Latest Products</h1>

    <div class="box-container">
        <?php
        if (mysqli_num_rows($search_result) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($search_result)) {
                ?>
                <form action="" method="post" class="box">
                    <img class="image" src="images/<?php echo $fetch_products['image']; ?>" alt="">
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="price">$<?php echo $fetch_products['price']; ?></div>
                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                </form>
                <?php
            }
        } else {
            echo '<p class="empty">No products found!</p>';
        }
        ?>
    </div>
</section>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script>
    // Smooth Scroll to Search Bar
    $('a[href="#search"]').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: $('.search-bar').offset().top }, 800);
    });

    // Animate Filter Bar on Scroll
    $(window).on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        if (scrollTop > 100) {
            $('.filter-bar').addClass('animate');
        } else {
            $('.filter-bar').removeClass('animate');
        }
    });

</script>
</body>
</html>
