<?php
require_once(AUTHORIZATION_PATH . "/UnAuthorizedController.php");
require_once (PACK_PATH . "/Response.php");
//require_once ("MaketokenControllerDatabase.php");

final class MockController extends UnAuthorizedController
{
    /**
     * @var
     * All info from the input stream
     */
    private $jsonData;

    /**
     * @var
     * Used for unit testing
     */
    public $testAttribute;

    /**
     * __construct
     *
     * @access public
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        // set incoming json data
        $this->jsonData = $this->getJsonData();
    }

    /**
     * @param $id
     * @throws ApiException
     */
    public function get($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        $data = [
            "controller" => "Test",
            "method" => "GET",
            "id" => $id
        ];

        $data2 = ["key" => "value"];

        // pack in a response object
        $response = new Response();
        $response->addObject("data", $data)
            ->addObject("", $data2);

        // send the response
        $out = $response->getResponse();

        $this->send($out);
    }

    /**
     * @param $id
     * @throws ApiException
     * @throws Exception
     */
    public function head($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        $data = [
            "controller" => "Test",
            "method" => "HEAD",
            "id" => $id
        ];
        $this->send($data);

    }

    /**
     * @param $id
     * @throws Exception
     */
    public function post($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        // make dummy data to output
        $data = [
            "controller" => "Test",
            "method" => "POST",
            "id" => $id,
            "data" => $this->jsonData
        ];
        $this->send($data);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function put($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        // make dummy data to output
        $data = [
            "controller" => "Test",
            "method" => "PUT",
            "id" => $id,
            "data" => $this->jsonData
        ];
        $this->send($data);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function delete($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        // make dummy data to output
        $data = [
            "controller" => "Test",
            "method" => "DELETE",
            "id" => $id,
            "data" => $this->jsonData
        ];
        $this->send($data);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function options($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        // make dummy data to output
        $data = [
            "controller" => "Test",
            "method" => "OPTIONS",
            "id" => $id,
            "data" => $this->jsonData
        ];
        $this->send($data);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function patch($id)
    {
        // used for unit tests
        $this->testAttribute = $id;
        // used for integration tests
        // make dummy data to output
        $data = [
            "controller" => "Test",
            "method" => "PATCH",
            "id" => $id,
            "data" => $this->jsonData
        ];
        $this->send($data);
    }
}

