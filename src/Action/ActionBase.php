<?php

namespace FSTransactions\Action;

abstract class ActionBase
{
  
  /**
   * Executes the action
   */
  public abstract function execute();

  /** 
   * Reverses the effects of execute()
   */
  public abstract function reverse();
}