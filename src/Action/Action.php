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
}