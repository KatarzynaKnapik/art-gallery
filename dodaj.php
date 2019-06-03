
<?php
include('db_connect.php');

function codeToMessage($code) 
{ 
    switch ($code) { 
        case UPLOAD_ERR_INI_SIZE: 
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
            break; 
        case UPLOAD_ERR_FORM_SIZE: 
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break; 
        case UPLOAD_ERR_PARTIAL: 
            $message = "The uploaded file was only partially uploaded"; 
            break; 
        case UPLOAD_ERR_NO_FILE: 
            $message = "No file was uploaded"; 
            break; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            $message = "Missing a temporary folder"; 
            break; 
        case UPLOAD_ERR_CANT_WRITE: 
            $message = "Failed to write file to disk"; 
            break; 
        case UPLOAD_ERR_EXTENSION: 
            $message = "File upload stopped by extension"; 
            break; 

        default: 
            $message = "Unknown upload error"; 
            break; 
    } 
    return $message; 
}
?>

<!doctype html>
<html>
    <?php include('templates/header.php') ;?>

    <?php
        

        $tytul = $autor = $technika =$format = $polozenie = $cena = $obraz = '';
        $errors = ['tytul'=>'','autor'=>'', 'technika'=>'', 'format'=>'', 'polozenie'=>'', 'cena'=>'', 'obraz'=>'','inne'=>''];

        if(isset($_POST['submit'])){
            if(empty($_POST['tytul'])){
                $errors['tytul'] = "Pole jest wymagane <br />";
            }else{
                $tytul = $_POST['tytul'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($tytul))){
                    $errors['tytul'] = 'Nieobsługiwany tytuł';
                }
            }
            if(empty($_POST['autor'])){
                $errors['autor'] = "Pole jest wymagane <br />";
            }else{
                $autor = $_POST['autor'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($autor))){
                    $errors['autor'] = 'Niepoprawne imię';
                }else{

                    $autor_array = explode(" ", $autor);
                    $imie = $autor_array[0];
                    $nazwisko = $autor_array[1];
                    $sql_artysci = "SELECT id_artysty FROM artysci WHERE imie='$imie' AND nazwisko='$nazwisko'";
                    $autorzy = $conn->query($sql_artysci);
                    $artysta = $autorzy->fetch();
                    if ($artysta) {

                    } else {
                        $errors['autor'] = 'Brak takiego typa';
                    }

                }
            }
            if(empty($_POST['technika'])){
                $errors['technika'] = "Pole jest wymagane <br />";
            }else{
                $technika = $_POST['technika'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($technika))){
                    $errors['technika'] = 'Forma techniki malarskiej jest nieodpowiednia';
                }
            }
            if(empty($_POST['format'])){
                $errors['format'] = "Pole jest wymagane <br />";
            }else{
                $format = $_POST['format'];
                if(!preg_match('/^[0-9]+x[0-9]+$/', trim($format))){
                    $errors['format'] = 'Na przykład: 20x20 ';
                }
            }
            if(empty($_POST['polozenie'])){
                $errors['polozenie'] = "Pole jest wymagane <br />";
            }else{
                $polozenie = $_POST['polozenie'];
                if(!preg_match('/^[a-zA-Z ążźśęćółńŁŹŻŚĄĘŃÓ]+$/', trim($polozenie))){
                    $errors['polozenie'] = 'np. płótno';
                }
            }
            if(empty($_POST['cena'])){
                $errors['cena'] = "Pole jest wymagane <br />";
            }else{
                $cena = $_POST['cena'];
                if(!preg_match('/^[0-9]+$/', trim($cena))){
                    $errors['cena'] = 'liczba';
                }
            }
            if(empty($_FILES['obraz'])) {
                $errors['obraz'] = "Pole jest wymagane <br />";
            } else {
                $obraz = $_FILES['obraz']['name'];
                if ($_FILES['obraz']['error'] != 0) {
                    $errors['obraz'] = codeToMessage($_FILES['obraz']['error']);
                }
            }

            if(array_filter($errors)){

            }else{
                // header('Location: dodaj.php')
                if (move_uploaded_file($_FILES['obraz']['tmp_name'], 'img2/' . $_FILES['obraz']['name'])) {

                    $id_artysty = $artysta['id_artysty'];
                    $stmt = $conn->prepare("INSERT INTO obrazy (id_artysty, tytul, technika, format, polozenie, cena, dostepnosc, obraz) VALUES (?,?,?,?,?,?,?,?)");
                    try {
                        $stmt->execute([$id_artysty, $tytul, $technika, $format, $polozenie, $cena, 1, $obraz]);
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
                } else {
                }
            }
        }

    
    ?>

    <section class="container grey-text" style="padding-top: 50px; padding-bottom: 60px;">
        <div class="row">
            <div class="col s12 l8 offset-l2">
                <h4 class="center">DODAJ OBRAZ:</h4>
                <form class="white" action="dodaj.php" method="POST" enctype="multipart/form-data">
                    <label>Tytuł</label>
                    <input type="text" name="tytul" value="<?php echo htmlspecialchars($tytul); ?>" required>
                    <div class="red-text"><?php echo $errors['tytul'] ?></div>
                    <label>Autor</label>
                    <input type="text" name="autor" value="<?php echo htmlspecialchars($autor); ?>" required>
                    <div class="red-text"><?php echo $errors['autor'] ?></div>
                    <label>Technika</label>
                    <input type="text" name="technika" value="<?php echo htmlspecialchars($technika); ?>">
                    <div class="red-text"><?php echo $errors['technika'] ?></div>
                    <label>Format</label>
                    <input type="text" name="format" value="<?php echo htmlspecialchars($format); ?>">
                    <div class="red-text"><?php echo $errors['format'] ?></div>
                    <label>Położenie</label>
                    <input type="text" name="polozenie" value="<?php echo htmlspecialchars($polozenie); ?>">
                    <div class="red-text"><?php echo $errors['polozenie'] ?></div>
                    <label>Cena</label>
                    <input type="text" name="cena" value="<?php echo htmlspecialchars($cena); ?>">
                    <div class="red-text"><?php echo $errors['cena'] ?></div>
                    <label>Dodaj obraz</label>
                    <input type="file" name="obraz" value="<?php echo htmlspecialchars($obraz); ?>" accept=".png,.jpg">
                    <div class="red-text"><?php echo $errors['obraz'] ?></div>
                    <div class="preview">
                        <img src="" alt="Brak obrazu" style="max-height: 200px; max-width: 200px;"
                    </div>
                    <p><?php echo $obraz; ?></p>
                    <div class="center">
                    <input type="submit" name="submit" value="Dodaj obraz" class="btn brand z-depth-0"></div>

                    <div class="green-text"><?php if(isset($dodano)) {echo $dodano ;} ?></div>
                </form>
            </div>
        </div>
    </section>
    


    <?php include('templates/footer.php') ;?>

    <script>
        function updatePreview() {
            document.querySelector('.preview img').src = window.URL.createObjectURL(document.querySelector("input[name='obraz']").files[0]);
        }
        document.querySelector("input[name='obraz']").addEventListener('change', updatePreview);
    </script>

</html>
