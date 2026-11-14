<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhooks extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    public function tiktok(){
        $method = $this->input->method(TRUE);
        $raw = file_get_contents('php://input');
        $payload = $raw ? json_decode($raw, true) : $this->input->post();

        if ($method === 'GET') {
            $challenge = $this->input->get('challenge', TRUE);
            if ($challenge) {
                header('Content-Type: text/plain');
                echo $challenge;
                exit;
            }
        }

        $log = array(
            'method' => $method,
            'headers' => headers_list(),
            'payload' => $payload,
            'raw' => $raw,
            'query' => $this->input->get() ?: array()
        );

        log_message('info', 'TikTok webhook received: ' . json_encode($log));

        header('Content-Type: application/json');
        echo json_encode(array('status' => 'ok', 'received' => true));
        exit;
    }
}
