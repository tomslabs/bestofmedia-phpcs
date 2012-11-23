<?php
// No warning in a sfActions
class mymoduleActions extends sfActions
{
  function __construct() {
    //Allowed in constructor
    MyClass::getInstance();
  }

  public function executeMyAction(sfWebRequest $request)
  {
    //Allowed
    MyClass::getInstance();
  }

  public function myMethod()
  {
    // DISALLOWED in non-static method
    MyClass::getInstance();
  }

  static function myStatic() {
    // ALLOWED in static method
    MyClass::getInstance();
  }
}

class myTask extends sfTask
{
  function __construct() {
    //Allowed in constructor
    MyClass::getInstance();
  }

  public function run($arguments = array(), $options = array())
  {
    //Allowed in *Task::run()
    MyClass::getInstance();
  }

  static function myStatic() {
    // ALLOWED in static method
    MyClass::getInstance();
  }

  public function myMethod()
  {
    // DISALLOWED in non-static method
    MyClass::getInstance();
  }
}

class anotherClass
{
  function __construct() {
    //Allowed in constructor
    MyClass::getInstance();
  }

  public function myMethod() {
    // DISALLOWED in non-static method
    MyClass::getInstance();
    // DISALLOWED in non-static method
    MyClass::instance();
    // DISALLOWED in non-static method
    MyClass::setInstance();
    // DISALLOWED in non-static method
    MyClass::niekNiekInstance();
  }

  static function myStatic() {
    MyClass::getInstance();
  }
}

function myFunction() {
  // ALLOWED
  MyClass::getInstance();
}