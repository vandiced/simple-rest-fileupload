<?php

namespace SimpleRestFileupload;

use \SimpleRestFileupload\ApiController;

/**
 * MyFile entity class to handle the files from request
 * uses the ApiController with basic handling of API
 * request methods (POST, GET, PUT, DELETE)
 *
 * @author Ramon Quiusky <ramon.quiusky@gmail.com>
 */
class MyFile extends ApiController {

	/**
	 * the upload target directory
	 * @var string
	 */
	private $uploadDir;

	/**
	 * the actual final file name
	 * @var string
	 */
	private $targetFileName;

	/**
	 * the full upload file path
	 * @var string
	 */
	private $uploadFile;

	/**
	 * the file data
	 * @var string
	 */
	private $file;

	/**
	 * the file name to be deleted IF request type is DELETE
	 * @var string
	 */
	private $fileNameToDelete;

	/**
	 * constructor that sets basic properties for file upload
	 */
	public function __construct() {

	}

	/**
	 * set the required properties
	 * 
	 * @param string $method         POST, GET, UPDATE, DELETE the 
	 *                               request method type
	 * @param string $uploadDir      the upload target directory
	 * @param string $targetFileName the actual final file name
	 * @param string $file           the file data
	 * @param string $fileNameToDelete the file name to be deleted
	 *                                 IF the request type is DELETE
	 */
	public function setProperties($method, $uploadDir, $targetFileName, $file, $fileNameToDelete) {
		// call the parent setMethod
		$this->setMethod($method);

		// set all the other MyFile specific properties
		$this->uploadDir = $uploadDir;
		$this->targetFileName = $targetFileName;
    	$this->uploadFile = $uploadDir . $targetFileName;
    	$this->file = $file;
    	$this->fileNameToDelete = $fileNameToDelete;

    	return $this;
    }

	/**
	 * POST save the file to the specified upload directory
	 * @return none
	 */
	public function handlePost() {

		if (move_uploaded_file($this->file, $this->uploadFile)) {
	        $this->setResponse(array('fileName' => $this->targetFileName, 'message' => 'File was successfully uploaded.'));
	    } else {
	    	$this->setResponse(array('message' => 'Possible file upload attack!'));
	    }

	}

	/**
	 * GET find the specified  file(s) and return it
	 * @return array
	 */
	public function handleGet() {

		$myFileList = array();
		
		// iterate through the contents of the directory containing
		// all the My Files
		$fileNames = scandir($this->uploadDir);
		foreach ($fileNames as $fileName) {
			if ($fileName != '.' && $fileName != '..') {
				$myFileList[] = $fileName;
			}
		}

		/*foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->uploadDir)) as $filename) {
		    // filter out "." and ".."
		    if ($filename->isDir()) {
		    	continue;
		    }

		    //	var_dump($filename);
		    /*
		    object(SplFileInfo)#5 (2) {
			  ["pathName":"SplFileInfo":private]=>
			  string(38) "../uploads/my-files/1481041417_JS Tips"
			  ["fileName":"SplFileInfo":private]=>
			  string(18) "1481041417_JS Tips"
			}
			{"fileList":["1481041417_JS Tips"]}
		     *=/

		    // return the file names in an array (just the file name
		    // itself, not the full path)
		    //$myFileList[] = $filename->getFileName();
		}*/



		$this->setResponse(array('fileList' => $myFileList));

	}

	/**
	 * PUT update the specified file
	 * @return [type] [description]
	 */
	public function handlePut() {
		
	}

	/**
	 * DELETE remove the specified file
	 */
	public function handleDelete() {

		$realPath = realpath($this->uploadDir . $this->fileNameToDelete);
		$message = '';
		if (is_writable($realPath)) {
		    unlink($realPath);
		    $message = 'File deleted';
		} else {
		    $message = 'File was not deleted';
		}
		
		$this->setResponse(array('message' => $message));
	}
}