/**
 * this script handles the view's elements and file upload actions
 */
$(document).ready(function () {

	// Variable to store your files
	var files;
	// object containing file error/standard messages
	var fileMessages = {
		standard: '50K max',
		error: 'File not uploaded: must be 50K max'
	};


	// click event to reset any error/success messages
	$('input[type=file]').on('click', function(event) {

	    // reset the upload response message
	    $('.upload-response').addClass('hide');

	    // reset the error message
	    $('.file-rule').removeClass('file-error');
	    $('.file-rule').html(fileMessages.standard);

	});

	// change event that handles the file validation and upload
	$('input[type=file]').on('change', function(event) {

		// Stop stuff happening
		event.stopPropagation(); 
	    event.preventDefault();

	    if (!fileSizeValidation(this.files[0].size)) {
	    	return false;
	    }

		//files = event.target.files;
		// get the form data
		var formData = new FormData();
		formData.append('formData', this.files[0]);

		// START A LOADING SPINNER HERE

		// POST request file upload
		HttpService.servicePost('my-files/', formData, function(response) {
			
			//console.log(response);
			$('span.upload-response').removeClass('hide');
			$('.no-files-uploaded-message').hide();

			// add the new file html to the my-files-container
			$('.my-files-container').append(fileInfoHtml(response.fileName));

		// handle errors
		}, function(errors, status){
			if (status == 404) {
				console.log('success 404');
			} else {
				//fail(errors, status);
				console.log('fail');
			}
		});

	});

	// handle the delete file from My Files section
	$('.my-files-container').on('click', '.delete', function(event) {

		// simple confirm delete message
		if (confirm('Delete the file?')) {

			// create data object with property fileName
			var data = {
				fileName: $(this).data('filename')
			}

			// need to save the event triggering element to use
			// to remove if delete was successful
			$fileManagementBox = $(this);

			// POST request file upload
			HttpService.serviceDelete('my-files?fileName=' + encodeURIComponent(data.fileName), data, function(response) {

				// remove the file html from my-files-container
				$fileManagementBox.closest('.file-management-box').remove();

				// if there are no more file uploads, show
				// 'No files uploaded' message
				var countFilesUpload = $('.my-files-container').find('.file-management-box').length;
				if (countFilesUpload == 0) {
					$('.no-files-uploaded-message').show();
				}

			// handle errors
			}, function(errors, status){
				if (status == 404) {
					console.log('success 404');
				} else {
					//fail(errors, status);
					console.log('fail');
				}
			});

		}

	});

	/**
	 * validate the file size and show correct messaging
	 * @param  {[string]} fileSize the file size value
	 * @return {[boolean]} return true or false depending on
	 *                            file being under 50K or not
	 */
	var fileSizeValidation = function(fileSize) {
		if (parseInt(fileSize) >= 50000) {
	    	$('.file-rule').addClass('file-error');
	    	$('.file-rule').html(fileMessages.error);
	    	return false;
	    } else {
	    	$('.file-rule').removeClass('file-error');
	    	$('.file-rule').html(fileMessages.standard);	
	    	return true;
	    }
	}
	
});

// My Files section - load all the files if available
$(window).on('load', function() {

	// GET request file upload - gets all the files uploaded
	// and puts them in My Files section. doing it on page
	// finished loading so that it's only done once
	HttpService.serviceGet('my-files/', {}, function(response) {

		//console.log(response);
		
		// hide the 'No files uploaded' message
		if (response.fileList.length > 0) {
			$('.no-files-uploaded-message').hide();
		}

		// loop through the file list and append to the container
		for (var i in response.fileList) {
			$('.my-files-container').append(fileInfoHtml(response.fileList[i]));
		}

	// handle errors
	}, function(errors, status){
		if (status == 404) {
			console.log('success 404');
		} else {
			//fail(errors, status);
			console.log('fail');
		}
	});
});

/**
 * function returns 'template' for each uploaded file section
 * in My Files
 * @param  string fileName the file name  string
 * @return string          the html template for each My File
 */
var fileInfoHtml = function(fileName) {
	var fileNameHtml = '<div class="file-management-box ">'
				+ '<div class="file-label-container">'
					+ '<span class="main-label">'+ fileName + '</span>'
					//+ '<span class="sub-label">Uploaded on ' + fileUploadedOn + '</span>'
				+ '</div>'
				+ '<div class="file-actions ">'
					+ '<div class="download">'
						+ '<a href="uploads/my-files/' + fileName + '"'
						+ ' download="' + fileName + '">'
						+ 'download'
						+ '</a>'
					+ '</div>'
					+ '<div class="delete" data-filename="' + fileName + '">'
						+ 'delete'
					+ '</div>'
				+ '</div><div class="clear"></div>'
			+ '</div>';
	return fileNameHtml;
}