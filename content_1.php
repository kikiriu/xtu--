<?php
require 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $pdo;

    public function __construct() {
        $this->clients = new \SplObjectStorage;

        // 连接到数据库
        $dsn = 'mysql:host=localhost;dbname=tek;charset=utf8';
        $username = 'root';
        $password = '';
        // $this->pdo = new PDO($dsn, $username, $password);

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 添加这个属性，启用异常模式
            error_log("Database connected successfully.");
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
        }
        
    }

    public function onOpen(ConnectionInterface $conn) {
        // 存储连接
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        error_log("Received message: " . print_r($data, true));
        
        // 保存消息到数据库

        if ($data['to_userid'] == 0) {
            $stmt = $this->pdo->prepare("INSERT INTO public_chat (userid, to_userid, content, systime) VALUES (?, ?, ?, NOW())");
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO chat (userid, to_userid, content, systime) VALUES (?, ?, ?, NOW())");
        }
        // $stmt = $this->pdo->prepare("INSERT INTO chat (userid, to_userid, content, systime) VALUES (?, ?, ?, NOW())");
        // $stmt->execute([$data['userid'], $data['to_userid'], $data['content']]);

        try {
            $stmt->execute([$data['userid'], $data['to_userid'], $data['content']]);
            error_log("Message inserted into database successfully.");
            
        } catch (PDOException $e) {
            error_log("Failed to insert message: " . $e->getMessage());
        }

        
        // 广播消息给所有客户端
        foreach ($this->clients as $client) {

            $client->send($msg);
            
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // 移除连接
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // 处理错误
        $conn->close();
    }
}

$server = Ratchet\Server\IoServer::factory(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
?>
