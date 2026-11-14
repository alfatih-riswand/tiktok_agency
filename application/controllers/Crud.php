<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud extends MY_Controller {
    private $map=array(
        'agencies'=>array('Agency','name,contact_email,status','name,contact_email,status'),
        'creators'=>array('Creator','name,tiktok_username,agency_id,status','name,tiktok_username,agency_id,status'),
        'campaigns'=>array('Campaign','name,start_date,end_date,budget,target_views,status','name,start_date,end_date,budget,target_views,status'),
        'contents'=>array('Content','title,creator_id,tiktok_video_id,views,likes,comments,shares','title,creator_id,tiktok_video_id,views,likes,comments,shares'),
        'products'=>array('Product','name,sku,category,price,status','name,sku,category,price,status'),
        'live_sessions'=>array('Live Session','creator_id,title,started_at,ended_at,viewers_peak,likes,gmv,status','creator_id,title,started_at,ended_at,viewers_peak,likes,gmv,status')
    );
    public function __construct(){ parent::__construct(); $this->load->model('App_model','app'); }
    public function index($table='creators'){
        if(!isset($this->map[$table])) show_404();
        $this->render('crud',array('title'=>$this->map[$table][0],'table'=>$table,'columns'=>explode(',',$this->map[$table][1]),'rows'=>$this->app->table_rows($table)));
    }
    public function save($table){
        if(!isset($this->map[$table])) show_404();
        $cols=explode(',',$this->map[$table][2]); $data=array();
        foreach($cols as $c){ $v=$this->input->post($c,TRUE); if($v!==NULL) $data[$c]=$v; }
        if(isset($data['price']) || isset($data['budget']) || isset($data['gmv'])) foreach(array('price','budget','gmv') as $n) if(isset($data[$n])) $data[$n]=(float)$data[$n];
        foreach(array('views','likes','comments','shares','target_views','viewers_peak','agency_id','creator_id') as $n) if(isset($data[$n])) $data[$n]=(int)$data[$n];
        $id=(int)$this->input->post('id');
        if($id) $this->app->save_row($table,$data,$id); else $this->app->save_row($table,$data);
        $this->session->set_flashdata('success','Data berhasil disimpan.'); redirect('crud/index/'.$table);
    }
    public function delete($table,$id){
        if(!isset($this->map[$table])) show_404();
        $this->app->delete_row($table,(int)$id); $this->session->set_flashdata('success','Data berhasil dihapus.'); redirect('crud/index/'.$table);
    }
}
