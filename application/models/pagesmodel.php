<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagesmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function Pagesmodel()
    {
        parent::__construct();
    }
    
    function get_all_pages()
    {
        $data = array(
                       'title' => 'My Title',
                       'heading' => 'My Heading',
                       'message' => 'My Message'
                  );
        return $data;
    }

    function update_order($order)
    {
        return $order;
    }

}