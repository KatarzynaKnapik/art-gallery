<?php 
    include_once('db_connect.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <title>StreetPaint</title>
    <style>
        header{
            /* background: transparent !important; */
            background-size: cover;
            background-position: center; 
            /* color: red;  */
        }

        @media screen and (max-width: 670px){
            header{
                min-height: 5px;
            }
        }

        html {
            height: 100vh;
        }

        body {
            min-height: 100%;
            /* height: 100%; */
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
/*         
            .flex {
                display: flex;
                flex-wrap: wrap;
                min-height: 100vh;  /*or use calc(100vh - header_height)*/
                } */
        
    </style>
</head>

<body>
    <header>
        <nav class="nav-wrapper orange lighten-1">
            <div class="container blue-text">
                <a href="index.php" class="brand-logo grey-text text-darken-3">StreetPaint</a>
                <a href="#" class="sidenav-trigger grey-text text-darken-3" data-target="mobile-menu">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="brand right hide-on-med-and-down grey-text text-darken-3">
                    <li><a href="artysci.php" class="grey-text text-darken-3">Artyści</a></li>
                    <li><a href="obrazy.php" class="grey-text text-darken-3">Obrazy</a></li>

                    <?php if(isset($_SESSION['czy_admin'])): ?>
                        <li><a href="dodaj_artyste.php"class="grey-text text-darken-3">DODAJ ARTYSTE</a></li>
                        <li><a href="dodaj.php"class="grey-text text-darken-3">DODAJ OBRAZ</a></li>  
                    <?php endif ;?>
                    
                    <?php if(isset($_SESSION['email'])): ?>
                        <li><a href="wyloguj.php"class="grey-text text-darken-3">Wyloguj</a></li> 
                    <?php else: ?>
                        <li><a href="login.php" class="grey-text text-darken-3">Rejestracja/Login</a></li>
                    <?php endif ;?>
                </ul>
                <ul class="sidenav grey lighten-2" id="mobile-menu">
                    <li><a href="artysci.php">Artyści</a></li>
                    <li><a href="obrazy.php">Obrazy</a></li>
                    <li><a href="login.php">Rejestracja/Login</a></li>
                    <li><p><?php echo $_SESSION['email']; ?></p></li>
                </ul>  
            </div>
        </nav>
    </header>