<?php
include 'inc/header.php';


// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<!-- individual post section -->
<section class="single_post">
    <div class="container single_post_container">
        <h2><?= $post['title'] ?></h2>
        <div class="post_author">
        <?php
            // fetch author from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            ?>
            <div class="post_author_profile">
            <img src="./images/<?= $author['profile'] ?>">
            </div>
            <div class="post_author_info">
            <h5>by <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="single_post_thumbnail">
        <img src="./images/<?= $post['thumbnail'] ?>">
        </div>
        <p>
            <?= $post['body'] ?>
        </p>
    </div>
</section>
<?php
include 'inc/footer.php'
?>