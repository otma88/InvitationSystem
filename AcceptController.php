<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pozivnice;
use Carbon\Carbon;

class AcceptController extends Controller
{

    public function reject($id, $action) {

      $pozivnica = Pozivnice::findOrFail($id);

      if ($pozivnica->potvrdno != null || $pozivnica->odbijeno != null) {
        abort(404);
      }

      if ($action == 'reject') {
        $pozivnica->update(['odbijeno' => Carbon::now()->toDateTimeString()]);
        return view('reject');
      }
    }


    public function accept($id) {

      $pozivnica = Pozivnice::findOrFail($id);

      if ($pozivnica->potvrdeno != null || $pozivnica->odbijeno != null) {
        abort(404);
      }

      return view('odgovor')->with('pozivnica', $pozivnica);

    }

    public function odgovor_poslan(Request $request, $id) {
      $pozivnica = Pozivnice::findOrFail($id);

      if ($pozivnica->potvrdeno != null || $pozivnica->odbijeno != null) {
        abort(404);
      }

      $pozivnica->update(['potvrdeno' => Carbon::now()->toDateTimeString()]);
      $pozivnica->update(['dodatni_gosti' => $request->dodatni_gosti]);
      $pozivnica->update(['poruka' => $request->poruka]);

      return view('accept');
    }
}
