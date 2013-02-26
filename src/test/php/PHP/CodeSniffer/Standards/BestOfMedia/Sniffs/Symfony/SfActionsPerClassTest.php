<?php
/**
 * Unit test class for the ActionsPerClass sniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer_Standards_BestOfMedia
 * @author    Guillaume Boddaert <gboddaert@bestofmedia.com>
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License
 * @link      http://tomslabs.github.com/pear/
 */

/**
 * Unit test class for the ActionsPerClass sniff.
 *
 * A sniff unit test checks a .inc file for expected violations of a single
 * coding standard. Expected errors and warnings are stored in this class.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer_Standards_BestOfMedia
 * @author    Guillaume Boddaert <gboddaert@bestofmedia.com>
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License
 * @link      http://tomslabs.github.com/pear/
 */
class BestOfMedia_Tests_Symfony_SfActionsPerClassTest extends AbstractStandardTest {

  /**
   * @group unittest
   */
  public function testSniffer_1() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsPerClassSniff.1.inc'),
      'BestOfMedia_Sniffs_Symfony_SfActionsPerClassSniff',
      array(
        'TooMany' => 10,
        'Messy' => 10,
      )
    );

    $this->assertPhpCsWarning($file, 2,  'There are a lot of executeXXX method in mymoduleActions class. Consider lowering them from 11 below 10.');

    $this->assertCountPhpCsWarning($file, 1);
    $this->assertCountPhpCsError($file, 0);
  }

  /**
   * @group unittest
   */
  public function testSniffer_2() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsPerClassSniff.2.inc'),
      'BestOfMedia_Sniffs_Symfony_SfActionsPerClassSniff',
      array(
        'TooMany' => 10,
        'Messy' => 10,
      )
    );

    $this->assertPhpCsError($file, 2,  'There are too many executeXXX method in mymoduleActions class. You should now split the sfActions method to lower execute methods from 21 below 20.');

    $this->assertCountPhpCsWarning($file, 0);
    $this->assertCountPhpCsError($file, 1);
  }

  /**
   * @group unittest
   */
  public function testSniffer_3() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsPerClassSniff.3.inc'),
      'BestOfMedia_Sniffs_Symfony_SfActionsPerClassSniff',
      array(
        'TooMany' => 10,
        'Messy' => 10,
      )
    );

    $this->assertCountPhpCsWarning($file, 0);
    $this->assertCountPhpCsError($file, 0);
  }
}