<?php

require('config/config.php');
require('config/db.php');

// Create Query
$query = 'SELECT * FROM posts ORDER BY created_at DESC';

// Get results
$result = mysqli_query($conn, $query);

// Fetch data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free Result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>
    <div class="container">
    <h1 class="display-3">Posts</h1>
    <?php foreach($posts as $post) : ?>
        <div class="well">
            <h3 class="my-4"><?php echo $post['title']; ?></h3>
            <small>Created on <?php echo $post['created_at']; ?>
             by <?php echo $post['author']; ?></small>
            <p><?php echo $post['body']; ?></p>
            <a class="btn btn-outline-primary" href="<?php echo ROOT_URL;?>post.php?id=<?php 
                echo $post['id']; ?>">Read More</a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php include('inc/footer.php') ?>


    