<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pozivnice;
use App\Mail\SlanjePozivnica;
use App\Mail\SendPozivnice;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PozivniceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pozivnice = Pozivnice::all();

      return view('gosti.index', compact('pozivnice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gosti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      request()->validate([
        'name' => 'required',
        'email' => ['required','email','unique:users']
      ]);

      $pozivnica = new Pozivnice;
      $pozivnica->vjencanje_id = 1;
      $pozivnica->email = $request->email;
      $pozivnica->name = $request->name;
      $pozivnica->dodatni_gosti = $request->dodatni_gosti;
      $pozivnica->save();

      switch ($request->input('action')) {
        case 'save_and_stay':
          return redirect()->route('gosti.create');
          break;

        case 'save':
          return redirect()->route('gosti.index');
          break;
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pozivnica = Pozivnice::findOrFail($id);

        return view('gosti.show', compact('pozivnica'));
    }


    /**
     * Sending invitations
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        $pozivnica = Pozivnice::findOrFail($id);
        Mail::to($pozivnica->email)->send(new SendPozivnice($pozivnica));

        $pozivnica->update(['poslano' => Carbon::now()->toDateTimeString()]);

        return redirect()->route('gosti.index');
    }

    /**
     * Sending invitations
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendAll()
    {

        $pozivnice = Pozivnice::where('vjencanje_id', 1)->whereNull('poslano')->get();

        foreach ($pozivnice as $pozivnica) {
          Mail::to($pozivnica->email)->send(new SendPozivnice($pozivnica));
          $pozivnica->update(['poslano' => Carbon::now()->toDateTimeString()]);
        }

        return redirect()->route('gosti.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pozivnica = Pozivnice::findOrFail($id);

        return view('gosti.edit', compact('pozivnica'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $pozivnica = Pozivnice::findOrFail($id);

      request()->validate([
        'name' => 'required',
        'email' => ['required','email','unique:users']
      ]);

      $pozivnica->update($request->all());

      return redirect()->route('gosti.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pozivnica = Pozivnice::findOrFail($id);
      $pozivnica->delete();
      return redirect()->route('gosti.index');
    }

    public function potvrdeni()
    {
      $potvrdene = Pozivnice::whereNotNull('potvrdeno')->get();
      return view('gosti.potvrdeni', compact('potvrdene'));
    }

    public function odbijeni()
    {
      $odbijene = Pozivnice::whereNotNull('odbijeno')->get();
      return view('gosti.odbijeni', compact('odbijene'));
    }

    public function nacekanju()
    {
      $nacekanju = Pozivnice::whereNull('potvrdeno')->whereNull('odbijeno')->whereNotNull('poslano')->get();
      return view('gosti.nacekanju', compact('nacekanju'));
    }
}
