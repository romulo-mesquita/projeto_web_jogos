<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require("bd/conexao.php");

?>

<html>

    <head>
        <meta charset="UTF-8">
        <title>Meus jogos</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />      
        <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <script src="js/bootstrap.js"></script>         -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>    
    </head>

    <body id="page-top">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <?php
                    if(!isset($_SESSION["nome"])){
                ?>  
                    <a class="navbar-brand" href="?pg=inicio">MEUS JOGOS</a>                    
                <?php
                    }
                    else{
                ?>
                    <a class="navbar-brand" href="?pg=inicio">Olá <?=$_SESSION["nome"]?></a>
                <?php
                    }                    
                ?>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=sobre">Sobre</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=jogos">Jogos</a></li>                        
                        <?php 
                        if(!isset($_SESSION["nome"])){
                        ?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=contato/formulario">Contato</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=login/formulario">Login</a></li>
                        <?php
                            }
                            else{
                        ?>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=area_restrita">Área restrita</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=cruds/cadastrar">Cadastrar Jogo</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=cadastrar_categoria">Cadastrar Categoria</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?pg=login/limpar_sessao">Sair</a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php

            /* Operador ternário para verificar se o pg está setado no GET e não está vazio
                Caso verdadeiro: usa o valor do GET["pg"]
                Caso falso: usa o valor "inicio"
            */
            $pg = (isset($_GET["pg"]) && !empty($_GET["pg"])) ? $_GET["pg"] : "inicio";
            
            $id = (isset($_GET["id"]) && !empty($_GET["id"]));

            if(isset($id)){
                include("paginas/".$pg.".php");
            }
            else{                        
                include("paginas/".$pg.".php?id=".$id);
            }
            

        ?>
            

    </body>
    
</html>