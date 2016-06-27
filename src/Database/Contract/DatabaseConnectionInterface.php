<?php

namespace Api\Database\Contract;

interface DatabaseConnectionInterface
{
	function beginTransaction();
	function commit();
	function insert(array $data);
	function findEntity(int $id);
}
