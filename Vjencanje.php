<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vjencanje extends Model
{

    protected $table = 'vjencanje';

    public function pozivnice() {
      return $this->hasMany('App\Pozivnice');
    }

    public function getInvitedAttribute() {
        $glavna_pozivnica = $this->pozivnice()->count();
        $dodatni_gosti = $this->pozivnice()->sum('dodatni_gosti');
        $broj_pozvanih = $glavna_pozivnica + $dodatni_gosti;
        return $broj_pozvanih;
    }

    public function getPotvrdeniAttribute() {
      $potvrdeni_count = $this->pozivnice()->whereNotNull('potvrdeno')->count();
      $potvrdeni_dodatni_gosti = $this->pozivnice()->whereNotNull('potvrdeno')->sum('dodatni_gosti');
      $sum_potvrdeni =  $potvrdeni_count + $potvrdeni_dodatni_gosti;
      return $sum_potvrdeni;

    }

    public function getOdbijeniAttribute() {
      $odbijeni_count = $this->pozivnice()->whereNotNull('odbijeno')->count();
      $odbijeni_dodatni_gosti = $this->pozivnice()->whereNotNull('odbijeno')->sum('dodatni_gosti');
      $sum_odbijeni = $odbijeni_count + $odbijeni_dodatni_gosti;
      return $sum_odbijeni;
    }

    public function getNaCekanjuAttribute() {
      $na_cekanju_count = $this->pozivnice()->whereNull('potvrdeno')->whereNull('odbijeno')->count();
      $na_cekanju_dodatni_gosti = $this->pozivnice()->whereNull('potvrdeno')->whereNull('odbijeno')->sum('dodatni_gosti');
      $sum_na_cekanju = $na_cekanju_count + $na_cekanju_dodatni_gosti;
      return $sum_na_cekanju;
    }
}
