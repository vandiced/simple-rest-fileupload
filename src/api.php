<?php

// simple autoloader class to autoload the required files
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');


// process the request

 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
// set the upload target directory
$uploaddir = '../uploads/my-files/';
// set the actual final file name
$targetFileName = null;
// set the full upload file path
//$uploadfile = null;
// set the file data
$file = null;
// filename in case DELETE is the request
$fileNameToDelete = null;

// only get fileName parameter if the request type is DELETE
if ($method == 'DELETE') {

  // set the file name passed in the url as a parameter
  if (isset($_REQUEST['fileName'])) {
    $fileNameToDelete = $_REQUEST['fileName'];

  // else return error
  } else {
    echo json_encode('File not found');
    exit;
  }
}


// if the request is type POST or PUT, we need to get the 
// file parameters as required to save it
if ($method == 'POST' || 'PUT') {
  // set the actual final file name
  $targetFileName = time() . '_' . basename($_FILES['formData']['name']);
  // set the full upload file path
  //$uploadfile = $uploaddir . $targetFileName;
  // set the file data
  $file = $_FILES['formData']['tmp_name'];
}

// new MyFile class
$response = '';
$newMyFile = new \SimpleRestFileupload\MyFile();
$newMyFile->setProperties($method, $uploaddir, $targetFileName, $file, $fileNameToDelete)->handleRequest();

echo $newMyFile->getResponse();