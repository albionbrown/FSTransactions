<?php

namespace FSTransactions\Action;

use FSTransactions\Action\Action;

class CopyFile extends Action {

  /**
   * The path of the file to copy
   */
  private $source;

  /**
   * The path to copy the source file to
   */
  private $destination;

  public function __construct(string $source, string $destination) {

    $this->source = $source;
    $this->destination = $destination;
  }

  public function execute() {

    /* @todo check that directories exist and PHP has 
     * permission to write to the destination 
     * @todo Check that source exists */

    if (!copy($this->source, $this->destination)) {
      throw new \FSTransactions\TransactionException("Failed to copy ");
    }
  }

  /**
   * Delete the copied file
   */
  public function reverse() {

    if (!unlink($this->destination)) {
      throw new \FSTransactions\RollbackFailureException("");
    }
  }
}