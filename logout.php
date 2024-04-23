<?php require_once('parts/header.php') ?>
<main>
    <section>
        <?php
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        header('Location: login.php');
        ?>
    </section>
</main>
<?php require_once('parts/footer.php') ?>
