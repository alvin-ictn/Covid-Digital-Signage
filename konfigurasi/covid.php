<?php
include './conn.php';
include 'head.php';

if (isset($_POST['updateCovid'])) {
  $konfirmasi = join("", explode(".", $_POST['konfirmasi']));
  $isolasi = join("", explode(".", $_POST['isolasi']));
  $rawat = join("", explode(".", $_POST['rawat']));
  $sembuh = join("", explode(".", $_POST['sembuh']));
  $wafat = join("", explode(".", $_POST['wafat']));
  mysqli_query($con, "UPDATE `covid` SET `konfirmasi`='$konfirmasi', `isolasi`='$isolasi',`rawat`='$rawat', `sembuh`='$sembuh',`wafat`='$wafat' WHERE id=1");
}

$defaultValue = [
  ['transparent', 'rgb(248, 249, 250)'],
  ['transparent', 'rgb(255, 193, 7)'],
  ['transparent', 'rgb(0, 123, 255)'],
  ['transparent', 'rgb(23, 162, 184)'],
  ['transparent', 'rgb(40, 167, 69)'],
  ['transparent', 'rgb(220, 53, 69)']
];

$defaultValue2 = [
  ['rgba(248, 249, 250, 1)', 'rgb(52, 58, 64)'],
  ['rgba(255, 193, 7, 1)', 'rgb(248, 249, 250)'],
  ['rgba(0, 123, 255, 1)', 'rgb(248, 249, 250)'],
  ['rgba(23, 162, 184, 1)', 'rgb(248, 249, 250)'],
  ['rgba(40, 167, 69, 1)', 'rgb(248, 249, 250)'],
  ['rgba(220, 53, 69, 1)', 'rgb(248, 249, 250)']
];

if (isset($_POST['default1'])) {
  mysqli_query($con, "UPDATE `covid` SET `konfirmasi`='$konfirmasi', `isolasi`='$isolasi',`rawat`='$rawat', `sembuh`='$sembuh',`wafat`='$wafat' WHERE id=1");
}

if (isset($_POST['default2'])) {
  mysqli_query($con, "UPDATE `covid` SET `konfirmasi`='$konfirmasi', `isolasi`='$isolasi',`rawat`='$rawat', `sembuh`='$sembuh',`wafat`='$wafat' WHERE id=1");
}
?>
<?php $datacovid = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `covid`")); ?>
<style>
  .logoContainer {
    width: 400px;
    margin: 15px auto 0 auto;
    /*background: url(http://img1.wikia.nocookie.net/__cb20130901213905/battlebears/images/9/98/Team-icon-placeholder.png) no-repeat 0 0;*/
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
        <input name="suspek" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[1], 0, ",", ".") ?>" id="suspek" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Konfirmasi</label>
        <input name="konfirmasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[2], 0, ",", ".") ?>" id="confirm" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Isolasi</label>
        <input name="isolasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[3], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Rawat</label>
        <input name="rawat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[4], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Sembuh</label>
        <input name="sembuh" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[5], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Meninggal</label>
        <input name="wafat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[6], 0, ",", ".") ?>" />
      </div>
      <button class="btn btn-info mt-4" name="updateCovid" type="submit">
        Update
      </button>
    </form>
  </div>
  <div class="w-100 d-flex flex-wrap">
    <div class="card p-0 m-4">
      <form class="w-100" enctype="multipart/form-data" method="post">
        <div class="card-header">
          <label class="font-weight-bold m-0">Suspek</label>
        </div>
        <div class="card-body">
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Background</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr1','bg')" onInput="update(this.jscolor, '#pr1','bg')" value="FFEECC" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr1','txt')" onInput="update(this.jscolor, '#pr1','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_suspek_bg" name="post_suspek_bg" value="" />
        <input type="hidden" id="#post_suspek_txt" name="post_suspek_txt" value="" />
        <em id="pr1" style="display:inline-block; padding:1em;">Suspek</em>
        <button class="btn btn-danger" name="updateSuspek" type="submit">Update</button>
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
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr2','bg')" onInput="update(this.jscolor, '#pr2','bg')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr2','txt')" onInput="update(this.jscolor, '#pr2','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_konfirmasi_bg" name="post_konfirmasi_bg" value="" />
        <input type="hidden" id="#post_konfirmasi_txt" name="post_konfirmasi_txt" value="" />
        <em id="pr2" style="display:inline-block; padding:1em;">Konfirmasi</em>
        <button class="btn btn-danger" name="updateKonfirmasi" type="submit">Update</button>
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
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr3','bg')" onInput="update(this.jscolor, '#pr3','bg')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr3','txt')" onInput="update(this.jscolor, '#pr3','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_isolasi_bg" name="post_isolasi_bg" value="" />
        <input type="hidden" id="#post_isolasi_txt" name="post_isolasi_txt" value="" />
        <em id="pr3" style="display:inline-block; padding:1em;">Isolasi</em>
        <button class="btn btn-danger" name="updateIsolasi" type="submit">Update</button>
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
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr4','bg')" onInput="update(this.jscolor, '#pr4','bg')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr4','txt')" onInput="update(this.jscolor, '#pr4','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_rawat_bg" name="post_rawat_bg" value="" />
        <input type="hidden" id="#post_rawat_txt" name="post_rawat_txt" value="" />
        <em id="pr4" style="display:inline-block; padding:1em;">Rawat</em>
        <button class="btn btn-danger" name="updateRawat" type="submit">Update</button>
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
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr5','bg')" onInput="update(this.jscolor, '#pr5','bg')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr5','txt')" onInput="update(this.jscolor, '#pr5','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_sembuh_bg" name="post_sembuh_bg" value="" />
        <input type="hidden" id="#post_sembuh_txt" name="post_suspek_txt" value="" />
        <em id="pr5" style="display:inline-block; padding:1em;">Sembuh</em>
        <button class="btn btn-danger" name="updateSembuh" type="submit">Update</button>
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
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr6','bg')" onInput="update(this.jscolor, '#pr6','bg')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">
          </div>
          <div class="align-items-center my-2">
            <label class="m-0 text-center font-weight-bold">Text Color</label>
            <input class="text-center form-control" onChange="update(this.jscolor, '#pr6','txt')" onInput="update(this.jscolor, '#pr6','txt')" value="CCFFAA" data-jscolor="{alpha:1}" type="unknown">
          </div>
        </div>
        <input type="hidden" id="#post_wafat_bg" name="post_wafat_bg" value="" />
        <input type="hidden" id="#post_wafat_txt" name="post_wafat_txt" value="" />
        <em id="pr6" style="display:inline-block; padding:1em;">Meninggal</em>
        <button class="btn btn-danger" name="updateWafat" type="submit">Update</button>
      </form>
    </div>
  </div>
