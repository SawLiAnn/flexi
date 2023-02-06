<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Service;
use App\Models\ServiceProvider;

class BookController extends Controller
{
    public function index()
    {
        $mystring = url()->current();
        $first = strtok($mystring, '.');
        $subdomain= str_replace("http://", "", $first);

        $team_id=Team::where('subdomain', $subdomain)->first()->id;
        $services=Service::where('team_id', $team_id)->get();

        $service_providers = ServiceProvider::where('team_id', $team_id)->get();
        
        return view('book.index', compact('subdomain', 'services', 'service_providers'));
        // return view('admin.serviceSchedules.index', compact('serviceSchedules'));

    }
}
