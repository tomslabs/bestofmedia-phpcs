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

class BestOfMedia_Tests_Encoding_ForbidNonUTF8FunctionUnitTest extends AbstractBestOfMediaSniffUnitTest
{

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
      2 => 0,
      3 => 1,
      4 => 0,
      6 => 1,
      7 => 1,
      8 => 1,
      9 => 1,
      10 => 1,
      11 => 0,
      13 => 1,
      16 => 1,
      17 => 1,
      18 => 1,
      19 => 1,
      20 => 1,
      21 => 1,
      22 => 1,
      23 => 1,
      24 => 1,
      25 => 1,
      26 => 1,
      27 => 1,
      28 => 1,
      29 => 1,
      30 => 1,
      31 => 1,
      32 => 1,
      //
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 0,
      41 => 0,
      42 => 0,
      43 => 0,
      44 => 0,
      45 => 0,
      46 => 0,
      47 => 0,
      48 => 0,
      49 => 0,
      50 => 0,
      51 => 0,
      52 => 0,
      53 => 0,
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
?>
