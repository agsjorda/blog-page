<?php
    require_once("new-connection.php");
    session_start();
    if(!isset($_SESSION['logged_in'])) {
        session_destroy();
        header('location: index.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
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
            <h1>Blog Title</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit11px, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <form action="process.php" method="post"> 
                <input type="hidden" name="action" value="create_review">
                <h2>Leave a review</h2>
                <textarea type="text" name="message" placeholder="post a message" ></textarea>
                <input type="submit" id="review-btn" name="submit" value="Post a review">
            </form>
            <?php
                $reviews = fetch_all("SELECT reviews.*, users.first_name, users.last_name
                                        FROM reviews LEFT JOIN users
                                        ON reviews.user_id = users.id
                                        ORDER BY id DESC
                                    ");
            
            ?>
            <?php foreach($reviews as $review) {
            ?>
                <div class="posts">
                <h2>Review from <?= $review['first_name']?> <?= $review['last_name']?>  -  <?= date("F d, Y", strtotime($review['created_at']))?>.</h2>
                <p class="line"> <?= $review['content']?></p>
                <?php 
                    $replies = fetch_all("
                        SELECT replies.*, users.first_name, users.last_name
                            FROM replies
                            LEFT JOIN users ON users.id = replies.user_id
                            WHERE replies.review_id = {$review['id']}")
                ?>
            <?php 
                foreach($replies as $reply ) {
            ?>
                <h3>Replies from <?= $reply['first_name']?> <?= $reply['last_name']?>  -  <?= date("F d, Y", strtotime($reply['created_at']))?></h4>
                <p><?= $reply['content']?></p>
            <?php        
                }
            ?>
                
                <form action="process.php" method="post"> 
                    <input type="hidden" name="action" value="reply">
                    <input type="hidden" name="message_id" value="<?= $review['id']?>">
                    <label>Leave a reply<textarea type="text" name="message" placeholder="replies" ></textarea></label>
                    <input type="submit" class="reply-btn" name="submit" value="reply">
                </form>
            </div>
            <?php
            }
            ?>
            
        </section>
    </div>
</body>
</html>