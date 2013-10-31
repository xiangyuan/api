<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/30/13
 * Time: 5:08 PM
 * To change this template use File | Settings | File Templates.
 */
class HomeAction
{

    public function Index() {
        try {
            $pdo = new PDO("mysql:host=localhost;port=3304;dbname=foodie",'root','');
            $stmt = $pdo->query("select * from city_code");
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($ret);
        }catch (PDOException $e) {
            print $e->getMessage();
        }
        echo "home index worked";
    }
}
