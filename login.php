<?php 
include './conn.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cek = mysqli_fetch_array(mysqli_query($con, "SELECT * from user where username='$username' AND password='$password'"));
    if ($cek) {
        $_SESSION['username'] = $cek[1];
        header('Location: konfigurasi');
    } else {
        header('Location: login.php?error=1');
    }
}
if (isset($_SESSION['username'])) {
    header('Location: konfigurasi');
} ?>
<!DOCTYPE html>
<html>
<head>
	<style>
	body {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
}

.loginBox {
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 350px;
  height: 420px;
  padding: 70px 40px;
  box-sizing: border-box;
  background: rgba(0, 0, 0, 0.5);
}

.user {
  width: 80px;
  height: auto;
  border-radius: 0%;
  overflow: hidden;
  position: absolute;
  top: calc(-120px/2);
  left: calc(50% - 40px);
}

h2 {
  margin: 0;
  padding: 0 0 26px;
  color: #ff8c00;
  text-align: center;
}

.loginBox p {
  margin: 0;
  padding: 0;
  font-weight: bold;
  color: #fff;
}

.loginBox input {
  width: 100%;
  margin-bottom: 20px;
}

.loginBox input[type="text"],
.loginBox input[type="password"] {
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 40px;
  color: #fff;
  font-size: 16px;
}

::placeholder
{
  color: rgba(255, 255, 255, 0.5);
}

.loginBox input[type="submit"] {
  border: none;
  outline: none;
  height: 40px;
  color: #eee;
  font-size: 16px;
  background-color: #FF8C00;
  cursor: pointer;
  border-radius: 20px;
  margin: 12px 0 18px;
}

.loginBox input[type="submit"]:hover {
  background-color: #ff9719;
  color: #fff;
}

.loginBox a {
  color: #fff;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
}
</style>
</head>
<?php $warna=mysqli_query($con, "SELECT * FROM `konfigurasi`") or die(mysql_error());
$data_warna=mysqli_fetch_array($warna);?>
<body style="background-color:<?php echo $data_warna['clockcolor'];?>">
 <div class="loginBox">
  <img class="user" src="img/riau.png">
  <h2>Log In Here</h2>
  <form method="post">
    <p>Username</p>
    <input type="text" name="username" placeholder="Enter Username">
    <p>Password</p>
    <input type="password" name="password" placeholder="Enter Password">
    <input type="submit" onclick="doNothing(e)" name="login" value="Sign In">
	</form>

</div>

</body>
</html>