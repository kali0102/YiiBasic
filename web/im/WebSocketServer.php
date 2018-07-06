<?php

/**
 * WebSocket服务类
 * Class WebSocketServer
 */
class WebSocketServer
{
    public $server;
    public $users = [];

    public function __construct()
    {
        $this->server = new Swoole\WebSocket\Server('127.0.0.1', '9502');
        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('message', [$this, 'onMessage']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('task', [$this, 'onTask']);
        $this->server->on('finish', [$this, 'onFinish']);
        $this->setting();
    }

    /**
     * 服务开启
     * @param $server
     * @param $req
     */
    public function onOpen($server, $request)
    {
        echo "connection open: {$request->fd}\n";
        $this->users[$request->fd] = $request->fd;
        //print_r($this->users);
    }

    /**
     * 服务交互
     * @param $server
     * @param $frame
     */
    public function onMessage($server, $frame)
    {
        foreach ($this->users as $u)
            $server->push($u, '用户：' . $frame->fd . ' -- ' . $frame->data);
    }

    /**
     * 服务关闭
     * @param $server
     * @param $fd
     */
    public function onClose($server, $fd)
    {
        echo "connection close: {$fd}\n";
        unset($this->users[$fd]);
        //print_r($this->users);
        $server->task($fd, 0);
    }

    public function onTask($server, $task_id, $from_id, $data)
    {
        echo $data;
        foreach ($this->users as $u)
            $server->push($u, '用户：' . $data . ' -- 退出聊天！');
        $server->finish($data);
    }

    public function onFinish($server, $task_id, $data)
    {

    }

    /**
     * 服务配置
     */
    public function setting()
    {
        $this->server->set([
            'worker_num' => 1,
            'task_worker_num' => 1,
            'task_ipc_mode' => 4,
        ]);
    }

    /**
     * 执行
     */
    public function run()
    {
        $this->server->start();
    }
}

$ws = new WebSocketServer;
$ws->run();