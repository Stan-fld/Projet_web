<?php
/*callapi function start */
function callapi($method, $url, $data) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    if($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    if($method == 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    if($method == 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
/*callapi function end */

$result = '';


// Call GET method fetch all
$client = callapi($method = 'GET', $url = 'http://localhost:3000/clientt', $data = NULL);

//Call GET method fetch single record
if(isset($_GET['action']) && $_GET['action'] == 'edit') {

    $id = $_GET['id'];

    $method = 'GET';
    $url = 'http://localhost:3000/article/'.$id;
    $data = NULL;

    $prod = callapi($method, $url, $data);
    $prod = json_decode($prod);
}

//Call DELETE method
if(isset($_GET['action']) && $_GET['action'] == 'del') {

    $id = $_GET['id'];

    $method = 'DELETE';
    $url = 'http://localhost:3000/article/delete/'.$id;
    $data = NULL;

    $result = callapi($method, $url, $data);


}

if(isset($_POST['submit']))
{
    // Call POST method
    if($_POST['submit'] == 'create')
    {
        $method = 'POST';
        $url = 'http://localhost:3000/clientt/create';
        $data = json_encode($_POST);

        $result = callapi($method, $url, $data);


    }

    // Call PUT method
    if($_POST['submit'] == 'update')
    {
        $id = $_POST['id'];

        $method = 'PUT';
        $url = 'http://localhost:3000/article/update/'.$id;
        $data = json_encode($_POST);

        $result = callapi($method, $url, $data);

        header('location: index.php');
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

                <?php if (isset($_SESSION['token'])){ ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"><?php echo "$_SESSION[Mail]" ?><br></a></li>
                <?php } ?>
            </ul>
        </div>

        <h3>
            login
        </h3>
    </nav>
</div>


<div class="jumbotron card-body">
    <br>
    <form method="POST" class="container-fluid">
        <legende>connectez-vous</legende>
        <br>
        <br>
        <div class="col-sm-12 ">
            <div class="col-sm-6">
                <input type="email" name="Mail" placeholder="mail" class="form-control"/>
            </div><br>
            <div class="col-sm-6">
                <input type="password" name="MDP" placeholder="mot de passe" class="form-control"/>
            </div><br>

            <div class="col-sm-6 center-block" >
                <button type="submit" name="submit" class="btn btn-success">se connecter</button>
            </div>
            <br>

        </div>

        </div>

<?php if(isset($_POST['Mail'])){ 
    $_SESSION['Mail'] = $_POST['Mail'];?>

<?php $client = json_decode($client) ?>
<?php $mdp = NULL ?>
<?php if(!empty($client)){ ?>
    <?php foreach($client as $cl) { ?>
        <?php if($cl->Mail == $_POST['Mail']){ ?>
            <?php
            $mdp = $cl->MDP;
            $prenom = $cl->Prenom;
            $nom = $cl->Nom;
            $mail = $cl->Mail;
            $ville = $cl->Ville;
            $statut = $cl->type;
            ?>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php
//$isPasswordCorrect = password_verify($_POST['MDP'], $mdp);

if (!$mdp){
    echo '<p class="forgot">/!\ Mauvais identifiant ou mot de passe /!\</p>';
}
else {
    if ($mdp == $_POST['MDP']) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Nom'] = $nom;
        $_SESSION['Mail'] = $mail;
        $_SESSION['Ville'] = $ville;
        $_SESSION['type'] = $statut;
        header('Location: /views/welcome.php');
        exit();
    }
    else {
        echo '<p class="forgot">/!\ Mauvais identifiant ou mot de passe /!\</p>';
    }
}
?>
<?php } ?>
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