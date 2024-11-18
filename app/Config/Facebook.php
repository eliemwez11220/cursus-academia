<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/** set your facebook credential **/
class Facebook extends BaseConfig
{
    public $fb_app_id = '3183655468337394';
    public $fb_app_secret = '615911c583cce28f14cb576fd077ac7d';

    public $fbSettings = array(
        'facebook_app_id' => '3183655468337394',
        'facebook_app_secret' => '615911c583cce28f14cb576fd077ac7d',
        'facebook_login_type' => 'web',
        'facebook_login_redirect_url' => 'https://ditotase.com/facebook/login',
        'facebook_logout_redirect_url' => 'https://ditotase.com/facebook/logout',
        'facebook_permissions' => array('email'),
        'facebook_graph_version' => 'v2.6',
        'facebook_auth_on_load' => TRUE
    );
}