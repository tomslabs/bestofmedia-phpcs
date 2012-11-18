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
class BestOfMedia_Tests_Symfony_SfActionsPerClassUnitTest extends AbstractBestOfMediaSniffUnitTest
{


    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array(int => int)
     */
    public function getErrorList($testFile='') {
        switch ($testFile) {
        case 'ActionsPerClassUnitTest.1.inc':
        case 'ActionsPerClassUnitTest.3.inc':
          return array(
                2  => 0,
               );

        case 'ActionsPerClassUnitTest.2.inc':

          return array(
                2  => 1,
               );
        }
    }//end getErrorList()


    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array(int => int)
     */
    public function getWarningList($testFile='')
    {
        switch ($testFile) {
        case 'ActionsPerClassUnitTest.2.inc':
        case 'ActionsPerClassUnitTest.3.inc':
          return array(
                2  => 0,
               );

        case 'ActionsPerClassUnitTest.1.inc':

          return array(
                2  => 1,
               );
        }
    }


}

?>
