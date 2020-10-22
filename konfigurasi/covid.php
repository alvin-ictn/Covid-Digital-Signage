<?php
include './conn.php';
include 'head.php';

if (isset($_POST['updateCovid'])) {
  $suspek = join("",explode(".",$_POST['suspek']));
  $konfirmasi = join("",explode(".",$_POST['konfirmasi']));
  $isolasi = join("",explode(".",$_POST['isolasi']));
  $rawat = join("",explode(".",$_POST['rawat']));
  $sembuh = join("",explode(".",$_POST['sembuh']));
  $wafat = join("",explode(".",$_POST['wafat']));
  mysqli_query($con,"UPDATE `covid` SET `suspek`='$suspek',`konfirmasi`='$konfirmasi',`isolasi`='$isolasi',`rawat`='$rawat',`sembuh`='$sembuh',`wafat`='$wafat' WHERE id=1");
}

if (isset($_POST['updateColor'])) {
  foreach ($_POST as $key => $value) {
    if(htmlspecialchars($key) != "updateColor"){
      $postHandle = explode("_",htmlspecialchars($key));
      $columnKey = $postHandle[1];
      if(!empty($_POST['post_'.$columnKey.'_bg'])){
        $bgPost = $_POST['post_'.$columnKey.'_bg'];
        mysqli_query($con,"UPDATE `covidstyle` SET `".$columnKey."`='$bgPost' WHERE id=1");
      }
    
      if(!empty($_POST['post_'.$columnKey.'_txt'])){
        $txtPost = $_POST['post_'.$columnKey.'_txt'];
        mysqli_query($con,"UPDATE `covidstyle` SET `$postHandle[1]`='$txtPost' WHERE id=2");
      }
    }
}
  
}

$defaultValue = [
  ['rgba(0,0,0,0)','rgb(248,249,250)'],
  ['rgba(0,0,0,0)','rgb(255,193,7)'],
  ['rgba(0,0,0,0)','rgb(0,123,255)'],
  ['rgba(0,0,0,0)','rgb(23,162,184)'],
  ['rgba(0,0,0,0)','rgb(40,167,69)'],
  ['rgba(0,0,0,0)','rgb(220,53,69)']
];

$defaultValue2 = [
  ['rgba(248,249,250,1)','rgb(52,58,64)'],
  ['rgba(255,193,7,1)','rgb(248,249,250)'],
  ['rgba(0,123,255,1)','rgb(248,249,250)'],
  ['rgba(23,162,184,1)','rgb(248,249,250)'],
  ['rgba(40,167,69,1)','rgb(248,249,250)'],
  ['rgba(220,53,69,1)','rgb(248,249,250)']
];

if (isset($_POST['default1'])) {
  $bg1 = $defaultValue[0][0];
  $bg2 = $defaultValue[1][0];
  $bg3 = $defaultValue[2][0];
  $bg4 = $defaultValue[3][0];
  $bg5 = $defaultValue[4][0];
  $bg6 = $defaultValue[5][0];
  $txt1 = $defaultValue[0][1];
  $txt2 = $defaultValue[1][1];
  $txt3 = $defaultValue[2][1];
  $txt4 = $defaultValue[3][1];
  $txt5 = $defaultValue[4][1];
  $txt6 = $defaultValue[5][1];

  mysqli_query($con,"UPDATE `covidstyle` SET `suspek`='$bg1',`konfirmasi`='$bg2',`isolasi`='$bg3',`rawat`='$bg4',`sembuh`='$bg5',`wafat`='$bg6' WHERE id=1");
  mysqli_query($con,"UPDATE `covidstyle` SET `suspek`='$txt1',`konfirmasi`='$txt2',`isolasi`='$txt3',`rawat`='$txt4',`sembuh`='$txt5',`wafat`='$txt6' WHERE id=2");
}

