<?php

namespace App\Controllers\Test;

use App\Helpers\Filters;
use App\Helpers\Paginate;
use App\Models\Test;
use Core\Http\Res;
use Core\Pipes\Pipes;
use Module\Image;

class Tests extends TestPipe
{
    private $standard = 10;

    /**
     * Save test samples...
     * Get test data, calculate results, 
     * save test images result and score results
     * @param Pipes $test
     */
    public function _createTest($test)
    {
        $data = $this->createTestPipe($test);
        $result = ($data->score / $this->standard);

        $image = new Image($test->image);
        $img = (object) $image->upload();

        $saved = Test::dump([
            'user_id' => $this->user->id,
            'image' => $img->file,
            'result' => $result,
            'metadata' => json_encode([
                'file' => $test->image,
                'score' => $data->score,
                'result' => $result,
                'standard' => $this->standard
            ]),
            'record_time' => time(),
        ]);
        Res::json($saved);
    }

    public function _getTests($test)
    {
        $pg = Paginate::page((array) $this->getTestsPipe($test));
        $tests = $this->user->paginate($pg->page)->tests();

        $filtered = Filters::from($tests)->append(['metadata' => function ($data) {
            return json_decode($data);
        }])->done();
        Res::json($filtered);
    }

    public function _getTest()
    {
        $testID = $this->route_params['id'];
        $test = $this->user->test($testID);

        Res::json($test ? $test->append(['metadata' => json_decode($test->metadata)]) : "No Test found");
    }
}
