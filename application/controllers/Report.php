<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends MY_Controller {
    public function index(){
        $from=$this->input->get('from',TRUE) ?: date('Y-m-01');
        $to=$this->input->get('to',TRUE) ?: date('Y-m-d');
        $rows=$this->db->query("SELECT c.name creator, COUNT(v.id) videos, COALESCE(SUM(v.views),0) views, COALESCE(SUM(v.likes),0) likes, COALESCE(SUM(v.comments),0) comments, COALESCE(SUM(v.shares),0) shares FROM creators c LEFT JOIN contents v ON v.creator_id=c.id AND DATE(v.created_at) BETWEEN ? AND ? GROUP BY c.id ORDER BY views DESC",array($from,$to))->result_array();
        $this->render('report',array('title'=>'Reports','rows'=>$rows,'from'=>$from,'to'=>$to));
    }
}
