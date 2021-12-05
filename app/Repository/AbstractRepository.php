<?php

namespace App\Repository;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;

class AbstractRepository
{
    protected Builder $query;
    protected string $table = '';

    public function __construct(protected Connection $db)
    {
        $this->query = $this->db->table($this->table);
    }

}
