<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chart;


class ChartsController extends Controller
{
    public function index(){


        return view('chart');

    }

    public function getChart(){
        $chartData= Chart::readingCSV();


        return json_encode($chartData);
    }
}
