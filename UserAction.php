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

    public function recommend_app() {
        $device = $_GET['system'];
        if(!strcasecmp($device,"ios")) {
            $data = array(array("id"=> 1,"title"=>"咖啡声声",
                "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                "logo_uri"=>"http://192.168.22.203/static/coffee.png",
                "download_link"=>"https://itunes.apple.com/cn/app/dao-xi-la-hun-yan-xi-yan-dang/id686383028?mt=8"),
                array("id"=> 2,"title"=>"超萌聊天",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/line.png",
                    "download_link"=>"https://itunes.apple.com/cn/app/dao-xi-la-hun-yan-xi-yan-dang/id686383028?mt=8"),
                array("id"=> 3,"title"=>"反应大考验",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/man.png",
                    "download_link"=>"https://itunes.apple.com/cn/app/dao-xi-la-hun-yan-xi-yan-dang/id686383028?mt=8"),
                array("id"=> 4,"title"=>"反应大考验",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/reaction.png",
                    "download_link"=>"https://itunes.apple.com/cn/app/dao-xi-la-hun-yan-xi-yan-dang/id686383028?mt=8"));
            echo json_encode($data);
        } else{
            $data = array(array("id"=> 1,"title"=>"咖啡声声",
                "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                "logo_uri"=>"http://192.168.22.203/static/coffee.png",
                "download_link"=>"http://app.daoxila.com/app/HunYan_android"),
                array("id"=> 2,"title"=>"超萌聊天",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/line.png",
                    "download_link"=>"http://app.daoxila.com/app/HunYan_android"),
                array("id"=> 3,"title"=>"反应大考验",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/man.png",
                    "download_link"=>"http://app.daoxila.com/app/HunYan_android"),
                array("id"=> 4,"title"=>"反应大考验",
                    "description"=>"分錧菜品丰富多样，选材新鲜,分錧菜品丰富多样，选材新鲜",
                    "logo_uri"=>"http://192.168.22.203/static/reaction.png",
                    "download_link"=>"http://app.daoxila.com/app/HunYan_android"));
            echo json_encode($data);
        }
    }
}
