<?php

class BestOfMedia_Sniffs_DependencyInjection_SingletonSniffTest extends PHPUnit_Framework_TestCase
{
  public function testX() {
    $file = '/home/sites/bestofmedia-phpcs/src/test/resources/PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/DependencyInjection/SingletonUnitTest.inc';

    $phpcs = new PHP_CodeSniffer_Bom();
    $phpcs->cli = $this->getMockBuilder('PHP_CodeSniffer_CLI')
      ->setMethods(array('getCommandLineValues'))
      ->getMock();

    $phpcs->cli->errorSeverity = 10;
    $phpcs->cli->warningSeverity = 5;

    $phpcs->cli->expects($this->any())
      ->method('getCommandLineValues')
      ->will($this->returnValue(array()));

    $phpcs->addListener('BestOfMedia_Sniffs_DependencyInjection_SingletonSniff');
    $phpcs->populateTokenListeners();
    $sniff = new BestOfMedia_Sniffs_DependencyInjection_SingletonSniff();

    $tokenizers =  array('php' => 'PHP', 'inc' => 'PHP', 'js'  => 'JS', 'css' => 'CSS');
    $sniffs = $phpcs->getTokenSniffs();
    $standard = array('BestOfMedia.DependencyInjection.Singleton.NotAllowed' => array(
      'warning' => false,
      'severity' => 10,
    ));
    $phpcsFile = new PHP_CodeSniffer_File($file, $sniffs['file'], $phpcs->allowedFileExtensions, $standard, $phpcs);
    $phpcsFile->start();

    $this->assertCount(count($this->getErrorList()), $phpcsFile->getErrorList());
    var_dump($phpcsFile->getWarnings());
  }

  /**
   * Returns the lines where errors should occur.
   *
   * The key of the array should represent the line number and the value
   * should represent the number of errors that should occur on that line.
   *
   * @return array(int => int)
   */
  public function getErrorList()
  {
    return array(
      19 => 1,
      49 => 1,
      62 => 1,
      64 => 1,
      66 => 1,
      68 => 1,
    );
  }

  /**
   * Returns the lines where warnings should occur.
   *
   * The key of the array should represent the line number and the value
   * should represent the number of warnings that should occur on that line.
   *
   * @return array(int => int)
   */
  public function getWarningList()
  {
    return array(
    );
  }

}