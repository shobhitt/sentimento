<?php

	include 'C:\wamp\www\Classes\PHPExcel\IOFactory.php';
    
    $inputFileName = 'c://hello.xls';

	/**  Identify the type of $inputFileName  **/
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	/**  Create a new Reader of the type that has been identified  **/
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	/**  Load $inputFileName to a PHPExcel Object  **/
	$objPHPExcel = $objReader->load($inputFileName);
	
	var_dump($objPHPExcel)
    
?>