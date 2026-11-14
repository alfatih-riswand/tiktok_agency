<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('App_model','app'); $this->load->library(array('form_validation','TikTok_api')); }
    public function login(){
        if($this->session->userdata('user_id')) redirect('dashboard');
        $data=array('error'=>'');
        if($this->input->method(TRUE)==='POST'){
            $email=strtolower(trim($this->input->post('email',TRUE)));
            $password=(string)$this->input->post('password');
            $u=$this->app->user_by_email($email);
            if($u && password_verify($password,$u['password'])){
                $this->session->sess_regenerate(TRUE);
                $this->session->set_userdata(array('user_id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']));
                redirect('dashboard');
            }
            $data['error']='Email atau password salah.';
        }
        $this->load->view('auth/login',$data);
    }
    public function logout(){ $this->session->sess_destroy(); redirect('login'); }
    public function connect_tiktok(){
        if(!$this->session->userdata('user_id')) redirect('login');

        $state = bin2hex(random_bytes(16));
        $code_verifier = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $code_challenge = rtrim(strtr(base64_encode(hash('sha256', $code_verifier, TRUE)), '+/', '-_'), '=');

        $this->session->set_userdata(array(
            'tiktok_oauth_state' => $state,
            'tiktok_code_verifier' => $code_verifier
        ));

        $url = $this->tiktok_api->config('authorize_url') . '?' . http_build_query(array(
            'client_key' => $this->tiktok_api->config('client_key'),
            'scope' => $this->tiktok_api->config('scopes'),
            'response_type' => 'code',
            'redirect_uri' => $this->tiktok_api->config('redirect_uri'),
            'state' => $state,
            'code_challenge' => $code_challenge,
            'code_challenge_method' => 'S256'
        ));

        redirect($url);
    }
    public function tiktok_callback(){
        $state = (string)$this->input->get('state', TRUE);
        if(!$state || !hash_equals((string)$this->session->userdata('tiktok_oauth_state'), $state)){
            show_error('OAuth state tidak valid', 400);
        }

        $this->session->unset_userdata('tiktok_oauth_state');

        $code = (string)$this->input->get('code', TRUE);
        if(!$code){
            $this->session->set_flashdata('error', 'Authorization TikTok dibatalkan/gagal.');
            redirect('integration');
        }

        $code_verifier = (string)$this->session->userdata('tiktok_code_verifier');
        $this->session->unset_userdata('tiktok_code_verifier');

        $res = $this->tiktok_api->exchange_code($code, $code_verifier);
        if(!$res['ok']){
            $this->session->set_flashdata('error', 'Token exchange gagal: ' . json_encode($res['error']));
            redirect('integration');
        }

        $t = $res['data'];
        $this->app->save_token(array(
            'open_id' => isset($t['open_id']) ? $t['open_id'] : '',
            'access_token' => $t['access_token'],
            'refresh_token' => isset($t['refresh_token']) ? $t['refresh_token'] : '',
            'expires_at' => date('Y-m-d H:i:s', time() + (int)$t['expires_in']),
            'refresh_expires_at' => date('Y-m-d H:i:s', time() + (int)$t['refresh_expires_in']),
            'scope' => isset($t['scope']) ? $t['scope'] : ''
        ));
        $this->session->set_flashdata('success', 'Akun TikTok berhasil dihubungkan.');
        redirect('integration');
    }
}
