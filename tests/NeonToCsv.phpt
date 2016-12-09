<?php

/**
 * Test of converting NEON file to CSV
 */

use Tester\Assert;
use wohral\Neon2Csv\Converter;

require __DIR__ . '/bootstrap.php';

$sourceFile = __DIR__ . '/tmp/test.neon';
$outputFile = __DIR__ . '/tmp/output.csv';

// Test Exception on non exist source File
Assert::exception(function () use ($sourceFile, $outputFile) {
	Converter::fromNeon($sourceFile . 'bad', $outputFile);
}, 'wohral\Neon2Csv\ConverterException', "File ". $sourceFile . "bad" . " does not exist.");


// Test file format
Assert::same(true, Converter::isNeonFile('file.neon'));
Assert::same(false, Converter::isNeonFile('file.exe'));

// Test file format
Assert::same(true, Converter::isCSVFile('file.csv'));
Assert::same(false, Converter::isCSVFile('file.exe'));


if (file_exists($outputFile)) {
	unlink($outputFile);
}