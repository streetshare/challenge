<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/libraries/Amfphp/ClassLoader.php";

class Gateway extends CI_Controller {

    function __construct() {
        parent::__construct();

        //$this->load->model('http_headers_model', 'http_headers');
        //$this->http_headers->sendSiteHeaders();
    }

    function index() {
        $config = new Amfphp_Core_Config(); //do something with config object here
        $config->serviceFolders = array(dirname(__FILE__) . "/services/");

        $gateway = Amfphp_Core_HttpRequestGatewayFactory::createGateway($config);

        $gateway->service();
        $gateway->output();
    }

}

?>
