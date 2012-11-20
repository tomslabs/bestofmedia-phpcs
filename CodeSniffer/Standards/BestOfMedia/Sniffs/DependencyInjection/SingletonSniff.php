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
  protected $allowedClassContext = array('sfActions');
  protected $allowedMethodContext = array('__construct');

  /**
   * Constructs the test with the tokens it wishes to listen for.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct(array(T_FUNCTION), array(T_PAAMAYIM_NEKUDOTAYIM), true);
  }

  protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope) {
    $tokens  = $phpcsFile->getTokens();

    $classPtr = $phpcsFile->getCondition($currScope, T_CLASS);
    $className = $phpcsFile->getDeclarationName($classPtr);
    $classParent = $phpcsFile->findExtendedClassName($classPtr);
    $functionName = $phpcsFile->getDeclarationName($currScope);
    $functionProp = $phpcsFile->getMethodProperties($currScope);

    foreach($this->singletonCallPattern as $pattern) {
      if(preg_match($pattern, $tokens[$stackPtr+1]['content'])) {
        if(in_array($className, $this->allowedClassContext) ||
          in_array($classParent, $this->allowedClassContext) ) {
          // Found in a class that is allowed to use singleton calls.
          return;
        }

        if(true === $functionProp['is_static']) {
          // A static call in a static is OK.
          return;
        }

        if(in_array($functionName, $this->allowedMethodContext)) {
          $error = 'Getting a singleton statically often means bad dependency injection management. But usage in %s is tolerated, try to inject it, please.';
          $phpcsFile->addWarning($error, $stackPtr, 'Tolerated', array($functionName));
        }

        $error = 'You have no reason to call a singleton inside a non-static method. Please inject it as property.';
        $phpcsFile->addError($error, $stackPtr, 'NotAllowed', array($functionName));
      }
    }
  }

}