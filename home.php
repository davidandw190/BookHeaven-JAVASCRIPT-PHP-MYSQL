<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
}
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Product already added to your cart!';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'The product was added to your cart!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | BookHeaven</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/user-styling/style.css">
    <link rel="stylesheet" href="css/user-styling/header.css">
    <link rel="stylesheet" href="css/user-styling/home.css">
    <link rel="stylesheet" href="css/user-styling/footer.css">

    <style>
        .box-container {
            display: flex;
            overflow-x: scroll;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            scroll-padding: 1rem;
        }

        .box {
            flex: 0 0 auto;
            scroll-snap-align: center;
            margin: 0 1rem;
            width: 300px;
            min-width: 300px;
        }

        .home {
            background:linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('images/books.jpg') no-repeat;
            min-height: 90vh;
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


<section class="home">
    <div class="content">
        <h3>Welcome to BookHeaven</h3>
        <p>Discover a world of handpicked books delivered to your door. Immerse yourself in captivating stories, expand your knowledge, and explore new realms through our extensive collection of books.</p>
        <a href="about.php" class="white-btn">Discover More</a>
    </div>
</section>

<section class="products">
    <h1 class="title">Latest Products</h1>
    <div class="box-container">
        <div class="scrollable-container">
            <div class="scrollable-products">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                        ?>
                        <form action="" method="post" class="box">
                            <img class="image" src="images/<?php echo $fetch_products['image']; ?>" alt="">
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="price">$<?php echo $fetch_products['price']; ?></div>
                            <input type="number" min="1" name="product_quantity" value="1" class="qty">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn view-details-btn">
                        </form>

                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="shop.php" class="option-btn">See More</a>
    </div>

</section>


<div id="modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modal-image" src="" alt="">
        <div id="modal-name"></div>
        <div id="modal-price"></div>
        <input type="number" min="1" name="modal-product-quantity" value="1" class="qty">
    </div>
</div>

<section class="reviews">
    <h1 class="title">What Our Customers Say</h1>
    <div class="bubbles">
        <div class="bubble">
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="review">BookHeaven is my go-to place for all my reading needs. Their selection is unmatched and their customer service is exceptional. I highly recommend them!</p>
            <p class="customer">- John Doe</p>
        </div>
        <div class="bubble">
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="review">I love browsing through the BookHeaven website. They have a wide range of genres to choose from, and their recommendations are always spot on!</p>
            <p class="customer">- Jane Smith</p>
        </div>
        <div class="bubble">
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p class="review">BookHeaven offers great deals and discounts. I have saved a lot of money on my book purchases thanks to them. Definitely worth checking out!</p>
            <p class="customer">- Robert Johnson</p>
        </div>
    </div>
</section>
<section class="benefits">
    <h1 class="title">Benefits of Using BookHeaven</h1>
    <div class="benefits-container">
        <div class="benefit">
            <i class="fas fa-shipping-fast"></i>
            <h3>Fast Delivery</h3>
            <p>Get your books delivered right to your doorstep in no time. We prioritize fast and efficient delivery to ensure you can start reading your favorite books as soon as possible.</p>
        </div>
        <div class="benefit">
            <i class="fas fa-search"></i>
            <h3>Extensive Collection</h3>
            <p>Explore our vast collection of books spanning various genres, including fiction, non-fiction, romance, fantasy, science fiction, and more. There's something for every book lover.</p>
        </div>
        <div class="benefit">
            <i class="fas fa-percent"></i>
            <h3>Great Discounts</h3>
            <p>Enjoy amazing discounts and deals on our books. We believe in making reading affordable and accessible for everyone, so you can indulge in your favorite stories without breaking the bank.</p>
        </div>
        <div class="benefit">
            <i class="fas fa-user"></i>
            <h3>Personalized Recommendations</h3>
            <p>Receive personalized book recommendations based on your preferences and reading history. Our advanced algorithm ensures that you discover books tailored to your taste.</p>
        </div>
    </div>
</section>
<section class="about">
    <div class="flex">
        <div class="image">
            <img src="images/look-at-books.jpg" alt="">
        </div>
        <div class="content">
            <h3>About Us</h3>
            <p>At BookHeaven, we are passionate about books and the joy they bring to people's lives. Our mission is to connect readers with their next favorite book, providing a seamless and enjoyable reading experience.</p>
            <a href="about.php" class="btn">Read More</a>
        </div>
    </div>
</section>
<section class="home-contact">
    <div class="content">
        <h3>Have Any Questions?</h3>
        <p>If you have any questions or need assistance, our dedicated support team is here to help. Contact us and we'll get back to you as soon as possible.</p>
        <a href="contact.php" class="white-btn">Contact Us</a>
    </div>
</section>
<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>




</body>
</html>
