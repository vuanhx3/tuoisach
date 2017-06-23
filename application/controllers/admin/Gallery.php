<?php 


/**
* 
*/
class Gallery extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function connector(){
        require_once './public/ckfinder/core/connector/php/connector.php';
    }

    public function html(){
        $this->load->view('admin/ckfinder/gallery',$this->data);
    }
    public function editorhtml(){
        $this->load->view('admin/ckfinder/ckeditorgallery');
    }
}