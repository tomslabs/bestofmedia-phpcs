<?php

abstract class AbstractStandardTest extends PHPUnit_Framework_TestCase {

  const SEVERITY_ERROR = 10;
  const SEVERITY_WARNING = 5;
  const ITEM_WARNING = 'warning';
  const ITEM_ERROR = 'error';

  protected function mockPhpCodeSnifferCli() {
    $cli = $this->getMockBuilder('PHP_CodeSniffer_CLI')
      ->setMethods(array('getCommandLineValues'))
      ->getMock();

    $cli->expects($this->any())
      ->method('getCommandLineValues')
      ->will($this->returnValue(array()));

    $cli->errorSeverity = self::SEVERITY_ERROR;
    $cli->warningSeverity = self::SEVERITY_WARNING;

    return $cli;
  }

  protected function getRuleFromClassName($classname, $property) {
    $matches = array();
    if (!preg_match('#(?<standard>\w+)_Sniffs_(?<group>\w+)_(?<sniff>\w+)Sniff#', $classname, $matches)) {
      throw new Exception;
    }

    return "{$matches['standard']}.{$matches['group']}.{$matches['sniff']}.{$property}";
  }

  protected function getParsedCodeSnifferFile($file, $snifferClass, array $standardConfiguration) {
    $phpcs = new PHP_CodeSniffer_Bom();
    $phpcs->cli = $this->mockPhpCodeSnifferCli();
    $phpcs->addListener($snifferClass);
    $phpcs->populateTokenListeners();

    $sniffs = $phpcs->getTokenSniffs();

    $standard = array();
    foreach ($standardConfiguration as $property => $severity) {
      $standard[$this->getRuleFromClassName($snifferClass, $property)] = array(
        'severity' => $severity
      );
    }

    $phpcsFile = new PHP_CodeSniffer_File(
      $file,
      $sniffs['file'],
      $phpcs->allowedFileExtensions,
      $standard,
      $phpcs
    );
    $phpcsFile->start();

    return $phpcsFile;
  }

  protected function assertCountPhpCsError(PHP_CodeSniffer_File $file, $count) {
    $this->assertEquals($count, $file->getErrorCount(), "Expected $count PHPCS errors but found {$file->getErrorCount()} in {$file->getFilename()}");
  }

  protected function assertCountPhpCsWarning(PHP_CodeSniffer_File $file, $count) {
    $this->assertEquals($count, $file->getWarningCount(), "Expected $count PHPCS errors but found {$file->getWarningCount()} in {$file->getFilename()}");
  }


  protected function getResourceFilePath($path) {
    $resourcePath = realpath(dirname(__FILE__).'/../../../../resources/'.$path);
    if(!file_exists($resourcePath)) {
      throw new Exception("Failed to find resource file $path.");
    }
    return $resourcePath;
  }

  protected function assertPhpCsError(PHP_CodeSniffer_File $file, $line, $message = null) {
    $this->assertItemInList($file, self::ITEM_ERROR, $line, $message);
  }

  protected function assertPhpCsWarning(PHP_CodeSniffer_File $file, $line, $message = null) {
    $this->assertItemInList($file, self::ITEM_WARNING, $line, $message);
  }

  private function assertItemInList(PHP_CodeSniffer_File $file, $type, $line, $message = null) {
    if($type == self::ITEM_WARNING) {
      $items = $file->getWarnings();
    } else {
      $items = $file->getErrors();
    }


    $this->assertArrayHasKey($line, $items, "Expected a $type at line $line in {$file->getFilename()}");

    if(!$message) {
      return;
    }

    $found = array();
    foreach($items[$line] as $column => $errorsAtPos) {
      foreach($errorsAtPos as $error) {
        $found[] = $error['message'];
        if(isset($error['message']) && $message == $error['message']) {
          return;
        }
      }
    }

    $found = implode('  * ', $found);
    $this->fail(<<<EOF
Expected a $type at line $line with message '$message' in {$file->getFilename()}

Found:
  * $found
EOF
  );
  }
}