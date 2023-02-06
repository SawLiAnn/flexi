<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Calendar;

class CalendarController extends Controller
{
    public function index(){
        $calendar = Calendar::buildYear(2023);
        return view('calendar.index', compact('calendar'));
    }
}
