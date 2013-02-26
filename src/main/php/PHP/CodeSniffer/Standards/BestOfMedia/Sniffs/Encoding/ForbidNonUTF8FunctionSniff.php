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
class BestOfMedia_Sniffs_Encoding_ForbidNonUTF8FunctionSniff implements PHP_CodeSniffer_Sniff
{

  protected $disallowedfunctions = array(
    'mail' => 'mb_send_mail',
    'strlen' => 'mb_strlen',
    'strpos' => 'mb_strpos',
    'strrpos' => 'mb_strrpos',
    'substr' => 'mb_substr',
    'strtolower' => 'mb_strtolower',
    'strtoupper' => 'mb_strtoupper',
    'stripos' => 'mb_stripos',
    'strripos' => 'mb_strripos',
    'strstr' => 'mb_strstr',
    'stristr' => 'mb_stristr',
    'strrchr' => 'mb_strrchr',
    'substr_count' => 'mb_substr_count',
    'ereg' => 'mb_ereg',
    'eregi' => 'mb_eregi',
    'ereg_replace' => 'mb_ereg_replace',
    'eregi_replace' => 'mb_eregi_replace',
    'split' => 'mb_split'
  );

  public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
  {
    $tokens = $phpcsFile->getTokens();

    $whitespacePtr = $phpcsFile->findNext(T_WHITESPACE, $stackPtr);
    $parenthesisPtr = $phpcsFile->findNext(T_OPEN_PARENTHESIS, $stackPtr);

    // check we are calling a function, and nothing else than a function
    if ($parenthesisPtr > $whitespacePtr)
    {
      for ($i = $whitespacePtr; $i < $parenthesisPtr; $i++)
      {
        if ($tokens[$i]['type'] != 'T_WHITESPACE')
        {
          return;
        }
      }
    }

    $functionName = $tokens[$stackPtr]['content'];

    if (in_array($functionName, array_keys($this->disallowedfunctions)))
    {
      $phpcsFile->addError('Use mb equivalent function %s() instead of %s()', $stackPtr, 'NonUTF8Function', array($this->disallowedfunctions[$functionName], $functionName));
    }
  }

  public function register()
  {
    return array(T_STRING);
  }

}