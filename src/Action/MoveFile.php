<?php

namespace FSTransactions\Action;

use \FSTransactions\Action\Action;

class MoveFile extends Action 
{

  /**
   * The path of the file to copy
   */
  private $source;

  /**
   * The path to copy the source file to
   */
  private $destination;

  public function __construct($source, $destination) {

  }

  public function execute() {

  }

  public function reverse() {
    
  }
}