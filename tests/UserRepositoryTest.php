<?php

namespace Tests;

use Mockery as m;
use Api\Repository\UserRepository;
use Database\Contract\DatabaseConnectionInterface;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
	public function tearDown() {
		m::close();
	}

	public function testingInsertSuccess() {
		$connection = m::mock(DatabaseConnectionInterface::class);
		$testArray = array (0,1,1,2,3,5,8);

		$connection->shouldReceive('beginTransaction');
		$connection->shouldReceive('insert')->with($testArray);	
		$connection->shouldReceive('commit')->andReturn(true);

		$user_repository = new UserRepository($connection);

	
		$this->assertTrue($user_repository->insert($testArray));

	}
	
	public function testingInsertFailure() {
		$connection = m::mock(DatabaseConnectionInterface::class);
		$testArray = array (0,1,1,2,3,5,8);

		$connection->shouldReceive('beginTransaction');
		$connection->shouldReceive('insert')->with($testArray);	
		$connection->shouldReceive('commit')->andReturn(false);

		$user_repository = new UserRepository($connection);

		$this->assertFalse($user_repository->insert($testArray));

	}
	
	public function testingFindUserSuccess() {
		$id = 2;
		$connection = m::mock(DatabaseConnectionInterface::class);
		$connection->shouldReceive('findEntity')->with($id)->andReturn(array (1,2,3,4));

		$user_repository = new UserRepository($connection);

		$this->assertNotNull($user_repository->findUser($id));
	}
	
	public function testingFindUserFailure() {
		$id = 2;
		$connection = m::mock(DatabaseConnectionInterface::class);
		$connection->shouldReceive('findEntity')->with($id)->andReturn(null);

		$user_repository = new UserRepository($connection);

		$this->assertNull($user_repository->findUser($id));
	}
}

