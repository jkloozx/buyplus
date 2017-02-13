<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13 0013
 * Time: 14:58
 */
$a = array(
    'main' => array(
        array('url' => '123'),
        array('url1' => '456'),
        array('url2' => '789'),
    )
);
$a1 = array(
//    'main' => array(
//        '1' => array('url' => '123'),
//        'a' => array('url1' => '456'),
//        'b' => array('url2' => '789'),
//    )
1,2,3
);
$a3 = '{
    "people":[
        {"firstName":"Brett","lastName":"McLaughlin","email":"aaaa"},
        {"firstName":"Jason","lastName":"Hunter","email":"bbbb"},
        {"firstName":"Elliotte","lastName":"Harold","email":"cccc"}
    ]
}';
$a3 = '{"main":[{"url":"123"},{"url1":"456"},{"url2":"789"}]}';

$b = [
    'key' => [
        'he' => '123',
        "haha" => 123,
        "123" => 123,
    ]
];
echo json_encode($a);
echo '<br/>';
echo json_encode($a1);
echo '<br/>';
var_dump(json_decode($a3));
var_dump($a['main']);
//{"main":[{"url":"123"},{"url1":"456"},{"url2":"789"}]}
