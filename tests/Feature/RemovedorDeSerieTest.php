<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\CriadordeSerie;
use App\Services\SeriesRemove;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;
    
     private $serie;

     protected function setUp(): void
     {
         parent::setUp();
         $criadorDeSerie = new CriadorDeSerie();
         $this->serie = $criadorDeSerie->criarSerie(
             'Nome da série', 1, 1);
 
     }
 
     public function testRemoverUmaSerie()
{
    $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
    $removedorDeSerie = new SeriesRemove();
    $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
    $this->assertIsString($nomeSerie);
    $this->assertEquals('Nome da série', $this->serie->nome);
    $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);

}
}
