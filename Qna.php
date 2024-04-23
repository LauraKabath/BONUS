<?php require_once('parts/header.php') ?>

<main>
    <h1 class="text-center">Otázky a odpovede</h1>

    <?php
    $qna = new QNA();
    $qna->insertQnA();
    $qna->nacitajOtazky();
    ?>
    <?php
    if ($qna->isLoggedIn()) {
        ?>
        <section class="container mt-5">
            <h2 class="text-center">Manažovanie otázok</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="index"> Index:</label>
                    <input type="text" name="index" id="index" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="question">Nová otázka: </label>
                    <input type="text" name="question" id="question" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="answer">Nová odpoveď: </label>
                    <textarea name="answer" id="answer" rows="4" class="form-control" required></textarea>
                </div>
                <div class="container mt-3">
                    <button type="submit" name="update" class="btn btn-success btn-block mx-5">Update</button>
                    <button type="submit" name="delete" class="btn btn-danger btn-block">Delete</button>
                </div>
            </form>
        </section>
    <?php } ?>
    <?php
    if (isset($_POST['update'])) {
        $index = $_POST['index'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $qna->updateQuestion($index, $question, $answer);
    }

    if (isset($_POST['delete'])) {
        $index = $_POST['index'];
        $qna->deleteQuestion($index);
    }
    ?>
</main>

<?php require_once('parts/footer.php') ?>
