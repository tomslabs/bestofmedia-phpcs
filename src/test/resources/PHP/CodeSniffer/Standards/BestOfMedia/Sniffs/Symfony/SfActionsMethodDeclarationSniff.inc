<?php
class mymoduleActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    // ...
  }

  // This action method SHOULD be explicitly public.
  function executeNiak(sfWebRequest $request)
  {
    // ...
  }

  // This action method SHOULD be public.
  protected function executeNiek(sfWebRequest $request)
  {
    // ...
  }

  // This action method should accept a single input sfWebRequest $request
  public function executeNiik()
  {
    // ...
  }

  // This action method should accept a single input sfWebRequest $request
  public function executeNiok(sfWebRequest $request, $toto)
  {
    // ...
  }
}