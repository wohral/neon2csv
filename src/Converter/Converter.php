<?php
/**
 * Created by PhpStorm.
 * User: petrvohralik
 * Date: 08.12.16
 * Time: 14:18
 */

namespace wohral\Neon2Csv;

class Converter
{
	public static function fromCSV($sourceFile, $targetFile)
	{
		$sourceFile = trim($sourceFile);
		$targetFile = trim($targetFile);

		if (!file_exists($sourceFile)) {
			throw new ConverterException("File $sourceFile does not exist.");
		}

		$csvToNeon = new CsvToNeon($sourceFile);
		$csvToNeon->convert($targetFile);

		return $csvToNeon;
	}

	public static function fromNeon($sourceFile, $targetFile)
	{
		$sourceFile = trim($sourceFile);
		$targetFile = trim($targetFile);

		if (!file_exists($sourceFile)) {
			throw new ConverterException("File $sourceFile does not exist.");
		}

		$neonToCsv = new NeonToCsv($sourceFile);
		$neonToCsv->convert($targetFile);

		return $neonToCsv;
	}

	/**
	 * @param string $file
	 * @return bool
	 */
	public static function isNeonFile($file)
	{
		$pathInfo = pathinfo($file);
		return $pathInfo['extension'] == 'neon';
	}

	/**
	 * @param string $file
	 * @return bool
	 */
	public static function isCSVFile($file)
	{
		$pathInfo = pathinfo($file);
		return $pathInfo['extension'] == 'csv';
	}
}

class ConverterException extends \Exception
{

}