$(document).ready(function(){
$(document).foundation();


$("#login").click(function(e){
	$("#nav_menu").hide(10);

$("#search").hide(100);	

$("#user").slideToggle(350);

});


$("#search_button").click(function(e){
$("#user").hide(100);
$("#nav_menu").hide(10);

$("#search").slideToggle(500);

});



// Resnponsive


$(".menu-icon").click(function(e){
	$("#search").hide(10);
	$("#user").hide(10);


$("#nav_menu").slideToggle(400);

});



});



