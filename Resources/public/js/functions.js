$(function() {

	//===== Tags =====//

	$('.tags').tagsInput({width:'100%'});

	//===== Animated dropdown for the right links group on breadcrumbs line =====//

	$('.breadLinks ul li').click(function () {
		$(this).children("ul").slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("has"))
		$('.breadLinks ul li').children("ul").slideUp(150);
	});

	$(".styled, input:radio, input:checkbox, .dataTables_length select, select, input[type=file]").uniform();

});
