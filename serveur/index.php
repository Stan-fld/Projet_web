
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

  // Call GET method fetch all records
  $method = 'GET';
  $url = 'http://localhost:3000/clientt';
  $data = NULL;

  $clientt = callapi($method, $url, $data);

  //Call GET method fetch single record
  if(isset($_GET['action']) && $_GET['action'] == 'edit') {

    $id = $_GET['id'];

    $method = 'GET';
    $url = 'http://localhost:3000/clientt/'.$id;
    $data = NULL;

    $prod = callapi($method, $url, $data);
    $prod = json_decode($prod);
  }

  //Call DELETE method
  if(isset($_GET['action']) && $_GET['action'] == 'del') {

    $id = $_GET['id'];

    $method = 'DELETE';
    $url = 'http://localhost:3000/clientt/delete/'.$id;
    $data = NULL;

    $result = callapi($method, $url, $data);

    header('location: index.php');
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

      header('location: index.php');
    }

    // Call PUT method
    if($_POST['submit'] == 'update')
    {
      $id = $_POST['id'];

      $method = 'PUT';
      $url = 'http://localhost:3000/clientt/update/'.$id;
      $data = json_encode($_POST);

      $result = callapi($method, $url, $data);

      header('location: index.php');
    }
  }
?>
<!doctype html>
<html>
  <head>
    <title>Call Node.Js API</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1>Call Node.Js API</h1>
      <hr />
      <p><?php echo $result ?></p>
      <form action="" method="POST">
        <div class="form-row">
          <div class="col-md-3">
            <input type="text" name="name" class="form-control" placeholder="nom" />
          </div>
          <div class="col-md-3">
            <input type="text" name="prenom" class="form-control" placeholder="prénom" />
          </div>
          <div class="col-md-3">
            <input type="text" name="mail" class="form-control" placeholder="mail" />
          </div>
          <div class="col-md-3">
            <input type="text" name="MDP" class="form-control" placeholder="MDP" />
          </div>
          <div class="col-md-3">
            <input type="text" name="campus" class="form-control" placeholder="campus" />
          </div>
          <div class="col-md-3">
            <input type="text" name="type" class="form-control" placeholder="type" />
          </div>
        
          <div class="col-md-3">
            <button type="submit" name="submit" value="create" class="btn btn-success">Create</button>
          </div>
        </div>
      </form>
      
      <?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
      <br />
      <form action="" method="POST">
        <div class="form-row">
          <div class="col-md-3">
            <input type="text" name="name" class="form-control" value="<?php echo $prod->name ?>" />
          </div>
          <div class="col-md-3">
            <input type="text" name="sku" class="form-control" value="<?php echo $prod->sku ?>" />
          </div>
          <div class="col-md-3">
            <input type="text" name="price" class="form-control" value="<?php echo $prod->price ?>" />
          </div>
          <div class="col-md-3">
            <input type="hidden" name="id" value="<?php echo $prod->id ?>" />
            <button type="submit" name="submit" value="update" class="btn btn-warning">Update</button>
          </div>
        </div>
      </form>
      <?php } ?>
      <br />
      <div class="row">
        <div class="col-md-12">
          <?php $clientt = json_decode($clientt) ?>
          <?php if(!empty($clientt)) { ?>
            <table class="table">
              <tr>
                <th>#ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>mail</th>
                <th>mot de passe</th>
                <th>campus</th>
                <th>type</th>
              </tr>
            <?php foreach($clientt as $cli) { ?>
              <tr>
                <td><?php echo $cli->Id_Client ?></td>
                <td><?php echo $cli->Nom ?></td>
                <td><?php echo $cli->Prenom ?></td>
                <td><?php echo $cli->Mail ?></td>
                <td><?php echo $cli->MDP ?></td>
                <td><?php echo $cli->Ville ?></td>
                <td><?php echo $cli->type ?></td>
                <td>
                  <a href="index.php?id=<?php echo $cli->id ?>&action=edit" class="btn btn-info btn-sm">Edit</a>
                  <a href="index.php?id=<?php echo $cli->id ?>&action=del" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
            <?php } ?>
            </table>
          <?php } ?>
        </div>
      </div>
    </div>
  </body>
</html>
