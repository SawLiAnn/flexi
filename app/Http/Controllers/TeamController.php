<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;


class TeamController extends Controller
{
    public function website($tenantID)
    {
        //Check tenant
        $tenant = auth()->user()->teams()->findOrFail($tenantID);

        //Redirect
        // return redirect()->route('admin.home');
        $tenantDomain = str_replace('://', '://' . $tenant->subdomain . '.', config('app.url'));
        // dd($tenantDomain . "/website");
        // dd(route('teams.website', $tenantID));
        // dd($tenantDomain . "/post/" . $tenantID);
        return redirect($tenantDomain . "/home2");
        // return redirect($tenantDomain . "/website");
        // return redirect($tenantDomain . route('teams.website', $tenantID));
    }
}
