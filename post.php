<?php
require('config/config.php');
require('config/db.php');

// error_reporting(0);

if(isset($_POST['delete'])) {
   
    //Get form data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM posts WHERE id = {$delete_id}";   

    if(mysqli_query($conn, $query)) {
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
}
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Create Query
$query = 'SELECT * FROM posts WHERE id=' .$id;
 
// Get results
$result = mysqli_query($conn, $query);

// Fetch data
$post = mysqli_fetch_assoc($result);

// Free Result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
    <div class="container">
        <a class="btn btn-default" href="<?php echo ROOT_URL;?>">Back</a>
        <h1><?php echo $post['title']; ?></h1>
        <small>Created on <?php echo $post['created_at']; ?> by <?php 
        echo $post['author']; ?></small>
        <p><?php echo $post['body']; ?></p>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-outline-danger ">
        </div>
        </form>
        <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class='btn btn-outline-primary'>Edit post</a>
    </div>
<?php include('inc/footer.php'); ?>