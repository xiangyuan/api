<?php
/**
 * Created by JetBrains PhpStorm.
 *    1)将长网址md5生成32位签名串,分为4段, 每段8个字节;
 *    2)对这四段循环处理, 取8个字节, 将他看成16进制串与0x3fffffff(30位1)与操作, 即超过30位的忽略处理;
 *    3)这30位分成6段, 每5位的数字作为字母表的索引取得特定字符, 依次进行获得6位字符串;
 *    4)总的md5串可以获得4个6位串; 取里面的任意一个就可作为这个长url的短url地址;
 * User: liyajie1209
 * Date: 11/4/13
 * Time: 1:28 PM
 * To change this template use File | Settings | File Templates.
 */
class ShortAction
{

    //bcdefghjkmnpqrstuvwxyz0123456789
    static $base32 = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5');

    static $base62 = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5','6','7','8','9'
    );

    /**
     * @param $origin_url
     */
    public function short_url()
    {

        $origin_url = $_GET['url'];
        $md5Hex = md5($origin_url);
        $len = strlen($md5Hex);
        $subLen = $len / 8;

        $result = array();
        for ($i = 0; $i < $subLen; $i++) {
            $subHex = substr($md5Hex, $i * 8, 8);
            //30们字符串
            $paramHex = 0x30ffffff & (1 * ('0x' . $subHex));
            $value = '';
            for ($j = 0; $j < 6; $j++) {
//                $key = 0x0000001F & $paramHex;
//                $value .= static::$base32[$key];
                $key = 0x0000003D & $paramHex;
                $value .= static::$base62[$key];
                $paramHex = $paramHex >> 5;
            }
            $result[] = $value;
        }
        print_r($result);
        return $result;
    }

}
