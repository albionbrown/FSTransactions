<?php

use PHPUnit\Framework\TestCase;

use \FSTransactions\Action\MoveFile;

class MoveFileTest extends TestCase
{

  private $source;

  private $destination;

  public function setUp() {

    $this->source = __DIR__.'/../test_files/MoveFileTestSource.txt';
    $this->destination = __DIR__.'/../test_files/MoveFileTestDestination.txt';

    // Create a test file at the source 
    fopen($this->source, 'x+');

    $this->assertFileExists($this->source);
  }

  public function tearDown() {
    
    if (file_exists($this->destination)) {
      unlink($this->destination);
    }
    
    if (file_exists($this->source)) {
      unlink($this->source);
    }
  }
  
  /**
   * Test successfully moving a file
   * The file should exists at the destination path
   * The file should not exist at the source path
   */
  function testMoveFileExecuteSuccess() {

    $action = new MoveFile($this->source, $this->destination);
    
    $action->execute();

    $this->assertFileExists($this->destination);
    $this->assertFileNotExists($this->source);
  }

  /**
   * Test rolling back the effects of execute()
   *
   * @return void
   */
  function testMoveFileReverseSuccess() {

    $action = new MoveFile($this->source, $this->destination);
    
    $action->execute();

    $this->assertFileExists($this->destination);
    $this->assertFileNotExists($this->source);

    $action->reverse();

    $this->assertFileExists($this->source);
    $this->assertFileNotExists($this->destination);
  }
}