
<?php include('db_connect.php'); ?>

<!doctype html>
<html>
    <?php include('templates/header.php') ;?>

    <?php
        

        $imie = $nazwisko = $opis ='';
        $errors = ['imie'=>'','nazwisko'=>'', 'opis'=>'', 'inne'=>''];

        if(isset($_POST['submit'])){
            if(empty($_POST['imie'])){
                $errors['imie'] = "Pole jest wymagane <br />";
            }else{
                $imie = $_POST['imie'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($imie))){
                    $errors['imie'] = 'Podaj poprawne imię';
                }
            }
            if(empty($_POST['nazwisko'])){
                $errors['nazwisko'] = "Pole jest wymagane <br />";
            }else{
                $nazwisko = $_POST['nazwisko'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($nazwisko))){
                    $errors['nazwisko'] = 'Podaj poprawne nazwisko';
                }
                }
            
            if(empty($_POST['opis'])){
                $errors['opis'] = "Pole jest wymagane <br />";
            }else{
                $opis = $_POST['opis'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($opis))){
                    $errors['opis'] = 'Nieoporawny opis';
                }
            }


            if(array_filter($errors)){

            }else{
                // $insert = "INSERT INTO artysci (imie, nazwisko, opis) VALUES ('$imie', '$nazwisko', '$opis')";
                // $conn->exec($insert);
                $stmt = $conn->prepare("INSERT INTO artysci (imie, nazwisko, opis) VALUES (?,?,?)");
                try {
                    $stmt->execute([$imie, $nazwisko, $opis]);
                    $dodano = "DODANO";
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
        }

    
    ?>

    <section class="container grey-text" style="padding-top: 50px; padding-bottom: 60px;">
        <div class="row">
            <div class="col s12 l8 offset-l2">
                <h4 class="center">DODAJ ARTYSTĘ:</h4>
                <div class="red-text"><?php echo $errors['inne'] ?></div>
                <form class="white" action="dodaj_artyste.php" method="POST">
                    <label>Imię</label>
                    <input type="text" name="imie" value="<?php echo htmlspecialchars($imie); ?>" required>
                    <div class="red-text"><?php echo $errors['imie'] ?></div>
                    <label>Nazwisko</label>
                    <input type="text" name="nazwisko" value="<?php echo htmlspecialchars($nazwisko); ?>" required>
                    <div class="red-text"><?php echo $errors['nazwisko'] ?></div>
                    <label>Opis</label>
                    <input type="text" name="opis" value="<?php echo htmlspecialchars($opis); ?>">
                    <div class="red-text"><?php echo $errors['opis'] ?></div>
                   
                    <div class="center">
                    <input type="submit" name="submit" value="Dodaj artystę" class="btn brand z-depth-0"></div>

                    <div class="green-text"><?php if (isset($dodano)) { echo $dodano; } ?></div>
                </form>
            </div>
        </div>
    </section>


    <?php include('templates/footer.php'); ?>

</html>