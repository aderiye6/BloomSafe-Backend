<?php

namespace App\Controllers\Test;

use App\Controllers\Authenticated\Authenticated;
use Core\Pipes\Pipes;

class TestPipe extends Authenticated
{
  /**
   * Set Data pattern for creating a test
   * @param Pipes $data
   * @return Pipes
   */
  public function createTestPipe(Pipes $pipe)
  {
    return $pipe->pipe([
      // 'score' => $pipe
      //   ->score()
      //   ->isint()
      //   ->lte(1)
      //   ->gte(10)
      //   ->toint()
      //   ->score,
        'longitude' => $pipe
        ->longitude,
        'latitude' => $pipe
        ->latitude
    ]);
  }
  public function getTestsPipe(Pipes $pipes)
  {
    return $pipes->pipe([
      'page' => $pipes->page()->default(1)->isint()->page,
      'limit' => $pipes->limit()->default(1)->isint()->limit
    ]);
  }
}
