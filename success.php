<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>
            <h2 id="logo">Blog</h2>
            <div>
                <p>Welcome <?= $_SESSION['first_name']?></p>
                <a href='process.php'> LOG OFF</a>
            </div>
        </header>
        <section>
            <h1>Title</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit11px, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <form>
                <input type="hidden" name="action" value="review">
                <h2>Leave a review</h2>
                <textarea type="text" name="message" cols="100" rows="5"></textarea>
                <input type="submit" id="review-btn" name="submit" value="review">
            </form>
        </section>
    </div>
</body>
</html>