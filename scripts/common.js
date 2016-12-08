/** 
 * the first js file to be loaded - take care of setting up
 * all of the required paths
 */
requirejs.config({
	
	baseUrl: 'scripts',
	paths: {
		// why array? because you can add the CDN location of
		// jquery (external, like hosted on google) and if
		// that fails, load the local one
		jquery: [
			'jquery/3.1.1/jquery.min'
		],
		bootstrap: 'bootstrap/3.3.7/bootstrap.min',
		httpService: 'http-service',
		index: 'index'
	}

});

