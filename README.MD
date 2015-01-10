Shortener-URL-Redirect
======================

Script php permettant de raccourcir un lien. le lien raccourci redirigera automatiquement vers sa destination

A Propos :
======================
- Ce script php raccourcis simplement une URL donné par un utilisateur pour lui fournir un lien redirigeant vers celle-ci.
- Le script verifie que l'utilisateur a rentré une URL correcte via filter_var(FILTER_VALIDATE_URL), ce qui veut dire que l'url n'est pas visité
- Fonctionne sans cookie, sans authentification, sans enrigistrement des données de l'utilisateur(: pas d'ip sauvegardé par exemple),

Prerequi :
======================
- Avoir un domaine dédié : pour ma part c'est pupu.eu (pour avoir le lien le plus court possible, apres ça peut marcher dans <http://exemple.exemples.ctropswag.com/emplacement/dossier/short>, mais je doute que votre URL sois reelement raccourcie :p)
- Compatibilité php sqlite3 (apt-get install php5-sqlite)
- s'assurer que l'utilisation de .htaccess est possible, sinon adaptez

Instalation :
======================
1. editer dans index.php : $protocol $domaine pour correspondre à votre configuration
2. Enjoy

Utilisation :
======================
acceder à votre nom de domaine dans votre navigateur, enjoy.
