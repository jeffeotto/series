<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Episodio;
use App\Events\SerieNova;
use App\Temporada;
use App\Mail\NovaSerie;
use Illuminate\Http\Request;
use App\Services\SeriesRemove;
use App\Services\CriadordeSerie;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }  
   public function index(Request $request)
   {
      $series = Serie::query()
      ->orderBy('nome')
      ->get();
      $mensagem = $request->session()->get('mensagem');
    
    return view('series.index', compact('series', 'mensagem'));
   }

   public function create()
   {
       return view('series.create');
   }

   public function store(SeriesFormRequest $request, CriadordeSerie $criadordeSeries)
   {

       $capa = null;
       if ($request->hasFile('thumbnail')) {
        $capa = $request->file('thumbnail')->store('serie');
       }
       
       $serie = $criadordeSeries->criarSerie(
           $request->nome,
           $request->qtd_temporadas,
           $request->ep_por_temporada,
           $capa
        );

        $eventoNovaSerie = new SerieNova(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );
       event($eventoNovaSerie);
    
       $request->session()
       ->flash('mensagem', "Serie {$serie->id} criada com sucesso {$serie->nome}");
    //  $nome = $request->nome;
    //  $serie = Serie::create([
    //      'nome' => $nome
    //  ]);
     return redirect()->route('listar_series');
     
   }

   public function destroy(Request $request, SeriesRemove $seriesRemove)
   {
       $nomeSerie = $seriesRemove->removerSerie($request->id);

       $request->session()
       ->flash('mensagem', 
       "Serie $nomeSerie removida com sucesso ");
       return redirect()->route('listar_series');
   }

   public function editaNome($id,Request $request)
   {
       
       $novoNome = $request->nome;
       //$serie = Serie::find($request->id);
       $serie = Serie::find($id);
       /*
       $id igual parametro da url da route
       Route::post('/series/{id}/editaNome','SeriesController@editaNome');
       
       */
       $serie->nome = $novoNome;
       $serie->save();
   }

}