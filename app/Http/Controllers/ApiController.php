<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showSwaggerUI()
    {
        $documentation = 'default'; // Set this to the documentation key you want to use
        $urlToDocs = asset(config('l5-swagger.documentations.' . $documentation . '.paths.docs_json')); // Get the URL for the JSON documentation
        $useAbsolutePath = config('l5-swagger.documentations.' . $documentation . '.paths.use_absolute_path'); // Retrieve the absolute path setting

        return view('vendor.l5-swagger.index', compact('documentation', 'urlToDocs', 'useAbsolutePath')); // Pass the variables to the view
    }
}
