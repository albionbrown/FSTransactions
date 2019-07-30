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

    if (file_exists($this->destinationFilePath)) {
      unlink($this->destinationFilePath);
    }
  }

  /** 
   * Test successfuly copying a file
   * The file should exist in the destination
   * and the contents should be the same
   */
  public function testCopyFileExecuteSuccess() {

    $sourceFilePath = __DIR__.'/../test_files/CopyFileTestSource.txt';
    $this->destinationFilePath = __DIR__.'/../test_files/CopyTestTestDestination.txt';

    $action = new Copyfile($sourceFilePath, $this->destinationFilePath);
    $action->execute();

    $this->assertFileExists($this->destinationFilePath);

    $sourceFileContents = file_get_contents($sourceFilePath);
    $destinationFileContents = file_get_contents($this->destinationFilePath);

    $this->assertEquals($sourceFileContents, $destinationFileContents);
  }

  /**
   * Test rolling back copying the file
   * The copied file should be removed
   */
  public function testCopyFileReverseSuccess() {
    
    $sourceFilePath = __DIR__.'/../test_files/CopyFileTestSource.txt';
    $this->destinationFilePath = __DIR__.'/../test_files/CopyTestTestDestination.txt';

    $action = new Copyfile($sourceFilePath, $this->destinationFilePath);
    $action->execute();

    $this->assertFileExists($this->destinationFilePath);

    $action->reverse();

    $this->assertFileNotExists($this->destinationFilePath);
  }
}