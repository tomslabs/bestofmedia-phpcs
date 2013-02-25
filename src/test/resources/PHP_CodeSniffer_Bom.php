<?php

class PHP_CodeSniffer_Bom extends PHP_CodeSniffer
{
  public function addListener($className) {
    $this->listeners[$className] = $className;
  }
}