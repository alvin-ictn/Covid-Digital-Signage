$(document).ready(function(){
	// change background color dynamically
	$('#change-color').colorpicker().on('changeColor', function(e) {
		console.log( e.color.toString('rgba'));
		var background_color = e.color.toString('rgba');
			
		$.ajax({
			method: "POST",
			url: "save_change.php",
			data: { change_color:1, background: background_color}
		})
		.done(function(response) {				
		});		
	});	
	$('#change-color2').colorpicker().on('changeColor', function(e) {
			console.log( e.color.toString('rgba'));
			var background_color2 = e.color.toString('rgba');
				
			$.ajax({
				method: "POST",
				url: "save_change.php",
				data: { change_color2:1, background2: background_color2}
			})
			.done(function(response) {				
			});		
		});	
	$('#change-color3').colorpicker().on('changeColor', function(e) {
			console.log( e.color.toString('rgba'));
			var background_color3 = e.color.toString('rgba');
				
			$.ajax({
				method: "POST",
				url: "save_change.php",
				data: { change_color3:1, background3: background_color3}
			})
			.done(function(response) {				
			});		
		});		
	// Reset default background color
	$( "#reset-color" ).click(function() {
		//$('body')[0].style.backgroundColor = "";
		$.ajax({
			method: "POST",
			url: "save_change.php",
			data: {resets:1, background: "#fff",background2: "#000", background3: "#3D3D3D"}
		})
		.done(function(response) {			
		});
	});	
});