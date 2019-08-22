<?php
namespace App\Services;

use Aura\SqlQuery\QueryFactory;
use PDO;


class Database{

    private $pdo;
    private $queryFactory;

    public function __construct(pdo $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function selectAll($table, $num=null){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from($table)->limit($num);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectOne($table, $col, $value){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from($table)->where($col.' = :value')->bindValue('value', $value);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function find($table, $col, $value){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from($table)->where($col.' = :value')->bindValue('value', $value);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPaginatedFrom($table, $col, $value, $page=1, $itemsPerPage=1){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from($table)->where($col.' = :value')->bindValue('value', $value)->page($page)->setPaging($itemsPerPage);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function count($table, $col, $value){
        $select = $this->queryFactory->newSelect()->cols(['*'])->from($table)->where($col.' = :value')->bindValue('value', $value);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = count($sth->fetchAll(PDO::FETCH_ASSOC));
        return $result;
    }

    public function update($table, $id, $data){
//        var_dump($table, $id, $data); exit();

        $update=$this->queryFactory->newUpdate()->table($table)->cols($data)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }

    public function insert($table, $cols_values){
        $insert = $this->queryFactory->newInsert()->into($table)->cols($cols_values);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

}



