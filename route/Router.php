<?php
namespace Route;
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/29/13
 * Time: 4:13 PM
 * To change this template use File | Settings | File Templates.
 */
include("config.php");
require("Route.php");
require("RouterException.php");
class Router
{

    private $routes = array();

    private $cachedRoutes = array();

    private static $instance = null;

    public $curRoute;

    private $baseURL = '/api';

    /**
     * default request methods
     * @var array
     */
    private $methods = array("GET","POST","PUT","DELETE");

    private function __construct()
    {
        $this->setup();
    }

    public static function getInstance() {
        if(static::$instance == null) {
            static::$instance = new Router();
        }
        return static::$instance;
    }


    /**
     * read all setting files
     */
    private function setup()
    {
        global $configs;
        if (is_array($configs)) {
            foreach ($configs as $troute) {
                $name = $troute["name"];
                if (empty($this->cachedRoutes[$name])) {
                    $method = $troute["method"];
                    $uri = $this->baseURL.$troute["uri"];
                    $target = $troute["target"];
                    $action = $troute["action"];
                    $filters = $troute['filters'];
                    $route = new Route($uri,$name,$method,null,null,$action,$target);
                    array_push($this->routes, $route);
                    $this->cachedRoutes[$name] = $route;
                } else {
                    array_push($this->routes, $this->cachedRoutes[$name]);
                }
            }
        } else {
            throw new RouterException("config variable is not validate", 21);
        }
    }



    /**
     * router start
     */
    public function dispatcher()
    {
        $url_path = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        if(($pos = strpos($url_path,"?")) !== false) {
            $url_path = substr($url_path,0,$pos);
        }
        if($this->matchRout($url_path)) {
            // execute method
            $rmethod = $this->curRoute->getMethod();
            $contentType = getallheaders()['Content-type'];
            if($contentType != 'application/json') {
//                parse_str(file_get_contents("php://input"),$post_vars);
//                print_r($post_vars);
                $datas = json_decode(file_get_contents("php://input"));
//                print_r(get_object_vars($datas));exit;
                if(strcmp($method,$rmethod) == 0) {
                    if(strcmp($method,'GET') == 0) {
                        $str = $_SERVER['QUERY_STRING'];
                        parse_str($str,$attr);
                        $arr = $this->curRoute->getParams();
                        $arr = array_merge($arr,$attr);
                        $this->curRoute->setParams($arr);
                    } elseif (!empty($datas)) {
                        $arr = $this->curRoute->getParams();
                        $arr = array_merge($arr,get_object_vars($datas));
                        $this->curRoute->setParams($arr);
                    }
                    //invoke the specify action
                    $target = $this->curRoute->getTarget();
                    $action = $this->curRoute->getAction();
                    $params = $this->curRoute->getParams();
                    if(!class_exists($target,true)) {
                        throw new \Exception("Class '$target' does not exist.");
                    } else {
                        if(!empty($params)) {
                            $_GET = array_merge($_GET,$this->curRoute->getParams());
                        }
                        $class_instance = new $target();
                        call_user_func_array(array($target,$action),array());
                    }
                } else {
                    print "request method no validate";
                }
            } else {
                print 'Content Type no accepted';
            }
        } else {
            // to 404 page
            print 'Notfound action';
        }
    }

    public function matchRout($url_path) {
        $isMatch = false;
        foreach($this->routes as $rout) {
            $pattern = $rout->getPattern();
            preg_match($pattern,$url_path,$matches);
            if (!empty($matches)) {
                $rout->setRequestUri($url_path);
                $rout->match();
                $this->curRoute = $rout;
                $isMatch = true;
            }
        }
        return $isMatch;
    }
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}
