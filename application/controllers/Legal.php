<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legal extends CI_Controller {
    public function index(){
        $this->load->view('legal/index');
    }

    public function terms(){
        $this->load->view('legal/index');
    }

    public function privacy(){
        $this->load->view('legal/index');
    }
}
