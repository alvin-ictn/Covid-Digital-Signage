<?php
include './conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    
    <style type="text/css">
    main {
            position: fixed;
            width: 100%;
            top: 0%; /* Set this to the height of the header */
            /*right: 30%;  Set this to the width of the nav bar */
            bottom: 0;
            background: black;
            vertical-align: middle;
            /*float: left;*/

    }
    .huruf{
        /*bottom: 5%;*/
        font-size: 200px;
        right: 15%;
        color: black;
        background-color: black;
        font-weight: bold;
        align-content: center;
        text-align: center;
        padding-top: 15%;
        vertical-align: middle;

    }
    </style>

</head>
<body bgcolor="black">
<main>

<div class="huruf">
                <!-- <h1>Iqamah</h1> -->
                        <script type="text/javascript">
                            var menit = 0;
                            var waktu = 1;

                            setInterval(function() {
                                waktu--;
                                if (menit==0){
                                    if (waktu==0){
                                        window.location.href="index.php";
                                    }
                                }
                                if (waktu==-1){
                                    menit--;
                                    waktu=59;
                                }
                                if (waktu<10){
                                    waktu="0"+waktu;
                                }
                                
                            }, 1000);
                        </script> 

</div>
</main>
    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
