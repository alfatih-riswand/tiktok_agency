<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Integration extends MY_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('App_model','app'); $this->load->library('TikTok_api'); }
    public function index(){
        $this->render('integration',array('title'=>'Integrasi API','token'=>$this->app->token(),
            'creators'=>$this->db->get('creators')->result_array(),
            'logs'=>$this->db->order_by('id','DESC')->limit(10)->get('sync_logs')->result_array()));
    }
    public function sync(){
        if($this->input->method(TRUE)!=='POST') show_error('Method not allowed',405);
        $creator_id=(int)$this->input->post('creator_id');
        $creator=$this->db->get_where('creators',array('id'=>$creator_id))->row_array();
        $token=$this->app->token();
        if(!$creator || !$token){ $this->session->set_flashdata('error','Pilih creator dan hubungkan akun TikTok terlebih dahulu.'); redirect('integration'); }
        $res=$this->tiktok_api->list_videos($token['access_token']);
        if(!$res['ok']){ $this->app->log_sync('error',json_encode($res)); $this->session->set_flashdata('error','Sinkronisasi gagal: '.htmlspecialchars(json_encode($res['error']))); redirect('integration'); }
        $videos=isset($res['data']['data']['videos'])?$res['data']['data']['videos']:array();
        foreach($videos as $v) $this->app->upsert_video($v,$creator_id);
        $this->app->log_sync('success','Berhasil sinkron '.count($videos).' video untuk '.$creator['name']);
        $this->session->set_flashdata('success','Sinkronisasi selesai: '.count($videos).' video.');
        redirect('integration');
    }
}
