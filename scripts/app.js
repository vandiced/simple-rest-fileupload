define([
	'jquery',
	'bootstrap',
	'httpService',
	'index'], function($, bootstrap) {
	//$('.file-rule').text('happy cheesecake!');
	
	// just for fun create an object and return
	var Methods = {
		welcomeAlert: function() {
			alert('Welcome!');
		}
	}

	return Methods;

});