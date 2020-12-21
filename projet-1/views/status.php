
<!DOCTYPE html>
<html>

<head>
    <title>
        accueil
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"> </script>

    <script src="https://kit.fontawesome.com/e4c864528c.js" crossorigin="anonymous"></script>

    <?php  if (empty(session_id())) session_start(); ?>

</head>

<body>

<div id="bandeau" class="container-fluid">
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="welcome.php">evenement <i class="far fa-map"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop <i class="fas fa-shopping-cart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pannier.php">panier <i class="fas fa-shopping-basket"></i></a>
                </li>

                <?php if (empty($_SESSION['token'])){ ?>
                    <li class="nav-item" >
                        <a class="nav-link" href="login.php">Connexion<i class="fas fa-sign-out-alt"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">S'inscrire<i class="fas fa-sign-in-alt"></i></a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION['token'])){ ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Déconnexion<i class="fas fa-sign-in-alt"></i></a></li>
                <?php } ?>

            </ul>
        </div>

        <h3>
            status
        </h3>
    </nav>
</div>
<div id="jumbotron2">
    <h2><br><br>
        Proposé aux associations déclarées par application de la<br>
        loi du 1er juillet 1901 et du décret du 16 août 1901.</h2>
</div>
<div  class="jumbotron ">
    <h3>ARTICLE 1- NOM</h3><br>
    <h4>Il est fondé entre les adhérents aux présents statuts une association régie par la loi du 1er juillet 1901 et le décret du 16 août 1901, ayant pour titre : Bureau des Etudiants de l'Arbois</h4>
    <h3>ARTICLE 2 - BUT OBJET</h3><br>
    <h4>Cette association a pour objet l’organisation de la vie étudiante au sein du Cesi de Aix</h4>

    <h3>ARTICLE 3 - SIÈGE SOCIAL</h3><br>
    <h4>Le siège social est fixé à Pavillon Martel, Europôle de l'Arbois, 13545 Aix-en-Provence Il pourra être transféré par simple décision du conseil d'administration ;</h4>

    <h3>Article 4 - DUREE</h3><br>
    <h4>La durée de l’association est illimitée.</h4>

    <h3>ARTICLE 5 - COMPOSITION</h3><br>
    <h4>L'association se compose de :<br>

        Membres fondateurs<br>
        Membres actif<br>
        Membres adhérents</h4><br>
    <h3>ARTICLE 6 - ADMISSION</h3><br>
    <h4>L’association est ouverte aux élèves de l’école se nommant le Cesi et se situant à Aix en Provence.

        « Pour faire partie de l'association, il faut être agréé par le conseil d’administration, qui statue, lors de chacune de ses réunions, sur les demandes d'admission présentées. »</h4>

    <h3>ARTICLE 7 - MEMBRES – COTISATIONS</h3><br>
    <h4>Sont membres fondateur ceux qui ont participé à la constitution de l'association; ils sont dispensés de cotisations; Sont membres actifs et adherents ceux qui ont pris l'engagement de verser annuellement une somme de 1€ à titre de cotisation.</h4>

    <h3>ARTICLE 8. - RADIATIONS</h3><br>
    <h4>La qualité de membre se perd par :

        La démission;
        Le décès;
        La radiation prononcée par le conseil d'administration pour non-paiement de la cotisation ou pour motif grave, l'intéressé ayant été invité à fournir des explications devant le bureau et/ou par écrit.
        le fait de ne plus faire partie des élèves du Cesi d’Aix-en-Provence</h4>

    <h3>ARTICLE 9. - AFFILIATION</h3><br>
    <h4>La présente association peut adhérer à d’autres associations, unions ou regroupements par décision du conseil d’administration.</h4>


    <h3>ARTICLE 10. - RESSOURCES</h3><br>
    <h4>Les ressources de l'association comprennent :

        Le montant des droits d'entrée et des cotisations ;<br>
        Les subventions de l'Etat, des départements et des communes.<br>
        Toutes les ressources autorisées par les lois et règlements en vigueur. »<br>
        Des recettes provenant de la vente de produits, de services ou de prestations fournies par l'association.</h4>

    <h3>ARTICLE 11 - ASSEMBLEE GENERALE ORDINAIRE</h3><br>
    <h4>L'assemblée générale ordinaire comprend les membres actifs de l'association à quelque titre qu'ils soient.

        Elle se réunit chaque année au mois de Septembre Quinze jours au moins avant la date fixée, les membres de l'association sont convoqués par les soins du secrétaire. L'ordre du jour figure sur les convocations. Le président, assisté des membres du conseil, préside l'assemblée et expose la situation morale ou l’activité de l'association. Le trésorier rend compte de sa gestion et soumet les comptes annuels (bilan, compte de résultat et annexe) à l'approbation de l'assemblée. L’assemblée générale fixe le montant des cotisations annuelles et du droit d’entrée à verser par les différentes catégories de membres.

        Ne peuvent être abordés que les points inscrits à l'ordre du jour.

        Les décisions sont prises à la majorité des voix des membres présents ou représentés.

        Il est procédé, après épuisement de l'ordre du jour, au renouvellement des membres sortants du conseil.

        Toutes les délibérations sont prises à main levée, excepté l’élection des membres du conseil.

        Les décisions des assemblées générales s’imposent à tous les membres, y compris absents ou représentés.</h4>

    <h3>ARTICLE 12 - ASSEMBLEE GENERALE EXTRAORDINAIRE</h3><br>
    <h4>Si besoin est, ou sur la demande de la moitié plus un des membres inscrits, le président peut convoquer une assemblée générale extraordinaire, suivant les modalités prévues aux présents statuts et uniquement pour modification des statuts ou la dissolution ou pour des actes portant sur des immeubles.

        Les modalités de convocation sont les mêmes que pour l’assemblée générale ordinaire.

        Les délibérations sont prises à la majorité des membres présents.</h4>


    <h3>ARTICLE 13 - CONSEIL D'ADMINISTRATION</h3><br>
    <h4>L'association est dirigée par un conseil au minimum de 3 membres, élus pour 1 années par l'assemblée générale. Les membres sont rééligibles. En cas de vacances, le conseil pourvoit provisoirement au remplacement de ses membres. Il est procédé à leur remplacement définitif par la plus prochaine assemblée générale. Les pouvoirs des membres ainsi élus prennent fin à l'expiration le mandat des membres remplacés.

