<?php
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
    <title>About Us</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/user-styling/style.css">
    <link rel="stylesheet" href="css/user-styling/header.css">
    <link rel="stylesheet" href="css/user-styling/footer.css">
    <link rel="stylesheet" href="css/user-styling/about.css">

    <style>
        .parallax {
            background:linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('images/reading-together.jpg') no-repeat;
            min-height: 50vh;
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
        <h3 style="color: var(--light-white)">About Us</h3>
        <p style="color: var(--light-white)"><a style="color: white" href="home.php">Home</a> / About</p>
    </div>
</div>

<section class="about">
    <div class="flex">
        <div class="image">
            <img src="images/look-at-books.jpg" alt="">
        </div>
        <div class="content">
            <h3>Why Choose Us?</h3>
            <p>At BookHeaven, we understand the joy and fulfillment that comes from the world of books. We are not just another online bookstore; we are your literary haven, your ultimate destination for all things book-related. With our extensive collection, personalized recommendations, and exceptional customer service, we strive to create an enchanting experience that will leave you eager to explore the realms of literature.</p>

            <p>What truly sets us apart is our commitment to providing exceptional customer service. We understand that every reader is unique, and our dedicated team is here to help you find the perfect book tailored to your tastes and interests. From recommending the next page-turner to offering personalized suggestions based on your reading history, we are passionate about creating meaningful connections between readers and the written word. Our friendly support staff is always available to assist you with any queries, ensuring that your experience with BookHeaven is nothing short of delightful.</p>
            <a href="contact.php" class="btn">Contact Us</a>
        </div>
    </div>
</section>

<section class="reviews">
    <h1 class="title">Client's Reviews</h1>
    <div class="box-container">
        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>"I can't recommend BookHeaven enough! As an avid reader, I appreciate their diverse selection that caters to all genres and interests."</p>
           <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lucy V.</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>"BookHeaven has become my go-to online bookstore. Their vast collection never fails to impress me, with books ranging from classics to the latest releases."</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Christine B.</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>"Finding BookHeaven has been a game-changer for me. As a student, I need access to a wide range of academic resources, and BookHeaven has it all."</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>

            </div>
            <h3>Lisa D.</h3>
        </div>
    </div>
</section>

<section class="authors">
    <h1 class="title">Our Authors</h1>
    <div class="box-container">
        <div class="box">
            <img src="images/pic-1.png" alt="">
            <div class="share">

            </div>
            <h3>John Doe</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <div class="share">

            </div>
            <h3>John Doe</h3>
        </div>

        <div class="box">
            <img src="images/author-2.jpg" alt="">
            <div class="share">

            </div>
            <h3>John Doe</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <div class="share">

            </div>
            <h3>John Doe</h3>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Custom JS file link -->
<script src="js/script.js"></script>



</body>
</html>
