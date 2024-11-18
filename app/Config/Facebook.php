<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/** set your facebook credential **/
class Facebook extends BaseConfig
{
    public $fb_app_id = '_put_your_key_here';
    public $fb_app_secret = '_put_your_key_here';

    public $fbSettings = array(
        'facebook_app_id' => '_put_your_key_here',
        'facebook_app_secret' => '_put_your_key_here',
        'facebook_login_type' => 'web',
        'facebook_login_redirect_url' => '_put_your_url_here',
        'facebook_logout_redirect_url' => '_put_your_url_here',
        'facebook_permissions' => array('email'),
        'facebook_graph_version' => 'v2.6',
        'facebook_auth_on_load' => TRUE
    );
}