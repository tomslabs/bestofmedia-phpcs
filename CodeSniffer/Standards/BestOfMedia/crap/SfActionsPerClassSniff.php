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
class BestOfMedia_Sniffs_Symfony_SfActionsPerClassSniff extends PHP_CodeSniffer_Standards_AbstractScopeSniff {

  /**
   * Constructs the test with the tokens it wishes to listen for.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct(array(T_CLASS, T_INTERFACE), array(T_FUNCTION), true);
  }

  protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope) {

  }

}