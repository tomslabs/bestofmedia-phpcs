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
class BestOfMedia_Sniffs_Symfony_SfActionsMethodDeclarationSniff extends PHP_CodeSniffer_Standards_AbstractScopeSniff {

  /**
   * Constructs the test with the tokens it wishes to listen for.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct(array(T_CLASS, T_INTERFACE), array(T_FUNCTION), true);
  }

  private function isAnActionClass(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {


    if($phpcsFile->getFilename() == 'actions.class.php') {
      return true;
    }

    $parentClassPos = $phpcsFile->findPrevious(array(T_CLASS, T_INTERFACE), $stackPtr);
    if('sfActions' == $phpcsFile->findExtendedClassName($parentClassPos)) {
      return true;
    }

    return false;
  }

  protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope) {
    if(!$this->isAnActionClass($phpcsFile, $stackPtr)) {
      return;
    }

    $className  = $phpcsFile->getDeclarationName($currScope);
    $methodName = $phpcsFile->getDeclarationName($stackPtr);
    if(0 !== strpos($methodName, 'execute')) {
      return;
    }

    $properties = $phpcsFile->getMethodProperties($stackPtr);

    if('public' != $properties['scope']) {
      $error = "An action method in a sfActions class MUST be public. %s::%s is %s.";
      $phpcsFile->addError($error, $stackPtr, 'MustBePublic', array($className, $methodName, $properties['scope']));
    }

    if(true != $properties['scope_specified']) {
      $error = "An action method in a sfActions class MUST be explicitly public. %s::%s has no explicit scope.";
      $phpcsFile->addWarning($error, $stackPtr, 'MustBeExplicitlyPublic', array($className, $methodName));
    }

    $parameters = $phpcsFile->getMethodParameters($stackPtr);
    if(1 !== count($parameters) ||
      $parameters[0]['name'] !== '$request' ||
      $parameters[0]['type_hint'] !== 'sfWebRequest') {
      $error = "An action method in a sfActions class MUST declare a single \$request, hinted as sfWebRequest, not passed by reference.";
      $phpcsFile->addError($error, $stackPtr, 'MustBeExplicitlyPublic', array($className, $methodName));
    }
  }

}