if (isset($_POST['default2'])) {
  $bg1 = $defaultValue2[0][0];
  $bg2 = $defaultValue2[1][0];
  $bg3 = $defaultValue2[2][0];
  $bg4 = $defaultValue2[3][0];
  $bg5 = $defaultValue2[4][0];
  $bg6 = $defaultValue2[5][0];
  $txt1 = $defaultValue2[0][1];
  $txt2 = $defaultValue2[1][1];
  $txt3 = $defaultValue2[2][1];
  $txt4 = $defaultValue2[3][1];
  $txt5 = $defaultValue2[4][1];
  $txt6 = $defaultValue2[5][1];

  mysqli_query($con,"UPDATE `covidstyle` SET `suspek`='$bg1',`konfirmasi`='$bg2',`isolasi`='$bg3',`rawat`='$bg4',`sembuh`='$bg5',`wafat`='$bg6' WHERE id=1");
  mysqli_query($con,"UPDATE `covidstyle` SET `suspek`='$txt1',`konfirmasi`='$txt2',`isolasi`='$txt3',`rawat`='$txt4',`sembuh`='$txt5',`wafat`='$txt6' WHERE id=2");
}
?>
<?php $datacovid = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `covid`"));
$styledata1 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `covidstyle` WHERE id=1"));
$styledata2 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `covidstyle` WHERE id=2"));
?>
<style>
  .logoContainer {
    width: 400px;
    margin: 15px auto 0 auto;
    padding: 11px 10px 21px 10px;
    text-align: center;
    line-height: 120px;
  }

  .logoContainer img {
    max-width: 100%;
  }

  .fileContainer {
    background: #ccc;
    max-width: 402px;
    height: 31px;
    overflow: hidden;
    position: relative;
    font-size: 16px;
    line-height: 31px;
    color: #434343;
    padding: 0px 41px 0 53px;
    margin: 0 auto 60px auto;
    cursor: pointer !important;
  }

  .fileContainer span {
    overflow: hidden;
    display: block;
    white-space: nowrap;
    text-overflow: ellipsis;
    cursor: pointer;
  }

  .fileContainer input[type="file"] {
    opacity: 0;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    position: absolute;
    cursor: pointer;
  }

  form.w-100 {
    font-weight: 700;
  }

  form.w-100>*:nth-child(1)>input {
    background:
      linear-gradient(to right,
        #ffffff 0%,
        #f8f9fa 50%,
        #c5c6c7 100%);
  }

  form.w-100>*:nth-child(2)>input {
    background:
      linear-gradient(to right,
        #fff350 0%,
        #ffc107 50%,
        #c79100 100%);
  }

  form.w-100>*:nth-child(3)>input {
    background:
      linear-gradient(to right,
        #69a9ff 0%,
        #007bff <?php echo $datacovid[3] * 50 / $datacovid[2] . "%" ?>,
        #0050cb <?php echo $datacovid[3] * 100 / $datacovid[2] . "%" ?>,
        white <?php echo (($datacovid[3] * 100 / $datacovid[2]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(4)>input {
    background:
      linear-gradient(to right,
        #60d4ea 0%,
        #17a2b8 <?php echo $datacovid[4] * 50 / $datacovid[2] . "%" ?>,
        #007388 <?php echo $datacovid[4] * 100 / $datacovid[2] . "%" ?>,
        white <?php echo (($datacovid[4] * 100 / $datacovid[2]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(5)>input {
    background:
      linear-gradient(to right,
        #64da73 0%,
        #28a745 <?php echo $datacovid[5] * 50 / $datacovid[2] . "%" ?>,
        #007717 <?php echo $datacovid[5] * 100 / $datacovid[2] . "%" ?>,
        white <?php echo (($datacovid[5] * 100 / $datacovid[2]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(6)>input {
    background:
      linear-gradient(to right,
        #ff6b70 0%,
        #dc3545 <?php echo $datacovid[6] * 50 / $datacovid[2] . "%" ?>,
        #a3001e <?php echo $datacovid[6] * 100 / $datacovid[2] . "%" ?>,
        white <?php echo (($datacovid[6] * 100 / $datacovid[2]) + 1) . "%" ?>,
        transparent 100%);
  }

  @media(max-width:900px) {
    .card.p-0.m-4 {
      width: 40%;
    }
  }

  @media(max-width:717px) {
    .card.p-0.m-4 {
      width: 100%;
    }
  }
</style>

<?php include 'asides.php' ?>

<div class="main-content">
  <div class="row w-100">
    <form class="w-100" enctype="multipart/form-data" method="post">
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Suspek</label>
        <input name="suspek" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[1],0,",",".") ?>" id="suspek" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Konfirmasi</label>
        <input name="konfirmasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[2],0,",",".") ?>" id="confirm" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Isolasi</label>
        <input name="isolasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[3],0,",",".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Rawat</label>
        <input name="rawat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[4],0,",",".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Sembuh</label>
        <input name="sembuh" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[5],0,",",".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Meninggal</label>
        <input name="wafat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[6],0,",",".") ?>" />
      </div>
      <button class="btn btn-info mt-4" name="updateCovid" type="submit">
        Update
      </button>
    </form>
  </div>
  <div class="row">
    <form class="w-100" enctype="multipart/form-data" method="post">
      <button class="btn btn-danger" name="default1" type="submit">Set Default 1</button>
      <button class="btn btn-danger" name="default2" type="submit">Set Default 2</button>
    </form>
  </div>
  <?php
  function zeroAdd($num,$lim)
  {
     return (strlen($num) >= $lim) ? $num : "0" . $num;
  }
  $bgAdj1 = explode(",",$styledata1[1]);
  $bgAdj2 = explode(",",$styledata1[2]);
  $bgAdj3 = explode(",",$styledata1[3]);
  $bgAdj4 = explode(",",$styledata1[4]);
  $bgAdj5 = explode(",",$styledata1[5]);
  $bgAdj6 = explode(",",$styledata1[6]);
  $txtAdj1 = explode(",",$styledata2[1]);
  $txtAdj2 = explode(",",$styledata2[2]);
  $txtAdj3 = explode(",",$styledata2[3]);
  $txtAdj4 = explode(",",$styledata2[4]);
  $txtAdj5 = explode(",",$styledata2[5]);
  $txtAdj6 = explode(",",$styledata2[6]);

  // isset($bgAdj1[0]) || $bgAdj1[0] = "00";
  // isset($bgAdj1[1]) || $bgAdj1[1] = "00";
  // isset($bgAdj1[2]) || $bgAdj1[2] = "00";

  // isset($bgAdj2[0]) || $bgAdj2[0] = "00";
  // isset($bgAdj2[1]) || $bgAdj2[1] = "00";
  // isset($bgAdj2[2]) || $bgAdj2[2] = "00";
  
  // isset($bgAdj3[0]) || $bgAdj3[0] = "00";
  // isset($bgAdj3[1]) || $bgAdj3[1] = "00";
  // isset($bgAdj3[2]) || $bgAdj3[2] = "00";

  // isset($bgAdj4[0]) || $bgAdj4[0] = "00";
  // isset($bgAdj4[1]) || $bgAdj4[1] = "00";
  // isset($bgAdj4[2]) || $bgAdj4[2] = "00";

  // isset($bgAdj5[0]) || $bgAdj5[0] = "00";
  // isset($bgAdj5[1]) || $bgAdj5[1] = "00";
  // isset($bgAdj5[2]) || $bgAdj5[2] = "00";

  // isset($bgAdj6[0]) || $bgAdj6[0] = "00";
  // isset($bgAdj6[1]) || $bgAdj6[1] = "00";
  // isset($bgAdj6[2]) || $bgAdj6[2] = "00";

  // isset($txtAdj1[0]) || $txtAdj1[0] = "00";
  // isset($txtAdj1[1]) || $txtAdj1[1] = "00";
  // isset($txtAdj1[2]) || $txtAdj1[2] = "00";

  // isset($txtAdj2[0]) || $txtAdj2[0] = "00";
  // isset($txtAdj2[1]) || $txtAdj2[1] = "00";
  // isset($txtAdj2[2]) || $txtAdj2[2] = "00";
  
  // isset($txtAdj3[0]) || $txtAdj3[0] = "00";
  // isset($txtAdj3[1]) || $txtAdj3[1] = "00";
  // isset($txtAdj3[2]) || $txtAdj3[2] = "00";

  // isset($txtAdj4[0]) || $txtAdj4[0] = "00";
  // isset($txtAdj4[1]) || $txtAdj4[1] = "00";
  // isset($txtAdj4[2]) || $txtAdj4[2] = "00";

  // isset($txtAdj5[0]) || $txtAdj5[0] = "00";
  // isset($txtAdj5[1]) || $txtAdj5[1] = "00";
  // isset($txtAdj5[2]) || $txtAdj5[2] = "00";

  // isset($txtAdj6[0]) || $txtAdj6[0] = "00";
  // isset($txtAdj6[1]) || $txtAdj6[1] = "00";
  // isset($txtAdj6[2]) || $txtAdj6[2] = "00";

  $setBg1 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj1[0] )),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj1[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj1[2])),2);

  $setBg2 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj2[0])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj2[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj2[2])),2);

  $setBg3 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj3[0])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj3[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj3[2])),2);

  $setBg4 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj4[0])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj4[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj4[2])),2);

  $setBg5 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj5[0])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj5[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj5[2])),2);

  $setBg6 =
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj6[0])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj6[1])),2) .
    zeroAdd(dechex(str_replace("rgba(","",$bgAdj6[2])),2);

  $setTxt1 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj1[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj1[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj1[2])),2);

  $setTxt2 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj2[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj2[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj2[2])),2);

  $setTxt3 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj3[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj3[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj3[2])),2);

  $setTxt4 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj4[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj4[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj4[2])),2);

  $setTxt5 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj5[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj5[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj5[2])),2);

  $setTxt6 =
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj6[0])),2) .
    zeroAdd(dechex(str_replace("rgb(","",$txtAdj6[1])),2) .
    zeroAdd(dechex(str_replace(")","",$txtAdj6[2])),2);
  ?>
  <div class="w-100 d-flex flex-wrap">
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Suspek</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr1','bg')" onInput="update(this.jscolor,'#pr1','bg')" value="<?php echo $setBg1 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj1[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr1','txt')" onInput="update(this.jscolor,'#pr1','txt')" value="<?php echo $setTxt1 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_suspek_bg" name="post_suspek_bg" value="" />
        <input type="hidden" id="post_suspek_txt" name="post_suspek_txt" value="" />
        <em id="pr1" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[1]?>;
          color:<?php echo $styledata2[1]?>">Suspek</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>

    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Konfirmasi</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr2','bg')" onInput="update(this.jscolor,'#pr2','bg')" value="<?php echo $setBg2 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj2[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr2','txt')" onInput="update(this.jscolor,'#pr2','txt')" value="<?php echo $setTxt2 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_konfirmasi_bg" name="post_konfirmasi_bg" value="" />
        <input type="hidden" id="post_konfirmasi_txt" name="post_konfirmasi_txt" value="" />
        <em id="pr2" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[2]?>;
          color:<?php echo $styledata2[2]?>">Konfirmasi</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Isolasi</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr3','bg')" onInput="update(this.jscolor,'#pr3','bg')" value="<?php echo $setBg3 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj3[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr3','txt')" onInput="update(this.jscolor,'#pr3','txt')" value="<?php echo $setTxt3 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_isolasi_bg" name="post_isolasi_bg" value="" />
        <input type="hidden" id="post_isolasi_txt" name="post_isolasi_txt" value="" />
        <em id="pr3" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[3]?>;
          color:<?php echo $styledata2[3]?>">Isolasi</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Rawat</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr4','bg')" onInput="update(this.jscolor,'#pr4','bg')" value="<?php echo $setBg4 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj4[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr4','txt')" onInput="update(this.jscolor,'#pr4','txt')" value="<?php echo $setTxt4 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_rawat_bg" name="post_rawat_bg" value="" />
        <input type="hidden" id="post_rawat_txt" name="post_rawat_txt" value="" />
        <em id="pr4" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[4]?>;
          color:<?php echo $styledata2[4]?>">Rawat</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Sembuh</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr5','bg')" onInput="update(this.jscolor,'#pr5','bg')" value="<?php echo $setBg5 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj5[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr5','txt')" onInput="update(this.jscolor,'#pr5','txt')" value="<?php echo $setTxt5 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_sembuh_bg" name="post_sembuh_bg" value="" />
        <input type="hidden" id="post_sembuh_txt" name="post_suspek_txt" value="" />
        <em id="pr5" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[5]?>;
          color:<?php echo $styledata2[5]?>">Sembuh</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Meninggal</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr6','bg')" onInput="update(this.jscolor,'#pr6','bg')" value="<?php echo $setBg6 ?>" data-jscolor="{alpha:<?php echo str_replace(")","",$bgAdj6[3]) ?>}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor,'#pr6','txt')" onInput="update(this.jscolor,'#pr6','txt')" value="<?php echo $setTxt6 ?>" data-jscolor="" type="unknown">
          </div>
        </div>
        <input type="hidden" id="post_wafat_bg" name="post_wafat_bg" value="" />
        <input type="hidden" id="post_wafat_txt" name="post_wafat_txt" value="" />
        <em id="pr6" style="
          display:inline-block; 
          padding:1em;
          background-color:<?php echo $styledata1[6]?>;
          color:<?php echo $styledata2[6]?>">Meninggal</em>
        <button class="btn btn-danger" name="updateColor" type="submit">Update</button>
      </form>
    </div>
  </div>
