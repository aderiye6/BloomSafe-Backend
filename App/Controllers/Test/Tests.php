<?php

namespace App\Controllers\Test;

use App\Helpers\ColorDetection;
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
    // {       Res::json($test->coordinates); 
        $data = $this->createTestPipe($test);
        $image = new Image($test->image);
        $img = (object) $image->upload();
        $color = new ColorDetection();
        $imgc = $color->detectColors($img->file);
        $orangeDepth = intval($imgc['orange']);
        $yellowDepth = intval($imgc['yellow']);
        if($orangeDepth == 0 && $yellowDepth == 0)
        {
            $score = 0;
        }elseif($orangeDepth > 0 && $yellowDepth > 0)
        {
            $score = ($orangeDepth + $yellowDepth)/10;
        }elseif($orangeDepth <= 0 && $yellowDepth > 0)
        {
            $score = $yellowDepth/10;
        }elseif($orangeDepth > 0 && $yellowDepth <= 0)
        {
            $score = $orangeDepth/10;
        }else{
            $score = 'Unidentified Color';
            
            }
            
            $result = ($score / $this->standard);
                if($result > 0 && $result <= 0.3)
                {
                    $comment = 'Slightly Safe';
                }elseif($result > 0.3 && $result <= 0.7)
                {
                    $comment = 'Slightly Bad';
                }
                elseif($result > 0.7 && $result <= 1.0)
                {
                    $comment = 'Really Bad';
                }else{
                    
                    return Res::json('Unidentified Color or Invalid Image');
                }
        $saved = Test::dump([
            'user_id' => $this->user->id,
            'image' => $img->file,
            'result' => $result,
            'score' => $score,
            'longitude' => $data->longitude,
            'latitude' => $data->latitude,
            'comment' => $comment,
            'metadata' => json_encode([
                'file' => $test->image,
                'score' => $score,
                'result' => $result,
                'standard' => $this->standard,
               
                
                
            ]),
            'record_time' => time(),
        ]);
        Res::json($saved);
    }

    public function _getTests($test)
    {
        $pg = Paginate::page((array) $this->getTestsPipe($test));
        $tests = $this->user->tests();

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
