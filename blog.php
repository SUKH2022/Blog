<?php
include 'inc/header.php';

// fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

<!-- Search section  -->
<section class="search_bar">
<form class="container search_bar_container" action="<?= ROOT_URL ?>search.php" method="GET">

        <div>
            <i class="uil uil-search"></i>
            <input class="search_bar_input" type="search" name="search" placeholder="Search...">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>
    </form>
</section>

<!-- posts section -->
<section class="posts <?= $featured ? '' : 'section_extra_margin' ?>">
    <div class="container posts_container">
    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post_thumbnail">
                <img src="./images/<?= $post['thumbnail'] ?>">
            </div>
            <div class="post_info">
            <?php
                    // fetch category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>
                <a href="<?= ROOT_URL ?>category-post.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category['title'] ?></a>
                <h3 class="post_title">
                <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
            </h3>
                <p class="post_body">
                    <?= substr($post['body'], 0, 150) ?>...
            </p>
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
                    <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
                            <small>
                                <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                    </div>
                </div>
            </div>
        </article>
        <?php endwhile ?>
    </div>
</section>

<!-- category button at the bottom of the page -->
<section class="category_buttons">
    <div class="container category_buttons_container">
    <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title'] ?></a>
        <?php endwhile ?>  
    </div>
</section>

<?php
include 'inc/footer.php'
?>