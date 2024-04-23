<?php require_once('parts/header.php') ?>
<main>
    <div class="login-form">
        <h2>Prihláste sa</h2>
        <form action="" method="POST">
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input name="heslo" type="password" class="form-control" placeholder="Heslo" required="required">
            </div>
            <div class="form-group">
                <button name="login" type="submit" class="btn btn-dark btn-block login-btn">Prihlásiť</button>
            </div>
            <a href="registracia.php">Nemáte registráciu?</a>
            <?php

            if (isset($_POST['login'])) {
                $meno = $_POST['email'];
                $heslo = $_POST['heslo'];

                $login = new Login();

                $user = $login->login($meno, $heslo);

                if ($user === true) {
                    header("Location: index.php");
                    exit();
                } elseif ($user === false) {
                    echo "Nesprávne prihlasovacie meno alebo heslo!";
                } elseif ($user === "neregistrovany") {
                    echo "Užívateľ sa nenašiel. Prosím zaregistrujte sa.";
                }
            }
            ?>
        </form>
    </div>
</main>
<?php require_once('parts/footer.php')?>
