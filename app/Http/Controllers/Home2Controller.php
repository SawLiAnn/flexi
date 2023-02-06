<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Home2Controller extends Controller
{
    public function index($subdomain)
    {
        // $mystring = url()->current();
        // $first = strtok($mystring, '.');
        // // str_replace($search, $replace, $subject)
        // $subdomain= str_replace("http://", "", $first);
        return view('home2', compact('subdomain'));
    }
    // public function index()
    // {
    //     $mystring = url()->current();
    //     $first = strtok($mystring, '.');
    //     // str_replace($search, $replace, $subject)
    //     $subdomain= str_replace("http://", "", $first);
    //     return view('home2', compact('subdomain'));
    // }
}
