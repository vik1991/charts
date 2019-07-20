<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function index()
    {
        return view('chart');
    }

    public function getChart()
    {
        $filename = 'export.csv';
        $delimiter = ';';
        $header = null;
        if (($handle = fopen($filename, 'r')) !== false) {
            $flag = true;
            while (($row = fgetcsv($handle, 10000, $delimiter)) !== false) {
                if ($flag) {
                    $flag = false;
                    continue;
                }
                $data['user_id'][] = intval($row[0]);
                $data['created_at'][] = $row[1];
                $data['onboarding_percentage'][] = intval($row[2]);
                $data['count_applications'][] = intval($row[3]);
                $data['count_accepted_applications'][] = intval($row[4]);
            }

            fclose($handle);
        }

        $formattedArray = [];

        $data['created_at'] = array_unique($data['created_at']);
        $dateRangeKeys[] = array_keys($data['created_at']);
        $length = count($dateRangeKeys[0]);

        for ($i = 0; $i < $length - 1; ++$i) {
            $formattedArray[$data['created_at'][$dateRangeKeys[0][$i]]]['user_id'] = array_slice($data['user_id'], $dateRangeKeys[0][$i], $dateRangeKeys[0][$i + 1]);
            $formattedArray[$data['created_at'][$dateRangeKeys[0][$i]]]['onboarding_percentage'] = array_slice($data['onboarding_percentage'], $dateRangeKeys[0][$i], $dateRangeKeys[0][$i + 1]);
            $formattedArray[$data['created_at'][$dateRangeKeys[0][$i]]]['count_applications'] = array_slice($data['count_applications'], $dateRangeKeys[0][$i], $dateRangeKeys[0][$i + 1]);
            $formattedArray[$data['created_at'][$dateRangeKeys[0][$i]]]['count_accepted_applications'] = array_slice($data['count_accepted_applications'], $dateRangeKeys[0][$i], $dateRangeKeys[0][$i + 1]);
            $i++;
        }

        return json_encode($formattedArray);
    }
}
