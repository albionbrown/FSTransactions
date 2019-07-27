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
   * Rollback the transaction incase the object instance
   * is destroyed before the transaction could be completed
   */
  public function __destruct() {

    $this->rollback();
  }

  /**
   * Add an action to the transaction queue
   * 
   * @param FSTransaction\ActionBase $action The action to be performed during the transaction
   */
  public function addAction($action) {
    
    $this->queue->addToQueue($action);
  }

  /** 
   * Execute all actions in the transaction queue
   * 
   * @return void
   */
  public function commit() {
    
    foreach ($this->queue->getQueue() as $action) {

      $action->execute();
    }
  }

  public function rollback() {

  }
}