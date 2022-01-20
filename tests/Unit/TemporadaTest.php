<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    private $temporada;


    protected function setUp():void
    {
       parent::setUp();
       $temporada = new Temporada();
       $episodio1 = new Episodio();
       $episodio1->assistido = true;
       $episodio2 = new Episodio();
       $episodio2->assistido = true;
       $episodio3 = new Episodio();
       $episodio3->assistido = false;
       $episodio4 = new Episodio();
       $episodio4->assistido = true;

       $temporada->episodios->add($episodio1);
       $temporada->episodios->add($episodio2);
       $temporada->episodios->add($episodio3);
       $temporada->episodios->add($episodio4);

       $this->temporada = $temporada;
       
    }
    public function testBuscaEpisodiosAssistidos()
    {
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();

        $this->assertCount(3, $episodiosAssistidos);

        foreach($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistido);
        }

    }

    public function allEpisodes()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(4,$episodios);
    }
}
