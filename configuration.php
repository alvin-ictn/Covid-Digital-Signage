<?php
include './conn.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./test/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./test/assets/style.css">
</head>

<body>
  <div class="container my-4">
    <div class="row">
      <div class="col-4">
        <h1>Menu</h1>
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="tab" href="#dashboard" role="tab" aria-controls="list-home">Dashboard</a>
          <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#konfigurasi" role="tab" aria-controls="list-profile">Konfigurasi</a>
          <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="tab" href="#slider" role="tab" aria-controls="list-messages">Slider</a>
          <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#covid" role="tab" aria-controls="list-settings">Covid</a>
        </div>
      </div>
      <div class="col-8">
        <div class="row">
          <div class="card p-4 menu--item">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="list-home-list menu-logo">
                <div class="card company-profile">
                  <img src="./assets/images/logo.png" />
                  <p>NAMA INSTITUSI</p>
                </div>
              </div>
              <div class="tab-pane fade" id="konfigurasi" role="tabpanel" aria-labelledby="list-profile-list">
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Institusi</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="institution name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Logo</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jam/Tanggal</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Jam Tanggal">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <!--- THIS IS FOR SLIDER --->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Image</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Video</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">Image</div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Video</div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="tab-pane fade" id="slider" role="tabpanel" aria-labelledby="list-messages-list">
                <div class="row justify-content-center my-4">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                  </button>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Overview</th>
                      <th scope="col">durasi (detik)</th>
                      <th class="text-center" scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM slider");
                    $num = 0;
                    while ($fetchdata = mysqli_fetch_array($query)) {
                      $num = $num + 1;
                      $typemedia = $fetchdata[4]; ?>
                      <tr>
                        <th class="align-middle" scope="row"><?php echo $num; ?></th>
                        <td class="align-middle"><?php echo $fetchdata[1]; ?></td>
                        <?php if ($typemedia == 1) { ?>
                          <td class="align-middle">
                            <img src="http://localhost/darq/konfigurasi/gambar/slide-utama/<?php echo $fetchdata[3]; ?>" class="img-responsive" width="100vw">
                          </td><?php } elseif ($typemedia == 2) { ?>
                          <td class="align-middle">
                            <img src="http://localhost/darq/konfigurasi/gambar/slide-utama/<?php echo $fetchdata[3]; ?>" class="img-responsive" width="100vw">
                          </td><?php } ?>
                        <td class="align-middle"><?php echo $fetchdata[5]; ?></td>
                        <td class="align-middle text-center">
                          <a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $fetchdata[0]; ?>" data-toggle="modal" data-target="#delete-slider">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                          </a>
                          <a class="btn btn-xs btn-warning" href="javascript:;" data-id="<?php echo $fetchdata[0]; ?>" data-keterangan="<?php echo $fetchdata[1]; ?>" data-judul="<?php echo $fetchdata[2]; ?>" <?php if ($typemedia == 1) { ?> data-durasi="<?php echo $fetchdata[5]; ?>" <?php } ?> data-toggle="modal" data-target="<?php if ($typemedia == 1) {
                                                                                                                                                                                                                                                                                                                                          echo "#edit-slide-gambar";
                                                                                                                                                                                                                                                                                                                                        } elseif ($typemedia == 2) {
                                                                                                                                                                                                                                                                                                                                          echo "#edit-slide-video";
                                                                                                                                                                                                                                                                                                                                        } ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="covid" role="tabpanel" aria-labelledby="list-settings-list">
                <p>Irure enim occaecat labore sit qui aliquip reprehenderit amet velit. Deserunt ullamco ex elit nostrud ut dolore nisi officia magna sit occaecat laboris sunt dolor. Nisi eu minim cillum occaecat aute est cupidatat aliqua labore aute occaecat ea aliquip sunt amet. Aute mollit dolor ut exercitation irure commodo non amet consectetur quis amet culpa. Quis ullamco nisi amet qui aute irure eu. Magna labore dolor quis ex labore id nostrud deserunt dolor eiusmod eu pariatur culpa mollit in irure.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./test/assets/jQuery/jquery-3.5.1.min.js"></script>
  <script src="./test/assets/js/sweetalert2.all.min.js"></script>
  <script src="./test/assets/bootstrap/js//bootstrap.min.js"></script>
</body>

</html>