<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vjencanje;
use App\Pozivnice;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function admin()
  {
    $vjencanje = Vjencanje::all();

    $pozivnice = Pozivnice::whereNotNull('potvrdeno')->get();
    
    return view('dashboard', compact('vjencanje', 'pozivnice'));
  }
}
