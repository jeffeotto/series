@extends('layout')

@section('cabecalho')
Adicionar
@endsection

@section('conteudo')
@include('errors', ['errors' => $errors])
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col col-8">
                    <label for="nome" >Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="col col-2">
                    <label for="qtd_temporadas">N° de temporadas</label>
                    <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
                </div>
                <div class="col col-2">
                    <label for="ep_por_temporada">N° de espisódios</label>
                    <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
                </div>
            </div>

            <div class="row">
            <div class="col col-12">
            <label for="thumbnail">Foto</label>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
            </div>
            </div>
       
         <button class="btn btn-primary mt-2">Adicionar</button>
        </form>
@endsection