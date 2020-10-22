<?php
include './conn.php';
include 'head.php';

if (isset($_POST['btnUpdate'])) {
  $postData = $_POST["companyname"];
  mysqli_query($con,"UPDATE `company` SET `name`='$postData' WHERE id=1");
}
$data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `company` WHERE id=1"));
?>
<?php include 'asides.php' ?>
<div class="main-content my-5 pt-5 mr-5">
  <form enctype="multipart/form-data" method="post">
    <label class="my-3 font-weight-bold">Set Company Name</label>
    <input class="my-5 form-control" name="companyname" value="<?php echo $data['name']?>" />
    <button class="btn btn-info " name="btnUpdate" type="submit">
      Update Company Name
    </button>
  </form>
</div>
<?php include 'foot.php'; ?>