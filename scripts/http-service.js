/**
 * HttpService module that sets up connection to 
 * API that controls file upload and management
 *
 * Handles GET, POST, PUT, DELETE requests
 */
var HttpService = (function() {

	var API_ENDPOINT = 'src/api.php/';

	return {
	
		/**
		 * Make an API request (GET, POST, PUT, DELETE)
		 * 
		 * @param  {String}   url
		 * @param  {String}   method
		 * @param  {Object}   data
		 * @param  {Function} success
		 * @param  {Function} fail
		 * @return {void}
		 */
		serviceRequest: function(url, method, data, success, fail) {

			/*&if (method !== 'GET' && data !== null) {
				data = JSON.stringify(data);
			}*/
			
			var now = new Date().getTime();
			
			if (url.indexOf('?') === -1) {
				url += '?_=' + now;
			} else {
				url += '&_=' + now;
			}

			$.ajax({
				url: API_ENDPOINT + url,
				method: method,
				data: data,
		        cache: false,
		        dataType: 'json',
		        contentType: false,
				processData: false,
		        success: function(data, textStatus, jqXHR) {
		            if (typeof data.error === 'undefined') {
		                // Success so call function to process the form
		                success(data);

		            } else {
		                // Handle errors here
		                fail(jqXHR.responseJSON, jqXHR.status);
		            }
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		            // Handle errors here
					fail(jqXHR.responseJSON, jqXHR.status);
		        }
			});

		},

		/**
		 * Make a GET request
		 * 
		 * @param  {String}   url
		 * @param  {Object}   data
		 * @param  {Function} success
		 * @param  {Function} fail
		 * @return {void}
		 */
		serviceGet: function(url, data, success, fail) {
			this.serviceRequest(url, 'GET', data, success, fail);
		},

		/**
		 * Make a POST request
		 * 
		 * @param  {String}   url
		 * @param  {Object}   data
		 * @param  {Function} success
		 * @param  {Function} fail
		 * @return {void}
		 */
		servicePost: function(url, data, success, fail)
		{
			this.serviceRequest(url, 'POST', data, success, fail);
		},

		/**
		 * Make a PUT request
		 * 
		 * @param  {String}   url
		 * @param  {Object}   data
		 * @param  {Function} success
		 * @param  {Function} fail
		 * @return {void}
		 */
		servicePut: function(url, data, success, fail)
		{
			this.serviceRequest(url, 'PUT', data, success, fail);
		},

		/**
		 * Make a DELETE request
		 * 
		 * @param  {String}   url
		 * @param  {Object}   data
		 * @param  {Function} success
		 * @param  {Function} fail
		 * @return {void}
		 */
		serviceDelete: function(url, data, success, fail)
		{
			this.serviceRequest(url, 'DELETE', data, success, fail);
		}

	}

})();





