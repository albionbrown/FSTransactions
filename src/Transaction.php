<?php 

namespace FSTransactions;

/**
 * Controlling class
 */
class Transaction
{

  private $queue;

  /**
   * 
   */
  public function __construct() {

    // Initialise the transaction queue
    $this->queue = new \FSTransactions\Queue;
  }

  /**
   * Add an action to the transaction queue
   * 
   * @param FSTransaction\ActionBase $action The action to be performed during the transaction
   */
  public function addAction(FSTransaction\ActionBase $action) {

    $this->queue->addToQueue($action);
  }

  public function commit() {
 
  }
  
  public function rollback() {

  }
}