</div>

</div>





<footer class="container-fluid" >
    <div class="row col-sm-12 text-center">

        <div class="col-sm-3 ">
            <h2>
                <a href="https://twitter.com/"><i class="fab fa-twitter"> </i></a>
            </h2>
        </div>
        <div class="col-sm-3 ">
            <h2>
                <a href="https://www.youtube.com/"><i class="fab fa-youtube"> </i></a>
            </h2>
        </div>
        <div class="col-sm-3 ">
            <h2>
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"> </i></a>
            </h2>
        </div>
        <div class="col-sm-3 ">
            <h2>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"> </i></a>
            </h2>
        </div>

    </div>
    <br>
    <br>
    <div class="row col-sm-12 text-center">
        <div class="col-sm-3 ">
            <h5>
                <a href="status.php" >nos status</a>
            </h5>
        </div>
        <div class="col-sm-3 ">
            <h5>
                <a href="https://discordapp.com/invite/wHcspBT" >discord</a>
            </h5>
        </div>
        <div class="col-sm-3 ">
            <h5>
                <a href="https://github.com/cesi-it-aix/website" >github</a>
            </h5>
        </div>
        <div class="col-sm-3 ">
            <h5>
                <a href="https://www.documentslegaux.fr/commerce/accord-de-confidentialite/?loc=FR&pid=googlefrance-36451502329-255045048235_sl-ggkey_confidentialit%C3%A9&gclid=Cj0KCQiAn8nuBRCzARIsAJcdIfN2H_g-yWIJwu8vPp8tQMQl9BrOcQZlo0qQyG5sDoBwWipTPT4EPgUaAtgCEALw_wcB" >politique de confidentialité</a>
            </h5>
        </div>
    </div>
</footer>

</body>
</html>