</div>
<script src="../js/jscolor.js"></script>
<script>
  function update(picker, selector, text="bg") {
    // console.log(picker.toRGBString())
    // console.log(picker)
    if(text === "bg"){
      document.querySelector(selector).style.background = picker.toBackground();
    }else if(text === "txt"){
      document.querySelector(selector).style.color = picker.toRGBString();
    }
    let bgDiv = document.querySelector(selector).parentNode.children[2];
    let txtDiv = document.querySelector(selector).parentNode.children[3];
    bgDiv.value = picker.toBackground();
    txtDiv.value = picker.toRGBString();
  }
  $("input:text").on('focus focusout', function() {
    let main = $("#confirm");
    let data = this.value;
    if (event.type === "focus") {
      data = data.split('.').join("")
      this.value = data
    }
    if (event.type === "blur") {
      this.value = data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
      let calc = data / main.val().split('.').join("") * 100
      let element = $(this).css('background-Image').split("rgb");
      var regExp = /\(([^)]+)\)/;
      let col = [element[1], element[2], element[3]];
      col = col.map(item => regExp.exec(item)[1])
      if (this.id === "suspek") return;

      if (this.id === "confirm") {
        let otherdata = document.querySelectorAll('.text-center');
        for (let i = 2; i < otherdata.length; i++) {
          let otherval = otherdata[i].value.split('.').join('');
          let calc = otherval / main.val().split('.').join("") * 100;
          element = getComputedStyle(otherdata[i]).backgroundImage.split("rgb");
          col = [element[1], element[2], element[3]];
          col = col.map(item => regExp.exec(item)[1])
          otherdata[i].style.backgroundImage = `linear-gradient(to right, rgba(${col[0]}) 0%, rgba(${col[1]}) ${calc/2}%, rgba(${col[2]}) ${calc}%, white ${calc+1}%, transparent 100%)`
        }
      } else {
        this.style.backgroundImage = `linear-gradient(to right, rgba(${col[0]}) 0%, rgba(${col[1]}) ${calc/2}%, rgba(${col[2]}) ${calc}%, white ${calc+1}%, transparent 100%)`;
      }
    }
  });
</script>
<?php include 'foot.php'; ?>