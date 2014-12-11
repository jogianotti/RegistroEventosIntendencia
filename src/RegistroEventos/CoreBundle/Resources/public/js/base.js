$( document ).ready(function() {
	$("#{{ app.request.get('_route') }}").addClass("active");
});