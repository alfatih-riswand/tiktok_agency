<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {
    public function __construct(){ parent::__construct(); $this->admin_only(); }
    public function index(){ $this->render('users',array('title'=>'User Management','rows'=>$this->db->order_by('id','DESC')->get('users')->result_array())); }
    public function save(){
        $id=(int)$this->input->post('id');
        $d=array('name'=>$this->input->post('name',TRUE),'email'=>$this->input->post('email',TRUE),'role'=>$this->input->post('role',TRUE),'is_active'=>(int)$this->input->post('is_active'));
        $pw=(string)$this->input->post('password');
        if($pw!=='') $d['password']=password_hash($pw,PASSWORD_DEFAULT);
        if($id) $this->db->where('id',$id)->update('users',$d); else { if(!$pw) show_error('Password wajib untuk user baru'); $this->db->insert('users',$d); }
        redirect('users');
    }
    public function delete($id){ if((int)$id===(int)$this->session->userdata('user_id')) show_error('Tidak dapat menghapus akun sendiri'); $this->db->where('id',(int)$id)->delete('users'); redirect('users'); }
}
