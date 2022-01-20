<?php
namespace App\Services;

use App\{
    Serie,
    Episodio,
    Temporada
};
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Console\StorageLinkCommand;
class SeriesRemove
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function() use($serieId, &$nomeSerie){
            $serie = Serie::find($serieId);
            $serieObj = (object)$serie->toArray();

            $nomeSerie = $serie->nome;
            $this->removeTemporadas($serie);
            $serie->delete();
            
            $evento = new SerieApagada($serieObj);
            event($evento);
            ExcluirCapaSerie::dispatch($serieObj);
        
        });
       

       return $nomeSerie ;
    }

    private function removeTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function(Temporada $temporada){
             $this->removeEpisodios($temporada);
            $temporada->delete();
         });
    }

    private function removeEpisodios($temporada)
    {
        $temporada->episodios->each(function(Episodio $episodio){
            $episodio->delete();
         });
    }
}