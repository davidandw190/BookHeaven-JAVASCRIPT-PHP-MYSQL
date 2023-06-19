<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'message sent already!';
    } else {
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
        $message[] = 'message sent successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/user-styling/style.css">
    <link rel="stylesheet" href="css/user-styling/header.css">
    <link rel="stylesheet" href="css/user-styling/footer.css">
    <link rel="stylesheet" href="css/user-styling/contact.css">

    <style>
        .parallax {
            background:linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('images/look-at-books.jpg') no-repeat;
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
        <h3 style="color: white">Contact Us</h3>
        <p style="color: white"><a style="color: white" href="home.php">Home</a> / Contact</p>
    </div>
</div>
<section class="contact">
    <div class="contact-form">
        <h3>Say Something!</h3>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="name" required placeholder="Enter your name..">
            </div>
            <div class="form-group">
                <input type="email" name="email" required placeholder="Enter your email..">
            </div>
            <div class="form-group">
                <input type="number" name="number" required placeholder="Enter your phone number..">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Enter your message..." rows="6"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Send Message" name="send" class="btn">
            </div>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>

</html>
