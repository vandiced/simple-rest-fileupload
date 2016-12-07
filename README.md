Place the entire project directory in a location that will run the php code.
This was developed in PHP 5.6.25

This also pulls in external Bootstrap css https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u
	
	-> I decided to do this instead of including the source code in the project to keep the project small and to show integration with a CSS framework

I'm also using Bootstrap JS, my thinking being 'why reinvent the wheel?'

It might be required to change the uploads/ and uploads/my-files/ directory to allow for files to be saved there (I changed it to 777)

The project uses LESS and the final CSS output is included in index.php as styles/css/main.css

Both the Javascript and PHP are made to act as RESTful API. The GET, POST, and DELETE is fully implemented in the PHP MyFile.php

MyFile.php extends Abstract class ApiController.php. ApiController was designed to be able to be used in other types of classes - the POST, GET, PUT, DELETE are abstract methods that need to be implemented by the child class (in this case MyFile.php)

I am renaming each uploaded file by prepending a timestamp, wanted something simple