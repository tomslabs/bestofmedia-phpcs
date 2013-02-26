<?php

class BestOfMedia_Sniffs_DependencyInjection_SingletonSniffTest extends AbstractStandardTest {

  /**
   * @group unittest
   */
  public function testSniffer() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/DependencyInjection/SingletonSniff.inc'),
      'BestOfMedia_Sniffs_DependencyInjection_SingletonSniff',
      array(
      'NotAllowed' => 10
      )
    );

    $this->assertPhpCsError($file, 19, 'You have no reason to call a singleton inside a non-static mymoduleActions::myMethod method. Please inject it as property.');
    $this->assertPhpCsError($file, 49, 'You have no reason to call a singleton inside a non-static myTask::myMethod method. Please inject it as property.');
    $this->assertPhpCsError($file, 62, 'You have no reason to call a singleton inside a non-static anotherClass::myMethod method. Please inject it as property.');
    $this->assertPhpCsError($file, 64, 'You have no reason to call a singleton inside a non-static anotherClass::myMethod method. Please inject it as property.');
    $this->assertPhpCsError($file, 66, 'You have no reason to call a singleton inside a non-static anotherClass::myMethod method. Please inject it as property.');
    $this->assertPhpCsError($file, 68, 'You have no reason to call a singleton inside a non-static anotherClass::myMethod method. Please inject it as property.');
    $this->assertCountPhpCsWarning($file, 0);
    $this->assertCountPhpCsError($file, 6);
  }
}