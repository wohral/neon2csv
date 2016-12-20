<?php
/**
 * Created by PhpStorm.
 * User: petrvohralik
 * Date: 19.12.16
 * Time: 16:21
 */

namespace wohral\Neon2Csv;

use Nette\Neon\Neon;

class NeonToCsv extends BaseConverter
{
	/**
	 * @var array
	 */
	private $recursiveKeys = array();

	public function convert($output)
	{
		$inputArray = Neon::decode($this->getInput());

		$csvArrayContent = $this->prepareArrayToCsv($inputArray);

		if ($fh = fopen($output, 'w+')) {
			foreach ($csvArrayContent as $fields){
				fputcsv($fh, $fields, $this->getDelimiter());
			}

			fclose($fh);
		}
	}

	/**
	 * Returns array of indexes
	 * @param array $array
	 * @param array $path
	 * @return array
	 */
	private function recursiveKeys(array $array, array $path = array())
	{
		$result = array();
		foreach ($array as $key => $val) {
			$currentPath = array_merge($path, array($key));
			if (is_array($val)) {
				$result = array_merge($result, $this->recursiveKeys($val, $currentPath));
			} else {
				$result[] = join($this->getKeysSeparator(), $currentPath);
			}
		}

		$this->recursiveKeys = $result;

		return $this->recursiveKeys;
	}

	/**
	 * Returns a
	 * @param $array
	 * @param $pathArray
	 * @return mixed
	 */
	private function getValueByPath(array $array, array $pathArray)
	{
		$value = $array;
		$i = 0;
		while (is_array($value)) {
			$value = $value[$pathArray[$i]];
			$i++;
		}

		return $value;
	}

	/**
	 * @param array $array
	 * @return array
	 */
	private function prepareArrayToCsv(array $array)
	{
		$keys = $this->recursiveKeys($array);

		$result = array();

		foreach ($keys as $key) {
			$subkey = explode($this->getKeysSeparator(), $key);
			$value = $this->getValueByPath($array, $subkey);

			$tmp = [];
			array_push($tmp, $key);
			$result[] = array_merge($tmp, explode($this->getColumnsSeparator(), $value));
		}

		return $result;
	}
}