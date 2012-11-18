<?php

/**
 * This sniff prohibits the use of Perl style hash comments.
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
 * This sniff limits actions per Symfony sfActions class
 *
 * @category  PHP
 * @package   PHP_CodeSniffer_Standards_BestOfMedia
 * @author    Guillaume Boddaert <gboddaert@bestofmedia.com>
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License
 * @link      http://tomslabs.github.com/pear/
 */
class BestOfMedia_Sniffs_Symfony_SfActionsPerClassSniff implements PHP_CodeSniffer_Sniff {

  /**
   * ExecuteXXX methods count higher than this value will throw a warning.
   *
   * @var int
   */
  public $warningThreshold = 10;

  /**
   * ExecuteXXX methods count higher than this value will throw an error.
   *
   * @var int
   */
  public $errorThreshold = 20;

  public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
    $tokens = $phpcsFile->getTokens();
    $className = $phpcsFile->getDeclarationName($stackPtr);

    // Ignore abstract methods.
    if (isset($tokens[$stackPtr]['scope_opener']) === false) {
      return;
    }

    // Detect start and end of this class definition.
    $start = $tokens[$stackPtr]['scope_opener'];
    $end = $tokens[$stackPtr]['scope_closer'];

    if ($phpcsFile->getFilename() !== 'actions.class.php' &&
      'sfActions' === $phpcsFile->findExtendedClassName($start)) {
      return;
    }

    $count = 0;
    while ($functPtr = $phpcsFile->findNext(array(T_FUNCTION), $start, $end)) {
      $methodName = $phpcsFile->getDeclarationName($functPtr);

      if (0 === strpos($methodName, 'execute')) {
        $count++;
      }

      $start = $tokens[$functPtr]['scope_closer'];
    }

    if($count > $this->errorThreshold) {
      $error = 'There are too many executeXXX method in %s class. You should now split the sfActions method to lower execute methods from %s below %s.';
      $phpcsFile->addError($error, $stackPtr, 'TooMany', array($className, $count, $this->errorThreshold));
      return;
    }

    if($count > $this->warningThreshold) {
      $error = 'There are a lot of executeXXX method in %s class. Consider lowering them from %s below %s.';
      $phpcsFile->addWarning($error, $stackPtr, 'Messy', array($className, $count, $this->warningThreshold));
      return;
    }

    return;
  }

  public function register() {
    return array(T_CLASS);
  }

}