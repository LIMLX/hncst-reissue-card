<?php
/**
 * 类的介绍：PDOManager类。通过单例模式实现创建PDO对象的功能。
 * 类的详细介绍（可选）：连接需要的参数一次性封装在成员变量$params中，创建连接对象时不用再传递参数。
 * 单例模式下通过getInstance()方法获得对象实例。构造方法设置为私有、禁止克隆，由static的成员变量$instance和getInstance()
 * 方法保持实例对象。
 * @author    马杰
 * @editor    马杰
 * @version   V0.1.0
 * @team TurboSnail
 */

class PDOManager
{
    private $params = [
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'root',
        'password' => 'turbo_turbo',
        'database' => 'hncst-reissue-card'
    ];
    private static $instance;    // 单例模式实现，static
    private $db;                 // 保存PDO实例对象

    /**
     * （1）构造方法设置成私有
     */
    private function __construct()
    {
        $host = $this->params['host'];
        $port = $this->params['port'];
        $username = $this->params['username'];
        $password = $this->params['password'];
        $database = $this->params['database'];
        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8";
        try {
            // 实例化PDO
            $this->db = new PDO($dsn, $username, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (PDOException $e) {
            exit('数据库连接失败');
        }
    }

    /**
     * 获得单例对象
     * @return object 单例对象
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance; //返回实例对象
    }

    /**
     * （2）私有克隆。空方法体，防止克隆。
     * @return null
     */
    private function __clone()
    {
    }

    /**
     * 获取PDO实例对象
     * @return object  PDO实例对象
     */
    public function getDB()
    {
        return $this->db;
    }

}

