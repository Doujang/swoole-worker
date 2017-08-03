<?php
/**
 * run with command
 * php start.php start
 */

use \Workerman\Worker;
use \Workerman\Lib\Timer;
require_once '../Autoloader.php';
$worker = new Worker();


$worker->onWorkerStart = function (Worker $worker) {
   $timerid = Timer::add(2,function()use(&$timerid){
        echo $timerid."\n";
    },[1,2,3],true);

};
$worker->count = 1;
Worker::$stdoutFile = '/tmp/oauth.log';
Worker::$logFile = __DIR__ . '/workerman.log';
Worker::$pidFile = __DIR__ . "/" . str_replace('/', '_', __FILE__) . ".pid";
// 运行所有服务
Worker::runAll();