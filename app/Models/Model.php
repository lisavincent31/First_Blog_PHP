<?php 

namespace App\Models;

use Database\Connection;
use PDO;

abstract class Model {
    protected $db;
    protected $table;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    // get all the entries from a table order by the column updated_at
    public function all(): array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY updated_at DESC");
    }

    // find with an id a specific entry in a table
    public function findById(int $id): Model
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    // create a new entry in the database
    public function create(array $data, ?array $relations = null)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $firstParenthesis = '';
        $secondParenthesis = '';

        $i = 1;
        foreach($data as $key => $value)
        {
            $comma = $i === count($data) ? '' : ', ';
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";

            $i++;
        }

        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis)", $data);
    }

    // general function to create the sql queries
    public function query(string $sql, array $param = null, bool $single = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';

        if(strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0) {

            $statement = $this->db->getPDO()->$method($sql);
            $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

            return $statement->execute($param);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        
        $statement = $this->db->getPDO()->$method($sql);
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if($method === 'query') {
            return $statement->$fetch();
        } else {
            $statement->execute($param);
            return $statement->$fetch();
        }
    }
}