</div>
<script src="../js/jscolor.js"></script>
<script>
  function update(picker,selector,text = "bg") {
    if (text === "bg") {
      let bgDiv = document.querySelector(selector).parentNode.children[2];
      document.querySelector(selector).style.background = picker.toBackground();
      bgDiv.value = picker.toRGBAString();
    } else if (text === "txt") {
      let txtDiv = document.querySelector(selector).parentNode.children[3];
      document.querySelector(selector).style.color = picker.toRGBString();
      txtDiv.value = picker.toRGBString();
    }   
  }
  $("input:text").on('focus focusout',function() {
    let main = $("#confirm");
    let data = this.value;
    if (event.type === "focus") {
      data = data.split('.').join("")
      this.value = data
    }
    if (event.type === "blur") {
      this.value = data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g,'$1.')
      let calc = data / main.val().split('.').join("") * 100
      let element = $(this).css('background-Image').split("rgb");
      var regExp = /\(([^)]+)\)/;
      let col = [element[1],element[2],element[3]];
      col = col.map(item => regExp.exec(item)[1])
      if (this.id === "suspek") return;

      if (this.id === "confirm") {
        let otherdata = document.querySelectorAll('.text-center');
        for (let i = 2; i < otherdata.length; i++) {
          let otherval = otherdata[i].value.split('.').join('');
          let calc = otherval / main.val().split('.').join("") * 100;
          element = getComputedStyle(otherdata[i]).backgroundImage.split("rgb");
          col = [element[1],element[2],element[3]];
          col = col.map(item => regExp.exec(item)[1])
          otherdata[i].style.backgroundImage = `linear-gradient(to right,rgba(${col[0]}) 0%,rgba(${col[1]}) ${calc/2}%,rgba(${col[2]}) ${calc}%,white ${calc+1}%,transparent 100%)`
        }
      } else {
        this.style.backgroundImage = `linear-gradient(to right,rgba(${col[0]}) 0%,rgba(${col[1]}) ${calc/2}%,rgba(${col[2]}) ${calc}%,white ${calc+1}%,transparent 100%)`;
      }
    }
  });
</script>
<?php include 'foot.php'; ?>