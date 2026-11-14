<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['client_key'] = 'awe69jljf2j4d5uc';
$config['client_secret'] = 'voq1ooW629GzNwoAhufruotraTS4QOJ0';
$config['redirect_uri'] = 'https://mis-helpdesk.rptech.co.id/tiktok_agency/index.php/auth/tiktok_callback';
$config['scopes'] = 'user.info.basic,video.list';
$config['authorize_url'] = 'https://www.tiktok.com/v2/auth/authorize/';
$config['token_url'] = 'https://open.tiktokapis.com/v2/oauth/token/';
$config['user_info_url'] = 'https://open.tiktokapis.com/v2/user/info/';
$config['video_list_url'] = 'https://open.tiktokapis.com/v2/video/list/';
$config['shop_access_token'] = ''; // seller/partner token; keep server-side
$config['shop_api_base'] = ''; // fill from approved regional Partner API documentation
$config['shop_live_endpoint'] = '';
$config['shop_sales_endpoint'] = '';
