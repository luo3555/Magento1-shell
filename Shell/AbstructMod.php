<?php
/**
 * Module abstruct class
 * 
 * After we need add Transaction
 *
 * @package tools/magento-shell
 * @author Daniel.luo <daniel.luo@silksoftware.com>
 */
namespace Shell;

class AbstructMod extends Object
{
    protected $_prepare;

    public function init($pdo)
    {
        if ($pdo instanceof \PDO) {
            $this->_pdo = $pdo;
        } else {
            $this->error('Please init first', 10002);
        }

        return $this->_pdo;
    }


    /**
     * Get POD Object
     * 
     * @throws \Exception Can not get POD, Please init first 10003
     * @return Object PDO
     */
    protected function getPDO()
    {
        if ($this->_pdo instanceof \PDO) {
            return $this->_pdo;
        } else {
            $this->error('Can not get POD, Please init first', 10003);
        }
    }


    /**
     * execute
     *
     * @param $sql string
     * @param $data array
     * @return void
     */
    protected function execute($sql, $data)
    {
        $this->_prepare = $this->getPDO()->prepare($sql);
        $this->_prepare->execute($data);
        return $this->_prepare;
    }


    /**
     * insert
     *
     * @param $sql string
     * @param $data array
     * @return false | last insert id
     */
    public function insert($sql, $data)
    {
        $this->execute($sql, $data);
        return $this->getPDO()->lastInsertId();
    }


    /**
     * insert
     *
     * @param $sql string
     * @param $data array
     * @return array
     */
    public function select($sql, $data)
    {
        $this->execute($sql, $data);
        return $this->_prepare->fetchAll(\PDO::FETCH_CLASS);
    }


    /**
     * count
     *
     * @param $sql string
     * @param $data array
     * @return array
     */
    public function count($sql, $data)
    {
        $this->execute($sql, $data);
        return $this->_prepare->rowCount();
    }


    /**
     * Is unique
     *
     * @param $sql string
     * @param $data array
     * @return int
     */
    protected function isUnique($sql, $data)
    {
        return $this->count($sql, $data);
    }


    /**
     * Throw error
     * 
     * @param $msg string Error message
     * @param $code init    Error code
     * @throws \Exception
     */
    protected function error($msg, $code)
    {
        throw new \Exception($msg, $code);
    }
}