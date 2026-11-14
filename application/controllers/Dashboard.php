<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('App_model','app'); }
    public function index(){
        $this->render('dashboard',array('title'=>'Dashboard','kpi'=>$this->app->kpis(),'chart'=>$this->app->chart_days(),
            'top_creators'=>$this->db->query("SELECT c.name, SUM(v.views) views, SUM(v.likes) likes FROM creators c LEFT JOIN contents v ON v.creator_id=c.id GROUP BY c.id ORDER BY views DESC LIMIT 5")->result_array(),
            'top_videos'=>$this->db->order_by('views','DESC')->limit(5)->get('contents')->result_array()));
    }
}
