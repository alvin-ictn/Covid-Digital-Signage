<?php
include './conn.php';
include './head.php';
include './asides.php';
function set_progress($val = 0)
{

  $data = "<div class='progress-container' style='display:none'>
            
                <div class='progress'>
                      <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: " . $val . "%'>
                      </div>
                </div>

            </div>";

  return $data;
}

if (isset($_POST['add'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  //echo $username.' - '.$password.' - '.$user;
  mysqli_query($con, "INSERT INTO `user`(`nama`, `username`, `password`,`user_type`) VALUES ('$nama','$username','$password','admin')");
} elseif (isset($_GET['hapus']) == "hapus") {
  $id = $_GET['id'];
  mysqli_query($con, "delete FROM `user` WHERE id=$id");
} elseif (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // echo $id . " - " . $nama . " - " . $username . " - " . $password. " - " . $latitude;
  mysqli_query($con, "UPDATE `user` SET `nama`='$nama', `username`='$username', `password`='$password' WHERE id=$id");
} elseif (isset($_GET['logout'])) {
  session_destroy();
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jadwal Sholat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/jquery-datatables-editable/datatables.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="hold-transition skin-green sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content main-content">

        <!-- Default box -->
        <div class="box  w-75">
          <div class="box-header with-border ">
            <h3 class="box-title">Data User</h3>

          </div>
          <div class="box-body">
            <div class="box">
              <div class="box-header">
              </div><!-- /.box-header -->

              <button class="btn btn-primary waves-effect waves-light my-4" data-id='0' data-toggle="modal" data-target="#tambah-data"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

              <div class="box-body">
                <table class="table table-bordered table-striped" id="datatable-editable">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nama User</th>
                      <th>username</th>
                      <th>password</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM user");

                    while ($row1 = mysqli_fetch_array($query)) {
                    ?>
                      <tr class="gradeX">
                        <td><?php echo $row1[0]; ?></td>
                        <td><?php echo $row1[1]; ?></td>
                        <td><?php echo $row1[2]; ?></td>
                        <td><?php echo $row1[3]; ?></td>
                        <td><a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="glyphicon glyphicon-trash"></i></a>
                          <a class="btn btn-xs btn-warning" href="javascript:;" data-id="<?php echo $row1[0]; ?>" data-nama="<?php echo $row1[1]; ?>" data-username="<?php echo $row1[2]; ?>" data-password="<?php echo $row1[3]; ?>" data-toggle="modal" data-target="#edit-data">
                            <i class="glyphicon glyphicon-edit"></i>

                          </a></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>

                <!--                                    
                                                                    </div><!-- /.box-body -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!-- modal konfirmasi-->
    <div id="modal-konfirmasi" class="modal fade" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
          <div class="panel panel-color panel-danger">
            <div class="panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="panel-title">Hapus Data</h3>
            </div>
            <div class="modal-body" style="">
              &nbsp;&nbsp;<i class="glyphicon glyphicon-warning-sign"></i><strong> Apakah Anda yakin ingin menghapus data ini?</strong>
            </div>
            <?php echo set_progress(); ?>
            <div class="modal-footer">
              <a href="javascript:;" class="btn btn-danger" id="hapus-true"><i class="glyphicon glyphicon-ok"></i> Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
              <br><br>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal tambah data -->
    <div id="tambah-data" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog w-100">
        <div class="modal-content">

          <form id="form-data" method="post">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <fieldset>
                <input type="hidden" name="id" id="id" class="form-control">
                <div class="form-group">
                  <label class="col-form-label">Nama</label>
                  <div class="col">
                    <input type="text" name="nama" id="nama" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label class="col-form-label">username</label>
                  <div class="col">
                    <input type="text" name="username" id="username" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label class="col-form-label">password</label>
                  <div class="col">
                    <input type="text" name="password" id="password" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->

              </fieldset>

              <?php echo set_progress(); ?>

            </div>

            <div class="modal-footer">
              <button class="btn btn-info btn-submit" type="submit" name="add"><i class="glyphicon glyphicon-ok"></i> Simpan</button>
              <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
            </div>

          </form>

        </div>
      </div>
    </div>
    <!-- Modal tambah data -->
    <div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <form id="form-data" method="post">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Data USER</h4>
            </div>

            <div class="modal-body">

              <fieldset>
                <input type="hidden" name="id" id="id" class="form-control">
                <div class="form-group">
                  <label class="col-form-label">Nama</label>
                  <div class="col">
                    <input type="text" name="nama" id="nama" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label class="col-form-label">username</label>
                  <div class="col">
                    <input type="text" name="username" id="username" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label class="col-form-label">password</label>
                  <div class="col">
                    <input type="text" name="password" id="password" class="form-control" style="width: 100%">
                  </div>
                </div><!-- /.form-group -->

              </fieldset>

              <?php echo set_progress(); ?>

            </div>

            <div class="modal-footer">
              <button class="btn btn-info btn-submit" type="submit" name="edit"><i class="glyphicon glyphicon-ok"></i> Edit</button>
              <button class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Batal</button>
            </div>

          </form>

        </div>
      </div>
    </div>
    <footer class="main-footer">
      <?php include 'foot.php' ?>

    </footer>

    <!-- Add the sidebar's background. This div must be placed
                             immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>

  <!-- Select2 -->
  <script src="plugins/select2/select2.full.min.js"></script>

  <!-- DataTables -->
  <script src="plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.js"></script>
  <script src="plugins/jquery-datatables-editable/datatables.password.js"></script>
  <script>
    $(function() {
      $('#modal-konfirmasi').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

        // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
        var id = div.data('id')

        var modal = $(this)

        // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
        modal.find('#hapus-true').attr("href", "user.php?hapus=hapus&id=" + id);
      });
      $('#edit-data').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

        var id = div.data('id');
        var nama = div.data('nama');
        var username = div.data('username');
        var password = div.data('password');

        var modal = $(this);

        // Isi nilai pada field
        modal.find('#id').attr("value", id);
        modal.find('#nama').attr("value", nama);
        modal.find('#username').attr("value", username);
        modal.find('#password').attr("value", password);
      });
    });
  </script>
</body>

</html>