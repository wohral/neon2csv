<?php
/**
 * Created by PhpStorm.
 * User: petrvohralik
 * Date: 19.12.16
 * Time: 16:32
 */

namespace wohral\Neon2Csv;

abstract class BaseConverter
{

	protected $sourceFile;

	/**
	 * @var string
	 */
	protected $input = null;

	/**
	 * @var string
	 */
	protected $keysSeparator;

	/**
	 * @var string
	 */
	protected $columnsSeparator;

	/**
	 * @var string
	 */
	protected $delimiter;

	/**
	 * BaseConverter constructor.
	 * @param string $sourceFile path to source file
	 * @param string $keysSeparator
	 * @param string $columnsSeparator
	 * @param string $delimiter
	 */
	public function __construct($sourceFile, $keysSeparator = '.', $columnsSeparator = '|', $delimiter = ";")
	{
		$this->sourceFile = $sourceFile;

		$this->keysSeparator = $keysSeparator;

		$this->columnsSeparator = $columnsSeparator;

		$this->delimiter = $delimiter;
	}

	protected abstract function convert($output);

	/**
	 * @return mixed
	 */
	public function getSourceFile()
	{
		return $this->sourceFile;
	}

	/**
	 * @param mixed $sourceFile
	 * @return BaseConverter
	 */
	public function setSourceFile($sourceFile)
	{
		$this->sourceFile = trim($sourceFile);
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getInput()
	{
		if ($this->input === null) {
			$this->input = file_get_contents($this->getSourceFile());
		}

		return $this->input;
	}

	/**
	 * @param mixed $input
	 * @return BaseConverter
	 */
	public function setInput($input)
	{
		$this->input = trim($input);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getKeysSeparator()
	{
		return $this->keysSeparator;
	}

	/**
	 * @param string $keysSeparator
	 * @return BaseConverter
	 */
	public function setKeysSeparator($keysSeparator)
	{
		$this->keysSeparator = trim($keysSeparator);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getColumnsSeparator()
	{
		return $this->columnsSeparator;
	}

	/**
	 * @param string $columnsSeparator
	 * @return BaseConverter
	 */
	public function setColumnsSeparator($columnsSeparator)
	{
		$this->columnsSeparator = trim($columnsSeparator);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDelimiter()
	{
		return $this->delimiter;
	}

	/**
	 * @param string $delimiter
	 * @return BaseConverter
	 */
	public function setDelimiter($delimiter)
	{
		$this->delimiter = trim($delimiter);
		return $this;
	}
}