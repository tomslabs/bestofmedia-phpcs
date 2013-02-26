<?php

class BestOfMedia_Tests_Encoding_ForbidNonUTF8FunctionTest extends AbstractStandardTest {

  /**
   * @group unittest
   */
  public function testSniffer() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Encoding/ForbidNonUTF8FunctionSniff.inc'),
      'BestOfMedia_Sniffs_Encoding_ForbidNonUTF8FunctionSniff',
      array(
      'NonUTF8Function' => 10
      )
    );

    $this->assertPhpCsError($file, 3,  'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 6,  'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 7,  'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 8,  'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 9,  'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 10, 'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 13, 'Use mb equivalent function mb_strlen() instead of strlen()');
    $this->assertPhpCsError($file, 16, 'Use mb equivalent function mb_send_mail() instead of mail()');
    $this->assertPhpCsError($file, 17, 'Use mb equivalent function mb_strpos() instead of strpos()');
    $this->assertPhpCsError($file, 18, 'Use mb equivalent function mb_strrpos() instead of strrpos()');
    $this->assertPhpCsError($file, 19, 'Use mb equivalent function mb_substr() instead of substr()');
    $this->assertPhpCsError($file, 20, 'Use mb equivalent function mb_strtolower() instead of strtolower()');
    $this->assertPhpCsError($file, 21, 'Use mb equivalent function mb_strtoupper() instead of strtoupper()');
    $this->assertPhpCsError($file, 22, 'Use mb equivalent function mb_stripos() instead of stripos()');
    $this->assertPhpCsError($file, 23, 'Use mb equivalent function mb_strripos() instead of strripos()');
    $this->assertPhpCsError($file, 24, 'Use mb equivalent function mb_strstr() instead of strstr()');
    $this->assertPhpCsError($file, 25, 'Use mb equivalent function mb_stristr() instead of stristr()');
    $this->assertPhpCsError($file, 26, 'Use mb equivalent function mb_strrchr() instead of strrchr()');
    $this->assertPhpCsError($file, 27, 'Use mb equivalent function mb_substr_count() instead of substr_count()');
    $this->assertPhpCsError($file, 28, 'Use mb equivalent function mb_ereg() instead of ereg()');
    $this->assertPhpCsError($file, 29, 'Use mb equivalent function mb_eregi() instead of eregi()');
    $this->assertPhpCsError($file, 30, 'Use mb equivalent function mb_ereg_replace() instead of ereg_replace()');
    $this->assertPhpCsError($file, 31, 'Use mb equivalent function mb_eregi_replace() instead of eregi_replace()');
    $this->assertPhpCsError($file, 32, 'Use mb equivalent function mb_split() instead of split()');

    $this->assertCountPhpCsWarning($file, 0);
    $this->assertCountPhpCsError($file, 24);
  }
}