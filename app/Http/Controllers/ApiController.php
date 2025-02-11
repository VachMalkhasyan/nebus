<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showSwaggerUI()
    {
        $documentation = 'default';
        $urlToDocs = asset(config('l5-swagger.documentations.' . $documentation . '.paths.docs_json'));
        $useAbsolutePath = config('l5-swagger.documentations.' . $documentation . '.paths.use_absolute_path');

        return view('vendor.l5-swagger.index', compact('documentation', 'urlToDocs', 'useAbsolutePath'));
    }
}
