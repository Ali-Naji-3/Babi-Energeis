<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceVisit;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance.index');
    }
    
    public function create()
    {
        return view('maintenance.create');
    }
    
    public function store(Request $request)
    {
        // Handle maintenance request
        return redirect()->route('maintenance')->with('success', 'Maintenance request submitted successfully!');
    }
}
