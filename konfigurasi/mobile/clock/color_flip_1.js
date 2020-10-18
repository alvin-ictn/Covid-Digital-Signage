var stsm = 1;
function check(){
	$.getJSON("color_data_flip_1.php",{"coloraktif":stsm}, function(data){
         var data = data.color;	 
		 $(".color_data_1").html(data);		 
     });

	setTimeout("check()", 10);
}

function check2(){
	$.getJSON("color_data_flip_1.php",{"coloraktif2":stsm}, function(data2){
         var data2 = data2.color2;	 
		 $(".color_data_2").html(data2);		 
     });

	setTimeout("check2()", 10);
}

function check3(){
	$.getJSON("color_data_flip_1.php",{"coloraktif3":stsm}, function(data3){
         var data3 = data3.color3;	 
		 $(".color_data_3").html(data3);		 
     });

	setTimeout("check3()", 10);
}

$(document).ready(function(){
	
	check();
	check2();
	check3(); 
})