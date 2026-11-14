<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App_model extends CI_Model {
    public function table_rows($table, $limit=500) {
        $allowed=array('agencies','creators','campaigns','contents','products','live_sessions');
        if (!in_array($table,$allowed)) return array();
        return $this->db->order_by('id','DESC')->limit((int)$limit)->get($table)->result_array();
    }
    public function save_row($table,$data,$id=0) {
        $allowed=array('agencies','creators','campaigns','contents','products','live_sessions');
        if (!in_array($table,$allowed)) return false;
        if ($id) return $this->db->where('id',(int)$id)->update($table,$data);
        return $this->db->insert($table,$data);
    }
    public function delete_row($table,$id) {
        $allowed=array('agencies','creators','campaigns','contents','products','live_sessions');
        if (!in_array($table,$allowed)) return false;
        return $this->db->where('id',(int)$id)->delete($table);
    }
    public function get_row($table,$id) { return $this->db->where('id',(int)$id)->get($table)->row_array(); }
    public function kpis() {
        $r=array();
        $r['creators']=$this->db->count_all('creators');
        $r['videos']=$this->db->count_all('contents');
        $r['views']=(int)$this->db->select_sum('views')->get('contents')->row()->views;
        $r['likes']=(int)$this->db->select_sum('likes')->get('contents')->row()->likes;
        $r['comments']=(int)$this->db->select_sum('comments')->get('contents')->row()->comments;
        $r['shares']=(int)$this->db->select_sum('shares')->get('contents')->row()->shares;
        $r['gmv']=(float)$this->db->select_sum('gmv')->get('live_sessions')->row()->gmv;
        return $r;
    }
    public function chart_days() {
        return $this->db->query("SELECT DATE(created_at) day, SUM(views) views, SUM(likes) likes FROM contents WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 13 DAY) GROUP BY DATE(created_at) ORDER BY day")->result_array();
    }
    public function user_by_email($email) { return $this->db->get_where('users',array('email'=>$email,'is_active'=>1))->row_array(); }
    public function save_token($data) { return $this->db->insert('tiktok_tokens',$data); }
    public function token() { return $this->db->order_by('id','DESC')->get('tiktok_tokens')->row_array(); }
    public function log_sync($status,$message) { $this->db->insert('sync_logs',array('status'=>$status,'message'=>$message)); }
    public function upsert_video($v,$creator_id) {
        $id=isset($v['id'])?(string)$v['id']:'';
        if (!$id) return;
        $data=array(
            'creator_id'=>(int)$creator_id,'tiktok_video_id'=>$id,
            'title'=>substr(isset($v['title'])?$v['title']:'',0,255),
            'description'=>isset($v['video_description'])?$v['video_description']:'',
            'cover_url'=>isset($v['cover_image_url'])?$v['cover_image_url']:'',
            'share_url'=>isset($v['share_url'])?$v['share_url']:'',
            'duration'=>isset($v['duration'])?(int)$v['duration']:0,
            'views'=>isset($v['view_count'])?(int)$v['view_count']:0,
            'likes'=>isset($v['like_count'])?(int)$v['like_count']:0,
            'comments'=>isset($v['comment_count'])?(int)$v['comment_count']:0,
            'shares'=>isset($v['share_count'])?(int)$v['share_count']:0,
            'tiktok_created_at'=>isset($v['create_time'])?date('Y-m-d H:i:s',(int)$v['create_time']):NULL,
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $old=$this->db->get_where('contents',array('tiktok_video_id'=>$id))->row_array();
        if ($old) $this->db->where('id',$old['id'])->update('contents',$data);
        else { $data['created_at']=date('Y-m-d H:i:s'); $this->db->insert('contents',$data); }
    }
}
