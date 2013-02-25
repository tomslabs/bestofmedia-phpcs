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
class BestOfMedia_Sniffs_DependencyInjection_SingletonSniff extends PHP_CodeSniffer_Standards_AbstractScopeSniff {

  protected $singletonCallPattern = array('/.?instance$/i');
  protected $allowedClassMethodPattern = array(
    array('/.*/', '/^__construct$/'),
    array('/.*Actions$/', '/^execute[A-Z].+/'),
    array('/.*Task$/', '/^run$/'),
  );

  /**
   * Constructs the test with the tokens it wishes to listen for.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct(array(T_FUNCTION), array(T_PAAMAYIM_NEKUDOTAYIM), false);
  }

  protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope) {
    $tokens  = $phpcsFile->getTokens();

    $classPtr = $phpcsFile->getCondition($currScope, T_CLASS);
    if(!$classPtr) {
      // calling a static in function is like calling from a static method.
      return;
    }

    if($classPtr) {
      $className = $phpcsFile->getDeclarationName($classPtr);
      $classParent = $phpcsFile->findExtendedClassName($classPtr);
    }
    $functionName = $phpcsFile->getDeclarationName($currScope);
    $functionProp = $phpcsFile->getMethodProperties($currScope);

    if(true === $functionProp['is_static']) {
      return;
    }

    $matchSingletonPattern = false;
    foreach($this->singletonCallPattern as $pattern) {
      $matchSingletonPattern = $matchSingletonPattern || preg_match($pattern, $tokens[$stackPtr+1]['content']);
    }

    if(false === $matchSingletonPattern) {
      return;
    }

    $isValid = false;
    foreach($this->allowedClassMethodPattern as $pattern) {
      $classPattern = $pattern[0];
      $methodPattern = $pattern[1];

      $classMatches = preg_match($classPattern, $className) || preg_match($classPattern, $classParent);
      if(!$classMatches) {
        continue;
      }

      if(preg_match($methodPattern, $functionName)) {
        $isValid = true;
        break;
      }
    }

    if(!$isValid) {
      $error = 'You have no reason to call a singleton inside a non-static %s::%s method. Please inject it as property.';
      $phpcsFile->addError($error, $stackPtr, 'NotAllowed', array($className, $functionName));
    }
  }

}