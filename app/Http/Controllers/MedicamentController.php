<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    public function index()
{
    $medicaments = \App\Models\Medicament::all();
    return view('medicaments.index', compact('medicaments'));
}
}
