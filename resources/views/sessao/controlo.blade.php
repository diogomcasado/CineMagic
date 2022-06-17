@extends('layouts.app')


<link href="{{ asset('css/sessao/sessao.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

@section('content')

@if ($message = Session::get('success'))

<p class="alert alert-success">{{ $message }}</p>

@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="main">
    <h1>Controlo de acesso á sessão</h1>
    <form action="" method="POST">
        @csrf
        @if(!empty($filmesListFinal))
        <div class="col-12">
            <label for="filme" class="form-label">Filme: </label>
            <select name="filme" id="idFilme" class="form-control">
                <option value="">--- Selecione Filme ---</option>
                @foreach($filmesListFinal as $abr)
                <option value="{{$abr->id}}">{{$abr->titulo}}</option>
                @endforeach
            </select>

        </div>

        <div class="col-12">
            <label for="sessao" class="form-label">Sala: </label>
            <select name="sessao" id="sessao" class="form-control">
                <option value="">--Sessao--</option>
            </select>

        </div>
        


        
        <div class="col-12">
            <label for="email" class="form-label">Horario: </label>
        </div>
        

        <div class="btn">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Entrar</button>
        </div>

        @else
        <div class="aviso">Sem filmes disponiveis</div>

        @endif
    </form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="filme"]').on('change',function(){
               var filmeID = jQuery(this).val();
               console.log(filmeID);
               if(filmeID)
               {
                  jQuery.ajax({
                     url : 'controlo/get_sessao/' +filmeID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="sessao"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="sessao"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="sessao"]').empty();
               }
            });
    });
    </script>

@endsection

