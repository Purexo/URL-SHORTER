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
    include("install.php"); // initialise la bdd si ce n'est pas déa fait.

    $mysqli = new SQLite3('shorter.db');
    $protocol = "http://";
    $domaine = "pupu.eu";
    
    if(isset($_GET["a"])) {
        /*
        * Le code à évolué, pour une compatibilitées anciens liens, on verifie que l'id passé bien en base64, sinon c'est qu'il est en base36
        */
        $a = $_GET["a"];
        //$a = urldecode($_GET["a"]);
        $ab = base64_decode($a); // on decode du base64
        if ($ab != false) $ab = base_convert($ab, 36, 10); // si la convertion a été faite avec succes on decode du base36 le decodage du base64
        else $ab = base_convert($a, 36, 10); // sinon convertion de l'id en base36 vers décimale

        $req = "SELECT link FROM links WHERE id = " . (int)$ab;
        $res = $mysqli->query($req);
        $row = $res->fetchArray();
        $link = $row['link'];
        if ($link == NULL) header('Location: http://pupu.eu/');
		else header('Location: '.$link);
    }

?>
<!DOCTYPE html>
<html>
  <head>
	<meta name="google-site-verification" content="QWN9ZmAViWUWnz1jf_r6N0QDA88a7cYl-R0l-H15_pA" />
    <title> Raccourcisseur d'url </title>
    <link rel="icon" type="image/png" href="/style/favicon.png" />
    <link rel="stylesheet" href="/style/style.css" />
  </head>
  <body>
    <center>
        <a href="."><h1></h1></a> <!-- header image -->
        <h6>Propulsé par <a href="http://www.sqlite.org/">SQlite3</a>, URL maintenant en base36</h6>
            <?php
            
                if(isset($_POST['lien'])){
                    if (filter_var($_POST['lien'], FILTER_VALIDATE_URL)) {
                        $req = 'INSERT INTO links ( link ) VALUES ("'.$_POST['lien'].'")';
                        $mysqli->query($req);
                        $idLien = $mysqli->lastInsertRowID();
                        $idLien = base_convert($idLien, 10, 36); // convertion en base36
                        $idLien = base64_encode($idLien);
                        //$idLien = urlencode($idLien);
                        $link = $protocol . $domaine . "/" . $idLien;
                        echo '<p><a id="lien" href="'.$link.'">Votre Lien</a> : <textarea style="width: 150px; height: 17px;">'.$link.'</textarea></p>';
                    }
                    else {
                        echo '<p> Votre lien n\'est pas une URL valide </p>';
                    }
                }
            
            ?>
            <form method="post" action="./">
                <textarea name="lien" placeholder="Votre lien à raccourcir :)"></textarea><br />
                <input type="submit" value="Envoyer" />
                <p>N'hésitez pas à partager ce service. Soyez sage ;)</p>
                <p>
                    Si vous aimez ce site, partagez le à vos amis, et n'hésitez pas à faire une donnation : <br />
                    <a href="dogecoin://DCioevCoTpFYnJPEPAFdg6GJc8nywCCbaS">Dons DogeCoin</a> : DCioevCoTpFYnJPEPAFdg6GJc8nywCCbaS <br />
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=KFNCYZ6YGGBLG"> Dons Paypal </a>
                </p>
            </form>
        <div id="pub"><script type="text/javascript" src="http://ad.pandad.eu/get-script/53e12626cef7f39f3620c46a/468x60"></script></div>
    </center>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.purexo.eu/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 3]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//piwik.purexo.eu/piwik.php?idsite=3" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

  </body>
</html>
