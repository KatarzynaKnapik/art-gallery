
<?php include('db_connect.php'); ?>
<?php
    $sql_artysci = $conn->prepare('SELECT id_artysty, imie, nazwisko, opis FROM artysci ORDER BY nazwisko ');
    $sql_artysci->execute();
    
    $artists = $sql_artysci->fetchAll();
    
?>

<!doctype html>
<html>
    <?php include('templates/header.php'); ?>

    <section style="padding-top: 20px;">
        <div class="container">

        <?php foreach($artists as $artist): ?>

            <?php 
                $sql_obrazy = $conn->prepare("SELECT tytul, technika, format, polozenie, cena, obraz FROM obrazy WHERE id_artysty = ".$artist['id_artysty']." LIMIT 50");
                $sql_obrazy->execute();
                $pictures = $sql_obrazy->fetchAll();
                if ($pictures) :
            ?>
            
            <div class="row">
                <h1><?php echo $artist['imie']." ".$artist['nazwisko']; ?></h1>
                <?php foreach($pictures as $pic): ?>
                    <?php if($pic['obraz']): ?>
                        <div class="col s12 l4 cards-container" style="padding-top: 20px; padding-bottom: 20px;">
                            <div class="card medium">
                                <div class="card-image " style="max-height: 400px; overflow: hidden;">
                                    <?php
                                        $obraz = "img/";
                                        $obraz .= $pic['obraz'];
                                    ?>
                                    <img class="activator responsive-img materialboxed" src="<?php echo $obraz ?>"></img>
                                </div>
                            </div>  
                        </div>
                    <?php endif;?>
                <?php endforeach ; ?>  
            </div>
            <?php endif ;?>


        <?php endforeach; ?>


        
        </div>
    </section>

    <?php include('templates/footer.php'); ?>

    
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();            
        });

    </script>
</html>