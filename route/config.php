<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/29/13
 * Time: 3:44 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Route;

// routes add into
$configs = array(
    array(
        "uri" => "/",
        "target"=>"HomeAction",
        "action" => "index",
        "method" => "GET",
        "name" => "home",
        "filters" => array()
    ),

    // 2
    array(
        "uri" => "/user/:id",
        "target" => "UserAction",
        "action" => "get_user",
        "method" => "DELETE",
        "name" => "user",
        "filters" => array()
    ),
// 3
    array(
        "uri" => "/user",
        "target" => "UserAction",
        "action" => "get_users",
        "method" => "GET",
        "name" => "users",
        "filters" => array()
    ),
    array(
        'uri'=>"/user/:id/edit",
        'target'=>'SpecifyController',
        'action'=>'edit_user',
        'method'=>'POST',
        'name'=>'u_edit',
    ),
    array(
        'uri'=>"/short/:url",
        'target'=>'ShortAction',
        'action'=>'short_url',
        'method'=>'GET',
        'name'=>'short_url',
    ),
    //app recommend
     array(
         'uri'=>"/apps/:platform",
         'target'=>'UserAction',
         'action'=>'recommend_app',
         'method'=>'GET',
         'name'=>'recommend_app',
     ),
    array(
        'uri'=>"/apps/:platform/:page",
        'target'=>'UserAction',
        'action'=>'recommend_app',
        'method'=>'GET',
        'name'=>'recommend_app_page',
    ),
    array(
        'uri'=>"/apps",
        'target'=>'UserAction',
        'action'=>'recommend_app',
        'method'=>'GET',
        'name'=>'recommend',
    ),
    //marray registry
    array(
        'uri'=>"/dengji/:city",
        'target'=>'UserAction',
        'action'=>'marry_registry',
        'method'=>'GET',
        'name'=>'marry_registry',
    ),
    array(
        'uri'=>"/dengji",
        'target'=>'UserAction',
        'action'=>'marry_registry',
        'method'=>'GET',
        'name'=>'marry',
    ),
    //黄道吉日
    array(
        'uri'=>"/jiri/:year/:month",
        'target'=>'UserAction',
        'action'=>'marry_jiri',
        'method'=>'GET',
        'name'=>'marry_jiri',
    ),
    array(
        'uri'=>"/jiri",
        'target'=>'UserAction',
        'action'=>'marry_jiri',
        'method'=>'GET',
        'name'=>'marry_jiri_param',
    )
);