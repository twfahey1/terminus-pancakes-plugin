<?php

namespace Pantheon\TerminusPancakes\Apps;

/**
 * Open Site database in SequelAce
 */
class SequelAceApp extends PancakesApp {

  /**
   * {@inheritdoc}
   */
  public $aliases = ['sequelace'];

  /**
   * {@inheritdoc}
   */
  public $app = 'SequelAce';

  /**
   * App Location
   */
  public $app_location;

  public function open(){
    $this->execCommand('open', [
      $this->connection_info['mysql_url'],
      '-a ' . $this->escapeShellArg($this->app_location),
    ]);
  }

  /**
   * Validates the app can be used
   */
  public function validate() {
    if ($this->isWindows()) {
      return FALSE;
    }

    $this->app_location = '/Applications/Sequel Ace.app/Contents/MacOS/Sequel Ace';
    return $this->which($this->escapeShellArg($this->app_location));
  }

  public function weight() {
    return 1;
  }

}
