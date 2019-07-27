<?php

namespace FSTransactions;

/**
 * 
 */
class Queue
{
  
  private $actionsQueue = [];

  /**
   * Adds an action to the queue
   * 
   * @param FSTransactions\ActionBase $action
   * @return void
   */
  public function addToQueue($action) {
    
    $this->actionsQueue[] = $action;
  }

  /**
   * Returns an array of all actions in the transaction queue
   * 
   * @return array
   */
  public function getQueue() {

    return $this->actionsQueue;
  }

  /**
   * Clear the whole queue of actions
   * 
   * @return void
   */
  public function clearQueue() {
    
    $this->actionsQueue = [];
  }
}