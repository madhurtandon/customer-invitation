<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Test;


use App\Library\User;
use App\Library\Test\TestCase;

/**
 * @package App\Test
 */
class UserTest extends TestCase
{
	/**
	 * @author Madhur Tandon
	 * @expectedException \App\Library\Exception\InvalidArgument
	 */
	public function testGetUsersWithEmptyData()
	{
		(new User())->GetUsers([]);
	}

	/**
	 * @author Madhur Tandon
	 * @expectedException \App\Library\Exception\InvalidData
	 */
	public function testGetUsersWithInvalidDataFormat()
	{
		(new User())->GetUsers([1 => [User::NAME => rand()]]);
		(new User())->GetUsers([[User::NAME => rand()]]);
	}

	/**
	 * @author Madhur Tandon
	 */
	public function testGetUsers()
	{
		$users = (new User())->GetUsers([[User::NAME      => rand(),
										  User::LATITUDE  => rand(),
										  User::LONGITUDE => rand(),
										  User::USER_ID   => rand()]]);

		$this->assertNotEmpty($users);
	}
}
