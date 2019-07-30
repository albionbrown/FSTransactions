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

    $this->source = $source;
    $this->destination = $destination;
  }

  public function execute() {

    if (!rename($this->source, $this->destination)) {
      throw new \FSTransactions\TransactionException("Failed to move {$this->source} to {$this->destination}");
    }
  }

  public function reverse() {
    
    if (!rename($this->destination, $this->source)) {
      throw new \FSTransactions\RollbackFailureException("Failed to rollback. Could not move {$this->destination} to {$this->source}");
    }
  }
}