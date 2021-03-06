<?php 
$uri= $_SERVER['REQUEST_URI'];
$uri = explode('/',$uri);

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="style4.css">
	<link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <!-- Font Awesome JS -->
    
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
		<?php include "side.php";include "head.php";include "control.php";?>

        <!-- Page Content  -->
        <div id="content">
			
			<button type="button" id="sidebarCollapse" class="btn btn-info">
				<i class="fas fa-align-left"></i>
				<span>Menu</span>
			</button>
				<div>
				<br><h1>Mobile<br> Version</h1></div>
				<img class="arrow left" src="../assets/images/demo-arrow-left.png" alt="arrow" height="120">

			</div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>