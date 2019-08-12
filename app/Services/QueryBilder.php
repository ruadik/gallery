<?php
namespace App\Services;

use Aura\SqlQuery\QueryFactory;
use PDO;


class QueryBilder{

    private $pdo;
    private $queryFactory;

    public function __construct(pdo $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function selectAll($table, $num){
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

    public function insert($table, $cols_values){
        $insert = $this->queryFactory->newInsert()->into($table)->cols($cols_values);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

}



