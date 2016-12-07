<?php

namespace SimpleRestFileupload;

use \SimpleRestFileupload\ApiConnection;

/**
 * abstract ApiController with basic handling of API
 * request methods (POST, GET, PUT, DELETE)
 *
 * leaves the actual implementation of POST GET PUT and DELETE
 * to the child class but implements itself some methods that would
 * be used by any other child classes
 *
 * @author Ramon Quiusky <ramon.quiusky@gmail.com>
 */
abstract class ApiController {

  /**
   * api connection - if necessary (decided not to use)
   * @var ApiConnection
   */
  //private $apiConnection;

  /**
   * POST, GET, UPDATE, DELETE the request method type
   * @var string
   */
  protected $method;

  /**
   * the JSON response to return
   * @var string
   */
  protected $response;

  /**
   * set method and other necessary parameters
   * @param string $method [description]
   */
  public function setMethod($method) {
    $this->method = $method;
    // let's make a connection - not used yet though
    //$this->apiConnection = new \SimpleRestFileupload\ApiConnection();
    return $this;
  }

  /**
   * [getMethod description]
   * @return [type] [description]
   */
  public function getMethod() {
    return $this->method;
  }

  /**
   * handle the request by calling the appropriate method
   * @return none
   */
  public function handleRequest() {
    switch ($this->method) {
      case 'POST':
        $this->handlePost();
        break;

      case 'GET':
        $this->handleGet();
        break;
      
      case 'PUT':
        $this->handlePut();
        break;

      case 'DELETE':
        $this->handleDelete();
        break;

      default:
        # code...
        break;
    }
  }

  /**
   * set the string response
   * @param string $response the result of operation description
   */
  public function setResponse($response) {
    $this->response = $response;
  }

  /**
   * return the JSON encoded response
   * @return string
   */
  public function getResponse() {
    return json_encode($this->response);
  }

  // ################
  // Abstract methods implemented by the child classes

  /**
   * [handlePost description]
   * @return [type] [description]
   */
  abstract public function handlePost();

  /**
   * [handleGet description]
   * @return [type] [description]
   */
  abstract public function handleGet();

  /**
   * [handlePut description]
   * @return [type] [description]
   */
  abstract public function handlePut();

  /**
   * [handleDelete description]
   * @return [type] [description]
   */
  abstract public function handleDelete();

}

