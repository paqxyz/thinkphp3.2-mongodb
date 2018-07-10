<?php
// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Think\Log\Driver;

use Think\Model\MongodbModel;

class Mongodb {
    protected $config  =   array(
        'log_time_format'   =>  ' c ',
    );

    // 实例化并传入参数
    public function __construct($config=array()){
        $this->config   =   array_merge($this->config,$config);
    }

    /**
     * 日志写入接口
     * @access public
     * @param string $log 日志信息
     * @param string $destination  写入目标
     * @return void
     */
    public function write($log,$destination='') {
        $now = date($this->config['log_time_format']);
        if(empty($destination)){
            $destination = $this->config['log_path'];
        }
        // 获取错误模块
        $log_dir = basename(dirname($destination));

        $message = [
            'time'=>time(),
            'module'=>$log_dir,
            'url'=>$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            'ip'=> $_SERVER['REMOTE_ADDR'],
            'message'=>"{$log}"
        ];

        $errorModel = new php_error_log_model();
        $errorModel->add($message);
    }
}

class php_error_log_model extends MongodbModel {
    protected $connection = 'MONGODB_CONFIG';
    protected $dbName = 'xksdk_db';
    protected $trueTableName = 'php_error_log';
}