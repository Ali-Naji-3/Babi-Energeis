<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnergyAudit;

class EnergyAuditController extends Controller
{
    public function index()
    {
        return view('energy-audit.index');
    }
    
    public function create()
    {
        return view('energy-audit.create');
    }
    
    public function store(Request $request)
    {
        // Handle energy audit booking
        return redirect()->route('energy-audit')->with('success', 'Energy audit request submitted successfully!');
    }
    
    public function show(EnergyAudit $audit)
    {
        return view('energy-audit.show', compact('audit'));
    }
}