<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TikTok_api {
    private $CI;
    private $cfg;
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('tiktok', TRUE);
        $this->cfg = $this->CI->config->item('tiktok');
    }
    public function config($key) { return isset($this->cfg[$key]) ? $this->cfg[$key] : ''; }
    public function request($method, $url, $token = '', $body = NULL, $headers = array()) {
        if (!$url || !function_exists('curl_init')) return array('ok'=>false,'error'=>'URL kosong atau cURL tidak tersedia');
        $ch = curl_init($url);
        $h = array('Accept: application/json');
        if ($token) $h[] = 'Authorization: Bearer '.$token;
        foreach ($headers as $v) $h[] = $v;
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER=>true, CURLOPT_CUSTOMREQUEST=>$method,
            CURLOPT_HTTPHEADER=>$h, CURLOPT_CONNECTTIMEOUT=>15, CURLOPT_TIMEOUT=>45,
            CURLOPT_SSL_VERIFYPEER=>true, CURLOPT_SSL_VERIFYHOST=>2
        ));
        if ($body !== NULL) {
            $h[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }
        $raw = curl_exec($ch); $err = curl_error($ch); $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $json = json_decode((string)$raw, true);
        if ($err) return array('ok'=>false,'error'=>$err,'http_code'=>$status);
        if ($status < 200 || $status >= 300) return array('ok'=>false,'error'=>'HTTP '.$status,'response'=>$json ?: $raw,'http_code'=>$status);
        return array('ok'=>true,'data'=>$json,'http_code'=>$status);
    }
    public function exchange_code($code, $code_verifier = '') {
        $url = $this->config('token_url');
        $post = array(
            'client_key' => $this->config('client_key'),
            'client_secret' => $this->config('client_secret'),
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->config('redirect_uri')
        );
        if ($code_verifier !== '')
        {
            $post['code_verifier'] = $code_verifier;
        }

        $post = http_build_query($post);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER=>true, CURLOPT_POST=>true,
            CURLOPT_POSTFIELDS=>$post, CURLOPT_HTTPHEADER=>array('Content-Type: application/x-www-form-urlencoded'),
            CURLOPT_TIMEOUT=>30, CURLOPT_SSL_VERIFYPEER=>true));
        $raw = curl_exec($ch); $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); $err = curl_error($ch); curl_close($ch);
        $data = json_decode((string)$raw, true);
        if ($err || $status < 200 || $status >= 300 || empty($data['data']['access_token']))
        {
            return array('ok' => false, 'error' => $err ?: 'Token exchange gagal', 'response' => $data ?: $raw);
        }
        return array('ok' => true, 'data' => $data['data']);
    }
    public function user_info($token) {
        $url=$this->config('user_info_url').'?fields=open_id,union_id,avatar_url,display_name';
        return $this->request('GET',$url,$token);
    }
    public function list_videos($token, $cursor = 0) {
        $url=$this->config('video_list_url').'?fields=id,title,video_description,duration,cover_image_url,share_url,embed_link,create_time,view_count,like_count,comment_count,share_count';
        return $this->request('POST',$url,$token,array('max_count'=>20,'cursor'=>(int)$cursor));
    }
}
