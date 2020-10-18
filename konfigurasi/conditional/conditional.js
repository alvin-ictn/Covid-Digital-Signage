//Copyright 2015 Pareto Software, LLC, released under an MIT license: http://opensource.org/licenses/MIT
$( document ).ready(function() {
		var testimonial_ok=false;
		//Inputs that determine what fields to show
		var rating = $('#live_form input:radio[name=rating]');
		var testimonial=$('#live_form input:radio[name=testimonial]');				
		
		//Wrappers for all fields
		var bad = $('#live_form input[id="bad"]').parent();
		var vidslidut = $('#live_form input[id="vidslidut"]').parent();
		var durgamslidut = $('#live_form input[id="durgamslidut"]').parent();
		var gamslidut = $('#live_form input[id="gamslidut"]').parent();
		var thanks_anyway  = $('#live_form #thanks_anyway');
		var all=bad.add(vidslidut).add(durgamslidut).add(gamslidut).add(thanks_anyway);
		
		rating.change(function(){
			var value=this.value;						
			all.addClass('hidden'); //hide everything and reveal as needed
			
			if (value == 'gambar'){
				gamslidut.removeClass('hidden');
				durgamslidut.removeClass('hidden');
			}
			else if (value == 'video'){
				vidslidut.removeClass('hidden');
			}		
			
		});	

		
		testimonial.change(function(){
			all.addClass('hidden'); 
			testimonial_parent.removeClass('hidden');
		
			testimonial_ok=this.value;
			
			if (testimonial_ok == 'yes'){
				great.removeClass('hidden');
			}
			else{
				thanks_anyway.removeClass('hidden');
			}
			
		});
});
