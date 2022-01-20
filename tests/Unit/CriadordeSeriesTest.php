<?php

namespace Tests\Unit;

use App\Serie;
use Tests\TestCase;
use App\Services\CriadordeSerie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadordeSeriesTest extends TestCase
{
    use RefreshDatabase;
    public function testCriadordeSerie()
    {
        $criadorDeSerie = new CriadordeSerie();
        $nomeSerie = 'Test Serie';
        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie, 1,1 );

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['nome'=>$nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id'=> $serieCriada->id,'numero'=>1]);
        $this->assertDatabaseHas('episodios', ['numero'=>1]);

    }
}
