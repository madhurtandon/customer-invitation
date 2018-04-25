<?php
/**
 * Customer Invitation
 *
 * @package        App
 * @author         Madhur Tandon
 */

namespace App\Library;


/**
 * Reads the data from the local file system and convert it into a array format
 *
 * @package App\Library
 */
class File implements IParser
{
	/** @var string */
	protected $filePath;

	/**
	 * @author Madhur Tandon
	 *
	 * @param string $filePath
	 *
	 * @throws FileNotFound
	 */
	public function __construct(string $filePath)
	{
		$this->SetFilePath($filePath);
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @param string $filePath
	 *
	 * @return self
	 * @throws FileNotFound
	 */
	protected function SetFilePath(string $filePath)
	{
		if (!file_exists($filePath)) {
			throw new FileNotFound;
		}

		$this->filePath = $filePath;

		return $this;
	}

	/**
	 * @author Madhur Tandon
	 *
	 * @return array
	 */
	public function GetData()
	{
		$list = [];

		$contents = file_get_contents($this->filePath); // Read the file
		$convert  = explode("\n", $contents); // Create array separate by new line

		foreach ($convert as $detail) {
			$list[] = json_decode($detail, JSON_OBJECT_AS_ARRAY);
		}

		return $list;
	}
}