<?php


?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>
    <style>
        header{
            background: url(img/paint.jpg);
            background-size: cover;
            background-position: center;
            
            /* min-height: 1200px;   */
        }

        .nav-wrapper .brand {
            color: #fff !important;
        }
        
        @media screen and (min-width: 670px){
            header{
                min-height: 1200px;
            }
        }
    </style>

    <section style="padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col s12 l12" >
                    <h2>Galeria sztuki</h2>
                    <p style="text-align: justify;">StreetPaint Gallery – miejsce spotkań artystów, znawców sztuki i pasjonatów. Jest to krakowska galeria sztuki nowoczesnej 
                    i użytkowej. Jej działalność opiera się na organizowanie wydarzeń, wystaw i innych eventów związanych z malarstwem, 
                    rzeźbą, rysunkiem, grafiką i każdą inną formą sztuki. Prezentowane w niej dzieła to najczęściej prace wybitnych polskich artystów,
                     a także młodych twórców, którzy stawiają swoje pierwsze kroki związane ze sztuką wspóczesną. Dodatkowo dzięki nowoczesnej 
                     technologii StreetPaint Gallery poprzez swoją stronę internetową jest swego rodzaju galerią sztuki online na której znajdą Państwo wybrane 
                     prace artystów związanych z tym miejscem.
                    </p>
                </div>

                <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="card medium">
                        <div class="card-image">
                            <img class="activator responsive-img materialboxed" src="img/art_1.jpg">
                        </div> 
                        <div class="card-content">
                            <span class="card-title">Maziaje na płótnie</span>
                            <p>Autor, który na obrazie potrafi dostrzec to czego inni nie widzą.
                            </p>
                        </div> 
                        <div class="card-action">
                            <a href="#">Przejdż do artysty</a>
                        </div> 
                    </div>  
                </div>
                <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="card medium">
                        <div class="card-image">
                            <img class="activator materialboxed" src="img/art_2.jpg">
                        </div> 
                        <div class="card-content">
                            <span class="card-title">Twarz & Rower</span>
                            <p>Zwykłe graffiti, a robi robote.</p>
                        </div> 
                        <div class="card-action">
                            <a href="#">Przejdż do artysty</a>
                        </div> 
                    </div>  
                </div>
                <div class="col s12 l4" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="card medium">
                        <div class="card-image">
                            <img class="activator materialboxed" src="img/art_3.jpg">
                        </div> 
                        <div class="card-content">
                            <span class="card-title">Drzwi?</span>
                            <p>Twarz namalowana na drzwiach.
                            </p>
                        </div> 
                        <div class="card-action">
                            <a href="#">Przejdż do artysty</a>
                        </div> 
                    </div>  
                </div>

            </div>
            
        </div>

    </section>

    <!-- parallax -->
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/grafiti.jpg" alt="" class="responsive-img"> 
        </div>
    </div>

    <!-- Compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
                $('.materialboxed').materialbox();
                $('.parallax').parallax();
                
            });

        </script>
    
    <?php include('templates/footer.php'); ?>

</html>