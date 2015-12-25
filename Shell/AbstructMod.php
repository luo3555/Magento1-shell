<?php
/**
 * Module abstruct class
 * 
 * After we need add Transaction
 *
 * @package tools/magento-shell
 * @author Daniel.luo <daniel.luo@silksoftware.com>
 */
namespace Base;

class AbstructMod extends Object
{

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
     * @return false | last insert id
     */
    protected function execute($sql, $data)
    {
        $prepare = $this->getPDO()->prepare($sql);
        $prepare->execute($data);
        return $this->getPDO()->lastInsertId();
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
        $prepare = $this->getPDO()->prepare($sql);
        $prepare->execute($data);
        return $prepare->rowCount();
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