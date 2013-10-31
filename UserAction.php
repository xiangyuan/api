<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/31/13
 * Time: 1:18 PM
 * To change this template use File | Settings | File Templates.
 */
class UserAction
{

    public function get_users() {
        print_r($_GET);
    }

    /*
     * get the specify user
     */
    public function get_user() {
        print $_SERVER['REQUEST_METHOD'];
        print_r($_GET);
    }
}
