<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 3:10 PM
 */

namespace Src;


class Database
{
    /**
     * @var string
     */
    private $_dbUser;

    /**
     * @var string
     */
    private $_dbPassword;

    /**
     * @var string
     */
    private $_dbHost;

    /**
     * @var string
     */
    protected $_dbName;

    /**
     * @var \PDO
     */
    private $_connection;

    /**
     * @var
     */
    private static $_instance;

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->_dbUser;
    }

    /**
     * @param string $dbUser
     * @return Database
     */
    public function setDbUser($dbUser)
    {
        $this->_dbUser = $dbUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->_dbPassword;
    }

    /**
     * @param string $dbPassword
     * @return Database
     */
    public function setDbPassword($dbPassword)
    {
        $this->_dbPassword = $dbPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->_dbHost;
    }

    /**
     * @param string $dbHost
     * @return Database
     */
    public function setDbHost($dbHost)
    {
        $this->_dbHost = $dbHost;
        return $this;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->_dbName;
    }

    /**
     * @param string $dbName
     * @return Database
     */
    public function setDbName($dbName)
    {
        $this->_dbName = $dbName;
        return $this;
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param \PDO $connection
     * @return Database
     */
    public function setConnection($connection)
    {
        $this->_connection = $connection;
        return $this;
    }



    /**
     *
     */
    private function __construct()
    {
       try {
		   $this->setDbHost(getenv("db_host"));
		   $this->setDbUser(getenv("db_user"));
		   $this->setDbPassword(getenv("db_password"));
		   $this->setDbName(getenv("db_database"));


           $this->setConnection(new \PDO('mysql:host='.$this->getDbHost().'; dbname='.$this->getDbName(), $this->getDbUser(), $this->getDbPassword()));
           $this->getConnection()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
           $this->getConnection()->exec("SET CHARACTER SET utf8");
       }
       catch (\PDOException $e)
       {
           print "Error!: " . $e->getMessage();
           die();
       }
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public function prepare($sql)
    {
        return $this->getConnection()->prepare($sql);
    }

    /**
     * @return mixed
     */
    public static function instance()
    {
        if (!isset(self::$_instance))
        {
            $class = __CLASS__;
            self::$_instance = new $class;
        }
        return self::$_instance;
    }

    /**
     *
     */
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

    /**
     * @return string
     */
    public function lastInsertId(){
        return $this->_connection->lastInsertId();
    }
}
