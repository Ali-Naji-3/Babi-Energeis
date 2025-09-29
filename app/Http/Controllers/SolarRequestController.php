<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolarInstallation;

class SolarRequestController extends Controller
{
    public function index()
    {
        return view('solar-installation.index');
    }
    
    public function create()
    {
        return view('solar-installation.create');
    }
    
    public function store(Request $request)
    {
        // Handle solar installation request
        return redirect()->route('solar-installation')->with('success', 'Solar installation request submitted successfully!');
    }
    
    public function show(SolarInstallation $installation)
    {
        return view('solar-installation.show', compact('installation'));
    }
}
