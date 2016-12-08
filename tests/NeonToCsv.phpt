<?php

/**
 * Test of converting NEON file to CSV
 */

use Tester\Assert;
use wohral\Neon2Csv\Converter;

require __DIR__ . '/bootstrap.php';

$sourceFile = __DIR__ . '/tmp/test.neon';
$outputFile = __DIR__ . '/tmp/output.csv';

// Test if all arguments are filled
Assert::error(function () {
	Converter::fromNeon('file');
}, E_WARNING);


// Test if all arguments are filled
Assert::noError(function () {
	Converter::fromNeon('in', 'out');
});


#Assert::exception(function () use ($sourceFile, $outputFile) {
#	$badFileName = $sourceFile . 'bad';
#	//Converter::fromNeon($badFileName, $outputFile);
#}, 'ConverterException', "File $badFileName does not exist.");

//Converter::fromNeon($sourceFile, $outputFile);


if (file_exists($outputFile)) {
	unlink($outputFile);
}