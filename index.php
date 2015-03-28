<?php
/***************************/
/* Ceci est un raccourcisseur d'url
/* Il fonctionne en 3 temps :
/* 1- l'utilisateur rentre son lien à raccourcir
/* 2- le lien est rentré dans la base de donné, la page fournit à l'utilisateur son lien
/* 3- le lien fourni contient une variable a contenant l'id du lien demandé une requete sql fourni le lien grace à l'id puis la page redirige vers le lien
/*
/* Conseil d'utilisation :
/* - utiliser ce script sous le non de index.php dans la racine du serveur qui lui seras "dédié"
/* - faire un peu d'urlrewriting afin que http://hostname/id redirige vers http://hostname/index.php?a=id (afin d'avoir le lien le plus court possible)
/* - avoir un nom de domaine tres court genre li.fr
/*
/* Pourquoi avoir fait mon raccourcisseur d'url ? :
/* - Pour m'entrainer
/* - j'en souhaitais un le plus minimaliste possible : pas de pub, pas de temps d'attente, pas de vérification d'url (ce qui est à la fois un avantage et un désavantage)
/*
/* Avantage et désavantage :
/* le script ne verifie rien, n'altère rien : il execute, j'imagine que par conséquent il y a de grosse faille de sécurité, mais cela me permet d'entré de liens
/* autodestructible via zerobin sans que celui-ci ne soit analysé et donc détruit par une machine automatiquement.
/*
/* Ajouts :
/* - ID en hexadecimale (prend moins de place)
/* - Fonction de verification de l'URL Fourni on regarde si l'URL est valide via une Regex, pas en spyant l'url.
****************************/
include("functions.php");
redirect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <meta name="google-site-verification" content="QWN9ZmAViWUWnz1jf_r6N0QDA88a7cYl-R0l-H15_pA" />

        <title> Raccourcisseur d'url </title>
        <link rel="icon" type="image/png" href="style/favicon.png" />
        <style>
        .starter-template {
            padding: 0px 15px;
            text-align: center;
        }
        input {
            text-align: center;
        }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand active" href=".">URL-SHORTER</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="https://twitter.com/Purexo_">Contact</a></li>
                        <li><a href="https://github.com/purexo/URL-SHORTER">Fork me on Github</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="starter-template">
                <h1>Racourcissez vos URL</h1> <hr />
                <?php echo shortURL(); ?>
                <form method="post" action="./">
                    <div class="form-group">
                        <input type="text" class="form-control" name="lien" placeholder="Votre lien à raccourcir :)">
                    </div>
                    <button type="submit" class="btn btn-default">Envoyer</button>
                </form> <hr />
                <p>N'hésitez pas à partager ce service. Soyez sage ;)</p>
                <p>
                    Si vous aimez ce site, partagez-le à vos amis, et n'hésitez pas à faire une donation : <br />
                    <a href="dogecoin://DCioevCoTpFYnJPEPAFdg6GJc8nywCCbaS">DogeCoin</a> : DCioevCoTpFYnJPEPAFdg6GJc8nywCCbaS <br />
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=KFNCYZ6YGGBLG">Paypal</a>
                </p>
            </div>

        </div><!-- /.container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
