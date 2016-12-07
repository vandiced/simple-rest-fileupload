<?php

namespace SimpleRestFileupload;

/**
 * the ApiConnection class with basic handling of API
 * request methods (POST, GET, PUT, DELETE)
 *
 * @author Ramon Quiusky <ramon.quiusky@gmail.com>
 */
class ApiConnection {

  /**
   * GET, POST, PUT, DELETE request method type
   * @var string
   */
  protected $method;

  /**
   * request path info, file/input element info
   * @var string
   */
  protected $request;

  /**
   * the actual file input data
   * @var [type]
   */
  protected $input;

  public function __construct() {

    //$this->method = $_SERVER['REQUEST_METHOD'];
    //$this->request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
    //$this->input = json_decode(file_get_contents('php://input'), true);

  }

}