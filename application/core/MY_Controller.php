<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id') && !in_array($this->router->class, array('auth'))) {
            redirect('login');
        }
        if ($this->session->userdata('user_id')) {
            $this->load->vars(array('current_user' => $this->session->userdata()));
        }
    }
    protected function admin_only() {
        if ($this->session->userdata('role') !== 'admin') show_error('Akses ditolak', 403);
    }
    protected function render($view, $data = array()) {
        $data['page_view'] = 'pages/' . ltrim($view, '/');
        $this->load->view('layouts/main', $data);
    }
}
