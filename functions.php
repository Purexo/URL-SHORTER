<?php
    /**
    * Fichier de fonction
    */

    include("install.php"); // initialise la bdd si ce n'est pas déa fait.

    $mysqli = new SQLite3('shorter.db');
    $protocol = "http://";
    $domaine = "pupu.eu";

    function redirect() {
        global $mysqli;
        if(isset($_GET["a"])) {

            $id = $_GET["a"];
            $id = base64_decode($id);
            $id = (int)base_convert($id, 36, 10);

            $req = "SELECT link FROM links WHERE id = " . $id;
            $res = $mysqli->query($req);
            $row = $res->fetchArray();
            $link = $row['link'];

    		if ($link != NULL) header('Location: '.$link);
        }
    }

    /**
    * Utilise la vaiable $_POST['lien']) pour l'ajouter à la BDD et fournir l'URL raccourcie
    * la conversion de l'ID de l'URL passe par deux conversions :
    * base10 -> base36 (le plus simple à mettre en place au début)
    * base36 -> base64 (pour donner un petit aspect random à l'URL)
    * @Return : String (genere l'HTML à afficher)
    */
    function shortURL() {
        global $mysqli, $protocol, $domaine;
        $str = "";
        if(isset($_POST['lien'])){
            if (filter_var($_POST['lien'], FILTER_VALIDATE_URL)) {
                $lien = $_POST['lien'];
                $req = "INSERT INTO links ( link ) VALUES ('$lien')";
                $mysqli->query($req);
                $idLien = $mysqli->lastInsertRowID();
                $idLien = base_convert($idLien, 10, 36); // convertion en base36
                $idLien = base64_encode($idLien);
                $link = $protocol . $domaine . "/" . $idLien;

                $str  = '<form class="form-inline form-horizontal">';
                $str .=     '<div class="form-group">';
                $str .=         '<div class="input-group">';
                $str .=             '<div class="input-group-addon"><a href="'.$link.'">Votre lien</a></div>';
                $str .=             '<input type="text" class="form-control" value="'.$link.'">';
                $str .=         '</div>';
                $str .=     '</div>';
                $str .= '</form>';
                $str .= '<hr />';
            }
            else {
                $str = "<p class=\"lead bg-danger\"> Votre lien n'est pas une URL valide </p>";
            }
        }
        return $str;
    }
?>
