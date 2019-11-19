<?php
function callApi($method, $url, $data) {

    $ch = curl_init();

    if($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close ($ch);
    return $output;
}

if(isset($_POST['submit']))
{
    if($_POST['submit'] == 'create')
    {
        $method = 'POST';
        $url = 'http://localhost:3000/clientt/create';
        $data = json_encode($_POST);
        $result = callApi($method, $url, $data);
        header('location: welcome.php');
    }
}
?>

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
    <link rel="stylesheet" href="../assets/js/index.js">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"> </script>

    <script src="https://kit.fontawesome.com/e4c864528c.js" crossorigin="anonymous"></script>


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

                <li class="nav-item">
                    <a class="nav-link" href="inscription.php">register <i class="fas fa-sign-in-alt"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">login <i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>

        <h3>
            inscription
        </h3>
    </nav>
</div>
<div class="jumbotron card-body">
    <br>
    <form method="POST" class="container-fluid">

         <legende>inscrivez-vous</legende>
        <br>
        <br>

        <div class="col-sm-12 ">
            <div class="col-sm-6">
                <input type="text" name="name" placeholder="nom" class="form-control"  />
            </div>
            <br>
            <div class="col-sm-6">
                <input type="text" name="prenom" placeholder="prenom" class="form-control"  />
            </div>
            <br>
            <div class="col-sm-6">
                <input type="email" name="mail" required pattern=".*@.*\..*" placeholder="email" class="form-control" />
            </div>
            <br>
            <div class="col-sm-6">
                <input type="password" name="MDP"  placeholder="password" class="form-control" />
            </div>
            <br>
            <div class="col-sm-6">
                <select class="form-control" type="text" name="Campus"  size="1" >
                    <option>--Selectionnez votre centre--
                    <option>Aix-en-Provence
                    <option>Angoulême
                    <option>Arras
                    <option>Bordeaux
                    <option>Brest
                    <option>Caen
                    <option>Châteauroux
                    <option>Dijon
                    <option>Grenoble
                    <option>La Rochelle
                    <option>Le Mans
                    <option>Lille
                    <option>Lyon
                    <option>Montpellier
                    <option>Nancy
                    <option>Nantes
                    <option>Nice
                    <option>Orléans
                    <option>Paris Nanterre
                    <option>Pau
                    <option>Reims
                    <option>Rouen
                    <option>Saint-Nantaire
                    <option>Strasbourg
                    <option>Toulouse
                </select>
            </div>
            <br>
            <div class="col-sm-6">
                <select class="form-control" type="text" name="type"  size="1" >
                    <option>--Selectionnez votre type--
                    <option>étudiant
                    <option>BDE
                    <option>personnel cesi
                </select>
                <br>
                <div class="col-sm-6 center-block" >
                    <button type="submit" name="submit" value="create" class="btn btn-success">m'inscrire</button>
                </div>
                <br>

                <div> <input type="checkbox" required name="case" > <a href="status.php" ><u>j'accepte les mentions légales</u> </a> </div>
            </div>

    </form>
</div>




<footer class="container-fluid" style="position: absolute">
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
                        <a href="" >bde-aix@viacesi.fr</a>
                    </h5>
                </div>
            </div>
</footer>

</body>
</html>