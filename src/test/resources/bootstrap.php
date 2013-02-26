<?php

#define('PHP_CODESNIFFER_VERBOSITY', 1);

require_once('PHP/CodeSniffer.php');
require_once('PHP_CodeSniffer_Bom.php');

require_once(dirname(__FILE__).'/../../main/php/PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/DependencyInjection/SingletonSniff.php');
require_once(dirname(__FILE__).'/../../main/php/PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Encoding/ForbidNonUTF8FunctionSniff.php');
require_once(dirname(__FILE__).'/../../main/php/PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsMethodDeclarationSniff.php');
require_once(dirname(__FILE__).'/../../main/php/PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsPerClassSniff.php');
require_once(dirname(__FILE__).'/../php/PHP/CodeSniffer/Standards/AbstractStandardTest.php');