
<?php include('db_connect.php'); ?>
<?php
    $sql_artysci = 'SELECT id_artysty, imie, nazwisko, opis FROM artysci ORDER BY nazwisko';
    $artists = $conn->query($sql_artysci);
    
?>

<!doctype html>
<html>
    <?php include('templates/header.php'); ?>

    <section style="padding-top: 20px;">
        <div class="container">

        <?php foreach($artists as $artist): ?>
            <?php 
                $sql_obrazy = "SELECT tytul, technika, format, polozenie, cena, obraz FROM obrazy WHERE id_artysty = ".$artist['id_artysty']." LIMIT 2";
                $pictures = $conn->query($sql_obrazy);
            ?>
            
            <div class="row">
                <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="card">
                        <!-- <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="img/art_1.jpg">
                        </div>  -->
                        <div class="card-content">
                            <span class="card-title"><a href="obrazy.php"><?php echo $artist['imie']." ".$artist['nazwisko']; ?></a></span>
                            <p>a<?php echo $artist['opis']; ?></p>
                        </div> 
                
                    </div>  
                </div>
                <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="card">
                        <div class="card-image">
                            <?php
                                $pierwszy = $pictures->fetch();
                                $obraz = "img/";
                                if ($pierwszy) {
                                    $obraz .= $pierwszy['obraz'];
                                }
                                else {
                                    $obraz .= 'no-image.svg';
                                }
                            ?>
                            <img class="activator materialbpxed" style="max-height: 400px; overflow: hidden;" src=<?php echo $obraz; ?> >
                        </div>  
                    </div>  
                </div>
                <!-- drugi obraz -->
                <?php 
                    $drugi = $pictures->fetch();
                    if($drugi): ?>

                        <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                            <div class="card">
                                <div class="card-image">
                                    <?php
                                        
                                        $obraz = "img/";
                                        $obraz .= $drugi['obraz'];                                
                                    ?>
                                    <img class="activator materialboxed" style="max-height: 400px; overflow: hidden;" src=<?php echo $obraz; ?>>
                                </div>  
                            </div>  
                        </div>
                    <?php endif ; ?>
                <!--  -->
            </div>
        <?php endforeach; ?>
            
        </div>

    </section>
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();            
        });

    </script>

    <?php include('templates/footer.php'); ?>
</html>