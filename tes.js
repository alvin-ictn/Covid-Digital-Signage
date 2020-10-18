var stsm = 1;
function check(){
	$.getJSON("proses_data.php",{"statusaktif":stsm}, function(data){
         var data = data.status;	 
		 $(".tabel_data").html(data);		 
     });

	setTimeout("check()", 1000);
}

$(document).ready(function(){
	
	check();
	 
})