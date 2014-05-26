// JavaScript Document

$(document).ready(function(){
	$("#theList tr:even").addClass("stripe1");
	$("#theList tr:odd").addClass("stripe2");

	$("#theList tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
