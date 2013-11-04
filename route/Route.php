<?php

namespace Route;
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/29/13
 * Time: 4:00 PM
 * To change this template use File | Settings | File Templates.
 */
class Route
{
    private $rule;
    // 匹配模式
    private $pattern;

    private $name;

    private $request_uri;
    /**
     * request parameters
     * @var
     */
    private $params = array();

    // maybe filters
    private $filters = null;

    // request method
    private $method;
    /**
     * target controller's action
     * @var
     */
    private $action;

    public $is_matched = false;

    //target controller
    private $target;

    /**
     * @param $rule /:controller/:action
     * @param $name use to store
     * @param $pattern
     * @param string $method
     * @param null $action
     * @param null $filters
     * @param null $target
     */
    function __construct($rule,$name,$method = "GET",$filters = null,$request_uri = null,$action = null,  $target = null)
    {
        $this->action = $action;
        $this->filters = $filters;
        $this->method = $method;
        $this->request_uri = $request_uri;
        $this->target = $target;
        $this->rule = $rule;
        $this->name = $name;
        $regex = preg_replace_callback('@:[\w]+@', function ($matches){
            return '([a-zA-Z0-9_\+\.\-%]+)';
        }, $rule);
        $regex .= '/?';
        // Store the regex used to match this pattern.
        $this->pattern = '@^' . $regex . '$@';
    }


    public function match() {
        preg_match_all("@:([\w]+)@i",$this->rule,$param_names);

        if(empty($param_names) === false) {
            $param_names = $param_names[0];
            if (preg_match($this->pattern,$this->request_uri,$param_values)) {
                array_shift($param_values);// remove the first all text
                foreach ($param_names as $index => $key) {
                    $this->params[substr($key,1)] = urldecode($param_values[$index]);// set pramater
                }
                $this->is_matched = true;
            }
        }
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setRequestUri($request_uri)
    {
        $this->request_uri = $request_uri;
    }

    public function getRequestUri()
    {
        return $this->request_uri;
    }
    /**
     * @param  $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return
     */
    public function getAction()
    {
        return $this->action;
    }

    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param  $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return
     */
    public function getParams()
    {
        return $this->params;
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setRule($rule)
    {
        $this->rule = $rule;
    }

    public function getRule()
    {
        return $this->rule;
    }


    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->rule;
    }


}
