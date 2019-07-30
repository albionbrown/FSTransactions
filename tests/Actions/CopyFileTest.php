<?php

use PHPUnit\Framework\TestCase;

use \FSTransactions\Action\CopyFile;

class CopyFileTest extends TestCase
{


  private $destinationFilePath;

  public function setUp() {

    // Ensure source file exists
  }

  public function tearDown() {

    unlink($this->destinationFilePath);
  }

  public function testCopyFileExecuteSuccess() {

    $sourceFilePath = __DIR__.'/../test_files/CopyFileTestSource.txt';
    $this->destinationFilePath = __DIR__.'/../test_files/CopyTestDestination.txt';

    $action = new Copyfile($sourceFilePath, $this->destinationFilePath);
    $action->execute();

    $this->assertFileExists($this->destinationFilePath);

    $sourceFileContents = file_get_contents($sourceFilePath);
    $destinationFileContents = file_get_contents($this->destinationFilePath);

    $this->assertEquals($sourceFileContents, $destinationFileContents);
  }

  public function testCopyFileReverseSuccess() {
    
  }
}