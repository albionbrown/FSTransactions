<?php

namespace FSTransactions\Action;

abstract class Action
{
  
  /**
   * Executes the action
   */
  public abstract function execute();

  /** 
   * Reverses the effects of execute()
   */
  public abstract function reverse();

  /**
   * Verifies that an object is an instance of
   * \FSTransactions\Action\Action
   */
  public static function isActionInstance($action) {

    return $action instanceof Action ? true : false;
  }
}