<?php require_once('parts/header.php') ?>
<main>
    <div class="registration-form">
        <h2>Registrácia</h2>
        <form action="" method="POST">
            <div class="form-group">
                <input name="meno" type="text" class="form-control" placeholder="Meno" required="required">
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input name="heslo" type="password" class="form-control" placeholder="Heslo" required="required">
            </div>
            <div class="form-group">
                <input name="repeat_heslo" type="password" class="form-control" placeholder="Potvrďte heslo" required="required">
            </div>
            <div class="form-group">
                <button name="register" type="submit" class="btn btn-success btn-block register-btn">Registrovať</button>
            </div>
            <?php

            if (isset($_POST['register'])){
                $meno = $_POST['meno'];
                $heslo = $_POST['heslo'];
                $repeatHeslo = $_POST['repeat_heslo'];
                $email = $_POST['email'];

                $login = new Login();
                if ($login->register($meno, $heslo, $repeatHeslo, $email)) {
                    echo "Registracia bola uspesna!";
                } else {
                    echo "Hesla sa nezhoduju!";
                }
            }
            ?>
        </form>
    </div>
</main>
<?php require_once('parts/footer.php')?>
