<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Test;


use App\Library\Parser\File;
use App\Library\Test\TestCase;

/**
 * @package App\Test
 */
class FileTest extends TestCase
{
	/**
	 * @author Madhur Tandon
	 * @expectedException \App\Library\Exception\FileNotFound
	 */
	public function testFileNotFoundException()
	{
		$filePath = DIR_PREFIX . DIRECTORY_SEPARATOR . 'customer.txt';

		(new File($filePath))->GetData();
	}

	/**
	 * @author Madhur Tandon
	 */
	public function testGetContent()
	{
		$filePath = '.' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'customer.txt';
		
		$this->assertTrue(count((new File($filePath))->GetData()) > 1);
	}
}
