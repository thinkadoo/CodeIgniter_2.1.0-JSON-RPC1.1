<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    function Pages()
    {
        parent::__construct();

        $this->load->library('jsonrpc');
        $this->load->model('pagesmodel');

        $this->server = $this->jsonrpc->get_server();

        $methods = array(
          'index' => array(
              'function' => 'Pages.index',
              'summary' => 'Returns message hello - this is a JSON-RPC Service.'),
          'contentList' => array(
              'function' => 'Pages.contentList',
              'summary' => 'Returns a contentList of pages.'),
          'updateContentListOrder' => array(
              'function' => 'Pages.updateContentListOrder',
              'summary' => 'Updates the order of pages and groups according to the passed array.')
    );

        $this->server->define_methods($methods);
        $this->server->set_object($this);
        $this->server->serve();
    }
    
    function index()
    {
        //POST {"method":"index","params":null,"id":"1234567890"}
        $data = array('message' => 'hello - this is a JSON-RPC Service');
        return $this->server->send_response($data);
    }
    
    function contentList()
    {
        //POST {"method":"contentList","params":null,"id":"1234567890"}
        return $this->server->send_response($this->pagesmodel->get_all_pages());
    }
    
    function updateContentListOrder($order)
    {
        //POST {"method":"updateContentListOrder","params":[{"id":"2","groupID":false},{"id":"7","groupID":"2"},{"id":"6","groupID":"2"},{"id":"5","groupID":"2"},{"id":"1","groupID":false},{"id":"8","groupID":"1"},{"id":"2","groupID":"1"},{"id":"4","groupID":"1"},{"id":"1","groupID":"1"}],"id":"1234567890"}
        return $this->server->send_response($this->pagesmodel->update_order($order));
    }
}