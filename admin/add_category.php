<?php
include 'inc/header.php';

// get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>

<!-- add_category page -->
<section class="form_section">
    <div class="container form_section_container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert_message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
            <textarea rows="4" value="<?= $description ?>" name="description" placeholder="Description"></textarea>
            <button type="submit" name="submit" class="btn">Add category</button>
        </form>
    </div>
</section>

<?php
include '../inc/footer.php';
?>