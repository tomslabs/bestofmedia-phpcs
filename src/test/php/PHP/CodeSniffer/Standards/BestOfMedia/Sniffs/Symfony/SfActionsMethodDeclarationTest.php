<?php

class BestOfMedia_Tests_Symfony_SfActionsMethodDeclarationTest extends AbstractStandardTest {

  /**
   * @group unittest
   */
  public function testSniffer() {
    $file = $this->getParsedCodeSnifferFile(
      $this->getResourceFilePath('PHP/CodeSniffer/Standards/BestOfMedia/Sniffs/Symfony/SfActionsMethodDeclarationSniff.inc'),
      'BestOfMedia_Sniffs_Symfony_SfActionsMethodDeclarationSniff',
      array(
      'MustBeExplicitlyPublic' => 10,
        'MustBePublic' => 10,
      )
    );

    $this->assertPhpCsWarning($file, 10,  'An action method in a sfActions class MUST be explicitly public. mymoduleActions::executeNiak has no explicit scope.');
    $this->assertPhpCsError($file, 16,  'An action method in a sfActions class MUST be public. mymoduleActions::executeNiek is protected.');
    $this->assertPhpCsError($file, 22,  'An action method in a sfActions class MUST declare a single $request, hinted as sfWebRequest, not passed by reference.');
    $this->assertPhpCsError($file, 28,  'An action method in a sfActions class MUST declare a single $request, hinted as sfWebRequest, not passed by reference.');

    $this->assertCountPhpCsWarning($file, 1);
    $this->assertCountPhpCsError($file, 3);
  }
}
