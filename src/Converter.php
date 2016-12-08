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

	public static function fromCSV($sourceFile, $targetFile){




	}

	public static function fromNeon($sourceFile, $targetFile)
	{
		$sourceFile = trim($sourceFile);
		$targetFile = trim($targetFile);


		if(!file_exists($sourceFile)){
			throw new ConverterException("File $sourceFile does not exist.");
		}
	}
}

class ConverterException extends \Exception
{

}