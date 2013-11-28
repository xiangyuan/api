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

//    private $pdo = null;


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
        $pdo = new PDO("mysql:host=localhost;port=3304;dbname=calendar",'root','');
        $device = $_GET['platform'];
        $count = 14;
        $page = $_GET['page'];
        $pageNo = empty($page) == true ? 0 : ($page - 1) * 10;
        if(!strcasecmp($device,"ios")) {
            $device = "ios";
        } else{
            $device = "android";
        }
        $sql = "select * from recommend_apps where platform = '" .$device . "' limit " . $pageNo . " ,10";
        $stmt = $pdo->prepare($sql);
//        $stmt = $pdo->prepare("select count(*) count from recommend_apps where platform = '" .$device."'");
        $stmt->execute();
//        $count = $stmt->fetch(PDO::FETCH_INTO);
//        $stmt = $pdo->query($sql);
        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = array("count"=>$count,"items"=>$ret);
        echo json_encode($json);
    }

    /**
     * marry registry
     */
    public function marry_registry() {
        $city = $_GET['city'];
        if (empty($city)) {
            echo "{\"code\":\"-1\",\"msg\":\"城市不能为空\"}";
        }else {
            echo "[{
            \"name\": \"黄岛区婚姻登记处\",
            \"address\": \"黄岛区紫金山路101号\",
           \"work_time\": \"8:30-11:30；13:30-17:30\",
            \"tel\": \"0532-86975312\",
            \"region\":\"黄岛区\"
        },
        {
           \"name\": \"城阳区婚姻登记处\",
            \"address\": \"城阳区山城路202号\",
            \"work_time\": \"周一至周五 8:30-12:00；14:30-17:00 周六9:00-12:00；14:30-16:41\",
            \"tel\": \"0532-86975312\",
            \"region\":\"城阳区\"
        }]";
        }
    }

    public function marry_jiri() {
        $year = $_GET['year'];
        $month = $_GET['month'];
        if(empty($year) || empty($month)) {
            echo "{\"code\":\"-1\",\"msg\":\"查询年月不能为空\"}";
        } else {
            $param = $year . '-' . $month;
            $pdo = new PDO("mysql:host=localhost;port=3304;dbname=calendar",'root','');
            $sql = "select * from Wedding where cur_date = '" . $param . "'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
//            $stmt = $pdo->query($sql);
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($ret);
        }
    }
}
