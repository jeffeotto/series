<?php
namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadordeSerie
{   
    public function criarSerie(
        string $nomeSerie, 
        int $qtdTemporadas, 
        int $epPorTemporada,
        ?string $thumbnail
        )
    {  
        DB::beginTransaction();
        $serie = Serie::create(
            ['nome' => $nomeSerie,
            'thumbnail'=>$thumbnail
            ]
        );
        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();

       return $serie;

    }

    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie)
    {
        for ($i = 0; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }



    private function criaEpisodios(int $epPorTemporada, \Illuminate\Database\Eloquent\Model $temporada): void
    {

        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }

}