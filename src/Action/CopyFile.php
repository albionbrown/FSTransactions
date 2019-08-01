<?php

namespace FSTransactions\Action;

use FSTransactions\Action\Action;
use FSTransactions\Exception\TransactionException;
use FSTransactions\Exception\RollbackFailureException;

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

    $path = explode('/', $this->destination);
    $fileName = end($path);
    array_pop($path);
    $path = implode('/', $path);

    // Check if the destination is actually a file
    if (is_file($path)) {
      throw new TransactionException("{$this->destination} is not a directory");
    }

    // Check if the directory is writable
    if (!is_writable($path)) {
      throw new TransactionException("{$this->destination} is not writable");
    }

    // Attempt the move the file
    if (!copy($this->source, $path.'/'.$fileName)) {
      throw new TransactionException("Failed to copy {$this->source} to {$this->destination}");
    }
  }

  /**
   * Delete the copied file
   */
  public function reverse() {

    if (!unlink($this->destination)) {
      throw new RollbackFailureException("Failed to rollback. Could not delete {$this->destination}");
    }
  }
}