<?php

namespace Api\Repository;

use Database\Contract\DatabaseConnectionInterface;

class UserRepository
{
	private $connection;

	public function __construct(DatabaseConnectionInterface $connection)
	{
		$this->connection = $connection;
	}

	public function insert(array $data)
	{
		$this->connection->beginTransaction();
		$this->connection->insert($data);
		$commit_value = $this->connection->commit();
		return $commit_value;
	}
	
	public function findUser(int $id) {
		$result = $this->connection->findEntity($id);
		return count($result) != 0 ? $result:null;		
	}
}
