<?php

namespace Pantheon\TerminusPancakes\Apps;

/**
 * Open Site database in TablePlus
 */
class TablePlusApp extends PancakesApp {

  /**
   * {@inheritdoc}
   */
  public $aliases = ['TablePlus', 'tableplus', 'tp'];

  /**
   * {@inheritdoc}
   */
  public $app = 'TablePlus';

  /**
   * App Location
   */
  public $app_location;

  public function open() {
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

    $candidates = [
      '/Applications/TablePlus.app',
      '/Applications/Setapp/TablePlus.app',
    ];

    foreach ($candidates as $candinate) {
      if (file_exists($candinate)) {
        $this->app_location = $candinate . '/Contents/MacOS/TablePlus';
        print_r($this->app_location);
        return $this->which($this->escapeShellArg($this->app_location));
      }
    }

    return FALSE;
  }

  public function weight() {
    return 1;
  }

}
