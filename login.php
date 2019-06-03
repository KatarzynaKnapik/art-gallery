<?php

    include('db_connect.php');

    $email = $haslo = $haslo2 = '';
    $errors =['email'=>'', 'haslo'=>'','haslo2'=>'','inne'=>''];

    if(isset($_POST['rejestracja'])){

        if(empty($_POST['email'])){
            $errors['email'] = 'Pole wymagane <br />';
        }else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email musi byc prawdziwy';
            }
        }

        if(empty($_POST['haslo'])){
            $errors['haslo'] = 'Pole wymagane <br />';
        }else {
            $haslo = $_POST['haslo'];
        }

        if(empty($_POST['haslo2'])){
            $errors['haslo2'] = 'Pole wymagane <br />';
        }else {
            $haslo2 = $_POST['haslo2'];
            if($haslo2 != $haslo) {
                $errors['haslo2'] = 'Hasła muszą być identyczne';
            }
        }

        $stmt = $conn->prepare("INSERT INTO klienci (email, haslo) VALUES (?,?)");
        try {
            $stmt->execute([$email, $haslo]);
            $dodano = "KONTO ZOSTALO UTWORZONE";
        }
        catch(PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $errors['inne'] = "Duplikat";
            }
            else {
                $errors['inne'] = "Nieznany";
            }
        }    
    }

    if(isset($_POST['login'])){

        if(empty($_POST['email'])){
            $errors['email'] = 'Pole wymagane <br />';
        }else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email musi byc prawdziwy';
            }
        }

        if(empty($_POST['haslo'])){
            $errors['haslo'] = 'Pole wymagane <br />';
        }else {
            $haslo = $_POST['haslo'];   
        }

        if(array_filter($errors)){

        }else{
            $sql_klienci = "SELECT email, haslo, czy_admin FROM klienci WHERE email=:email AND haslo=:haslo";
            $klienci = $conn->prepare($sql_klienci);  
            $klienci->execute(['email'=> $email, 'haslo' => $haslo]);

            $count = $klienci->rowCount();
            if($count > 0) {
                $_SESSION['email'] = $email;
                $_SESSION['czy_admin'] = $klienci->fetch()['czy_admin'];
                header('location: index.php');
            }
        }
    }

?>


<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <!-- <section class="container grey-text" style="padding-top: 140px; padding-bottom: 140px;"> -->
    <!-- <div class="flex"> -->
    <section class="container grey-text" >
        <div class="row">
            <div class="col s12 l5">
                <h4 class="center">Zaloguj się:</h4>
                <div class="red-text"><?php echo $errors['inne'] ?></div>
                <form class="white" action="login.php" method="POST">
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php if(isset($_POST['login'])) echo htmlspecialchars($email); ?>">
                    <div class="red-text"><?php echo $errors['email'] ?></div>
                    <label>Hasło</label>
                    <input type="password" name="haslo" value="<?php if(isset($_POST['login'])) echo htmlspecialchars($haslo); ?>">
                    <div class="red-text"><?php echo $errors['haslo'] ?></div>
                    <div class="center">
                    <input type="submit" name="login" value="zatwierdź" class="btn brand z-depth-0"></div>
                </form>
            </div>
            <div class="col s12 l5 offset-l1">
                <h4 class="center">Zarejestruj się:</h4>
                <div class="red-text"><?php echo $errors['inne'] ?></div>
                <form class="white" action="login.php" method="POST">
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php if(isset($_POST['rejestracja'])) echo htmlspecialchars($email); ?>">
                    <div class="red-text"><?php echo $errors['email'] ?></div>
                    <label>Hasło</label>
                    <input type="password" name="haslo" value="<?php if(isset($_POST['rejestracja'])) echo htmlspecialchars($haslo); ?>">
                    <div class="red-text"><?php echo $errors['haslo'] ?></div>
                    <label>Powtórz hasło</label>
                    <input type="password" name="haslo2" value="<?php if(isset($_POST['rejestracja'])) echo htmlspecialchars($haslo2); ?>">
                    <div class="red-text"><?php echo $errors['haslo2'] ?></div>
                    <label>
                        <input type="checkbox" required>
                        <span>Zapoznałem/am się z regulaminem.</span>
                    </label>
                    <div class="center">
                    <input type="submit" name="rejestracja" value="zatwierdź" class="btn brand z-depth-0"></div>
                    <div class="green-text"><?php if (isset($dodano)) { echo $dodano; } ?></div>
                </form>
            </div>
        </div>
        
    </section>
    <!-- </div> -->
    


    <?php include('templates/footer.php'); ?>
</html>