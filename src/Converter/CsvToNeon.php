<?php
/**
 * Created by PhpStorm.
 * User: petrvohralik
 * Date: 19.12.16
 * Time: 16:21
 */

namespace wohral\Neon2Csv;

use Nette\Neon\Neon;

class CsvToNeon extends BaseConverter
{
	protected $tmpArray = [];

	public function convert($output)
	{
		$csvArrayContent = $this->prepareCsvToArray();


		$neonEncoded = Neon::encode($csvArrayContent);

		// @TODO how to move Array to neon ?
		// @TODO parse array or does it exist any library

		dump($neonEncoded);

		die();

		$csvArrayContent = $this->prepareArrayToCsv($inputArray);

		if ($fh = fopen($output, 'w+')) {
			foreach ($csvArrayContent as $fields) {
				fputcsv($fh, $fields, $this->getDelimiter());
			}

			fclose($fh);
		}
	}

	private function prepareCsvToArray()
	{
		$array = array_map('str_getcsv', file($this->getSourceFile()));
		array_walk($array, [$this, 'combine_array']);
		return $this->recursiveArrayFromPath();
	}

	public function combine_array(&$row)
	{
		$exploded = explode($this->getDelimiter(), $row[0]);
		$key = $exploded[0];
		unset($exploded[0]);

		$value = implode($this->getColumnsSeparator(), $exploded);

		$this->tmpArray[] = [$key, $value];
	}

	private function recursiveArrayFromPath()
	{
		$array = array();
		foreach ($this->tmpArray as $item) {
			$parts = explode('.', $item[0]);
			$last = array_pop($parts);
			$cursor = &$array;
			foreach ($parts as $part) {
				if (!isset($cursor[$part])) {
					$cursor[$part] = array();
				}
				$cursor = &$cursor[$part];
			}
			$cursor[$last] = $item[1];
		}
		return $array;
	}
}