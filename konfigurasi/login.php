<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    .title {
      writing-mode: vertical-lr;
      text-orientation: upright;
      background-color:salmon;
      font-weight: bold;
      color: white;
    }

    .login {
      width: 100vw;
      height: 80vh;
      margin: 10vh 0;
    }
  </style>
</head>
<?php
include 'head.php';
include 'conn.php';
$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `company` WHERE id=1"));
echo $_SESSION;

?>

<body>
  <div class="container login">
    <div class="row w-100 h-100 d-flex align-items-center justify-content-center border rounded">
      <div class="col-4 title h-100 border justify-content-center w-100 align-items-center d-flex flex-column">
        <?php foreach (explode(" ", $data[1]) as $text)
          echo "<p>" . $text . "</p>";
        ?>
      </div>
      <div class="col-8 border h-100">
        <form class="h-100 d-flex justify-content-center flex-column p-5" method="post" action="action-login.php">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter Username">
            <small id="emailHelp" class="form-text text-muted">Masukan username yang sudah didaftarkan</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">masukan password sesuai username yang tertera</small>
          </div>
          <div class="row">
            <div class="col w-100">
              <input type="submit" name="login" class="btn btn-primary w-100" value="Login"/>
            </div>
            <div class="col">
            <input type="reset" name="reset" class="btn btn-danger w-100" value="Reset"/>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</body>
<?php include 'foot.php'; ?>

</html>