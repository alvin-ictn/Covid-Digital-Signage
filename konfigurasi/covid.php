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
        #fff350 0%,
        #ffc107 50%,
        #c79100 100%);
  }

  form.w-100>*:nth-child(2)>input {
    background:
      linear-gradient(to right,
        #69a9ff 0%,
        #007bff <?php echo $datacovid[2] * 50 / $datacovid[1] . "%" ?>,
        #0050cb <?php echo $datacovid[2] * 100 / $datacovid[1] . "%" ?>,
        white <?php echo (($datacovid[2] * 100 / $datacovid[1]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(3)>input {
    background:
      linear-gradient(to right,
        #60d4ea 0%,
        #17a2b8 <?php echo $datacovid[3] * 50 / $datacovid[1] . "%" ?>,
        #007388 <?php echo $datacovid[3] * 100 / $datacovid[1] . "%" ?>,
        white <?php echo (($datacovid[3] * 100 / $datacovid[1]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(4)>input {
    background:
      linear-gradient(to right,
        #64da73 0%,
        #28a745 <?php echo $datacovid[4] * 50 / $datacovid[1] . "%" ?>,
        #007717 <?php echo $datacovid[4] * 100 / $datacovid[1] . "%" ?>,
        white <?php echo (($datacovid[4] * 100 / $datacovid[1]) + 1) . "%" ?>,
        transparent 100%);
  }

  form.w-100>*:nth-child(5)>input {
    background:
      linear-gradient(to right,
        #ff6b70 0%,
        #dc3545 <?php echo $datacovid[5] * 50 / $datacovid[1] . "%" ?>,
        #a3001e <?php echo $datacovid[5] * 100 / $datacovid[1] . "%" ?>,
        white <?php echo (($datacovid[5] * 100 / $datacovid[1]) + 1) . "%" ?>,
        transparent 100%);
  }
</style>

<?php include 'asides.php' ?>

<div class="main-content">
  <div class="row w-100">
    <form class="w-100" enctype="multipart/form-data" method="post">
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Konfirmasi</label>
        <input name="konfirmasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[1], 0, ",", ".") ?>" id="confirm" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Isolasi</label>
        <input name="isolasi" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[2], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Rawat</label>
        <input name="rawat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[3], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Sembuh</label>
        <input name="sembuh" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[4], 0, ",", ".") ?>" />
      </div>
      <div class="row align-items-center my-2">
        <label class="w-25 m-0 text-right mr-4">Meninggal</label>
        <input name="wafat" type="text" class="text-center form-control w-50 mr-4" value="<?php echo number_format($datacovid[5], 0, ",", ".") ?>" />
      </div>
      <button class="btn btn-info mt-4" name="updateCovid" type="submit">
        Update
      </button>
    </form>
  </div>
  <div class="row-100">
    <div class="col-lg-2 col-md-2 col-sm-2">

      <input onChange="update(this.jscolor, '#pr3')" onInput="update(this.jscolor, '#pr4')" value="CCFFAA" data-jscolor="{alpha:0.7}" type="unknown">

      <em id="pr3" style="display:inline-block; padding:1em;">change event</em>
      <em id="pr4" style="display:inline-block; padding:1em;">input event</em>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2"></div>
    <div class="col-lg-2 col-md-2 col-sm-2"></div>
    <div class="col-lg-2 col-md-2 col-sm-2"></div>
    <div class="col-lg-2 col-md-2 col-sm-2"></div>
  </div>
</div>
<script src="../js/jscolor.js"></script>
<script>
  function update(picker, selector) {
    console.log(picker)
    document.querySelector(selector).style.background = picker.toBackground()
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
      if (this.id === "confirm") {
        let otherdata = document.querySelectorAll('.text-center');
        for (let i = 1; i < otherdata.length; i++) {
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