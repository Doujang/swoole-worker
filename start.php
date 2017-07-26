<?php
/**
 * run with command
 * php start.php start
 */

use \Workerman\Worker;
use \Workerman\Lib\Timer;
require_once 'vendor/autoload.php';
$worker = new \Workerman\WebServer('http://127.0.0.1:8090');
$worker->addRoot('127.0.0.1',__DIR__.'/web');
/*$worker->onConnect = function($connect){
  $connect->send('sucess');
};
$worker->onMessage = function($connect,$data){
  $connect->send('123');
};*/

$worker->onWorkerStart = function($worker){
    $timerid = Timer::add(2000,function()use(&$timerid){
       echo $timerid."\n";
    },[1,2,3],false);

};
$worker->count = 1;
$worker = new   Worker('http://127.0.0.1:8091');
$worker->onConnect = function($connect){
/*    var_dump($_SERVER);
  $connect->send('sucess');*/
};
$worker->onMessage = function(\Workerman\Connection\ConnectionInterface $connect,$data){
    var_dump($_SERVER);

     // $connect->send('123');
};

$worker->onWorkerStart = function($worker){
    $timerid = Timer::add(2000,function()use(&$timerid){
        echo $timerid.time()."\n";
    },[1,2,3],false);

};
$worker->reusePort = true;
$worker->count = 1;
Worker::$stdoutFile = '/tmp/oauth.log';
Worker::$logFile = __DIR__.'/workerman.log';
Worker::$pidFile = __DIR__ . "/" . str_replace('/', '_', __FILE__ ). ".pid";
// 运行所有服务
Worker::runAll();
