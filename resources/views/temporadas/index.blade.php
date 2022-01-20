@extends('layout')

@section('cabecalho')
    Temporadas {{$serie->nome}}
@endsection

@section('conteudo')
@if($serie->thumbnail)
     <div class="row">
         <div class="col col-12 text-center mb-5">
             <a href="{{$serie->thumbnail_url}}" target="_blank">
         <img src="{{$serie->thumbnail_url}}" alt="" class="img-thumbnail" width="400px" height="400px">
         </a>
         </div>
     </div>
     @endif
    <ul class="list-group">
        @foreach($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                
                <a href="/temporadas/{{$temporada->id}}/episodios">
                Temporada {{ $temporada->numero }}
                </a>
               <span class="badge badge-secondary">
                   {{$temporada->getEpisodiosAssistidos()->count()}} / {{$temporada->episodios->count()}}
               </span>
            </li>
        @endforeach
    </ul>

@endsection