<?php require_once('parts/header.php') ?>
<main>
    <div class="registration-form">
        <h2>Kontaktujte nás</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Meno" required="required">
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input name="notes" type="textarea" class="form-control" placeholder="Sem napíšte svoj dotaz..." required="required">
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-dark btn-block">Odoslať</button>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $meno = $_POST['name'];
            $email = $_POST['email'];
            $notes = $_POST['notes'];

            $form = new Kontakt();
            if ($form->addNote($meno, $email, $notes)) {
                header("Location: thank.php");
            } else {
                echo 'Nastala chyba pri odosielaní formulára';
            }
        }
        ?>
    </div>
</main>
<?php require_once('parts/footer.php')?>
