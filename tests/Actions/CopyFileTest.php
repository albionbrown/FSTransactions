<?php

use PHPUnit\Framework\TestCase;

use \FSTransactions\Action\CopyFile;
use \FSTransactions\Exception\TransactionException;

class CopyFileTest extends TestCase
{

  private $source;

  private $destination;

  public function setUp() {

    $this->source = __DIR__.'/../test_files/CopyFileTestSource.txt';
    $this->destination = __DIR__.'/../test_files/CopyFileTestDestination.txt';

    // Create a test file
    fopen($this->source, 'x+');
  }

  public function tearDown() {

    if (file_exists($this->source)) {
      unlink($this->source);
    }

    if (file_exists($this->destination)) {
      unlink($this->destination);
    }
  }

  /** 
   * Test successfuly copying a file
   * The file should exist in the destination
   * and the contents should be the same
   */
  public function testCopyFileExecuteSuccess() {

    $action = new Copyfile($this->source, $this->destination);
    $action->execute();

    $this->assertFileExists($this->destination);

    $sourceFileContents = file_get_contents($this->source);
    $destinationFileContents = file_get_contents($this->destination);

    $this->assertEquals($sourceFileContents, $destinationFileContents);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  function testCopyFileExecuteFail() {
    
    $this->expectException(TransactionException::class);

    $action = new Copyfile($this->source, str_replace('test_files', 'non_existent_directory', $this->destination));
    $action->execute();
  }

  /**
   * Test rolling back copying the file
   * The copied file should be removed
   */
  public function testCopyFileReverseSuccess() {

    $action = new Copyfile($this->source, $this->destination);
    $action->execute();

    $this->assertFileExists($this->destination);

    $action->reverse();

    $this->assertFileNotExists($this->destination);
  }
}