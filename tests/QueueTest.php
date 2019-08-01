<?php

use PHPUnit\Framework\TestCase;

use FSTransactions\Queue;

use FSTransactions\Action\Action;
use FSTransactions\Action\CopyFile;
use FSTransactions\Action\MoveFile;

use FSTransactions\Transaction;
use FSTransactions\Exception\TransactionException;

class NotAnAction{};

class QueueTest extends TestCase
{

  /**
   * 
   */
  public function testAddToQueue() {

    // Initialise a new queue
    $queue = new Queue;

    // Create a blank Copy transaction
    $copyAction = new CopyFile('', '');
    $queue->addToQueue($copyAction);

    $moveAction = new MoveFile('', '');
    $queue->addToQueue($moveAction);

    $expectedActions = $queue->getQueue();

    $this->assertInstanceOf(Action::class, $expectedActions[0]);
    $this->assertInstanceOf(Action::class, $expectedActions[1]);
  }

  /**
   * Assert that the Queue::addToQueue method throws an
   * \FSTransactions\Exception\TransactionException if an object that
   * doesn't extend \FSTransactions\Action\Action
   */
  public function testAddToQueueFailOnInstance() {

    $this->expectException(TransactionException::class);

    $queue = new Queue;

    $action = new NotAnAction;

    $queue->addToQueue($action);
  }

  public function testClearQueue() {
    
    // Initialise a new queue
    $queue = new Queue;

    // Create a blank Copy transaction
    $copyAction = new CopyFile('', '');
    $queue->addToQueue($copyAction);

    $moveAction = new MoveFile('', '');
    $queue->addToQueue($moveAction);

    $this->assertNotEmpty($queue->getQueue(), "Queue was empty after adding tasks to transactions");

    $queue->clearQueue();

    $this->assertEmpty($queue->getQueue(), "Queue still has tasks after clearing queue");
  }
}
