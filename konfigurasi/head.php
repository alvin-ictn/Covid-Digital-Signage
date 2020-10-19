	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="conditional/jquery.min.js"></script>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/sidebar-collapse.css">

	<link rel="stylesheet" href="assets/fontawesome/css/all.css">
	<link rel="stylesheet" href="assets/css/buttons.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-glyphicons.css">
	<script>
	  window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function() {
	      $(this).remove();
	    });
	  }, 4000);
	</script>

	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<style>
	  body {

	    font-family: sans-serif;
	    color: #333;
	    text-align: center;
	  }

	  h1 {
	    padding-top: 80px;
	  }

	  .btn {
	    border: #357ebd solid 0px;
	    border-radius: 3px;
	    color: #fff;
	    display: inline-block;
	    font-size: 14px;
	    padding: 8px 15px;
	    text-decoration: none;
	    text-align: center;
	    min-width: 60px;
	    position: relative;
	    transition: color .1s ease;
	  }

	  .btn.btn-big {
	    font-size: 18px;
	    padding: 15px 20px;
	    min-width: 100px;
	  }

	  .btn-close {

	    font-size: 20px;
	    text-decoration: none;
	    padding: 10px;
	    position: absolute;
	    right: 7px;
	    top: 0;
	  }

	  .btn-close:hover {
	    color: #919191;
	  }

	  .modale:before {
	    content: "";
	    display: none;
	    background: rgba(0, 0, 0, 0.6);
	    position: fixed;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    z-index: 10;
	  }

	  .opened:before {
	    display: block;
	  }

	  .opened .modal-dialog {
	    -webkit-transform: translate(0, 0);
	    -ms-transform: translate(0, 0);
	    transform: translate(0, 0);
	    top: 5%;
	  }

	  .modal-dialog {
	    max-height: calc(100vh - 0px);
	    overflow-y: auto;
	    background: #fefefe;
	    border: #333333 solid 0px;
	    border-radius: 5px;
	    margin: 0 auto;
	    text-align: center;
	    position: fixed;
	    left: 13%;
	    right: 13%;
	    z-index: 11;
	    width: 74%;
	    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
	    -webkit-transform: translate(0, -500%);
	    -ms-transform: translate(0, -500%);
	    transform: translate(0, -500%);
	    -webkit-transition: -webkit-transform 0.3s ease-out;
	    -moz-transition: -moz-transform 0.3s ease-out;
	    -o-transition: -o-transform 0.3s ease-out;
	    transition: transform 0.3s ease-out;
	  }

	  .modal-body {
	    padding: 20px;

	  }

	  .modal-body input {
	    width: 100%;
	    padding: 8px;
	    border: 1px solid #ddd;
	    color: #888;
	    outline: 0;
	    font-size: 14px;
	    font-weight: bold
	  }

	  .modal-header,
	  .modal-footer {
	    padding: 10px 20px;
	  }

	  .modal-header {
	    border-bottom: #eeeeee solid 1px;
	  }

	  .modal-header h2 {
	    font-size: 20px;
	  }
	</style>