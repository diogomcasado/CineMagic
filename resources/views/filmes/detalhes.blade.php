@extends('layouts.app')


<link href="{{ asset('css/filmes/detalhes.css') }}" rel="stylesheet">


@section('content')



<div class="titulo">
    <h2>Filme: {{ $filme->titulo }}</h2>
</div>

<form action="{{route('filmes.list')}}" method="post">
    @csrf
    <div class="caixa">
        <div class="filme">
            <div class="column1">
                <div class="filme-imagem">
                    <img src="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}" alt="filme_image">
                </div>
            </div>

            <div class="column2">
                <div class="filme-info-area">
                    <p>
                    <div class="filme-label">Sumario: </div>
                    <div class="filme-info-desc">{{ $filme->sumario}}</div>
                    </p>
                    <p>&nbsp;</p>
                    <p>
                    <div class="filme-label">Genero: </div>
                    <div class="filme-info-desc">{{ $filme->genero_code}}</div>
                    </p>
                    
                    <p>
                    <div class="filme-label">Ano: </div>
                    <div class="filme-info-desc">{{ $filme->ano}}</div>
                    <!-- <div class="filme-info-trailer">{{ $filme->trailer_url}}</div> -->

                    <?php 
                     $url= $filme->trailer_url;
                     $urlParts   = explode('/', $url);
                     $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );

                     $trailer= 'https://www.youtube.com/embed/' . $vidid[0] ;
                    ?>  
                                    
                      <iframe width="430" height="315" src="{{ $trailer}}"
                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                        clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   
                    </p>
                </div>
            </div>
        </div>
    </div>



    @if(!empty($sessoes))
    <div class="filme-label">Sessão: </div>
    <select name="sessao" id="idSessao">
        @foreach($sessoes as $abr => $id)
        <option value="{{$abr}}" {{old('sessao')==$abr?'selected':''}}>{{$id->data}} {{$id->horario_inicio}} Sala:
            {{$id->sala_id}}</option>
        @endforeach
    </select>

    <div class="filme-label">Fila: </div>
    <select name="fila" id="idFila">

    </select>

    <div class="cart-btn">
        <button class="btn btn-primary" type="submit">ADD to Cart</button>
    </div>
    
    @else
    <div class="aviso">Sem sessões disponiveis para este filme</div>
    
    @endif

</form>
</div>
@endsection