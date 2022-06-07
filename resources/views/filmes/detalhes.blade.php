@extends('layouts.app')


<link href="{{ asset('css/filmes/detalhes.css') }}" rel="stylesheet">


@section('content')



<div class="titulo">
    <h2>{{ $filme->titulo }}</h2>
</div>

<form action="{{ route('cart.store') }}" method="post">
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
                    <div class="flex-container">
                        <div class="filme-label">Sumario: {{ $filme->sumario}}</div>
                        <div class="filme-label">Genero: {{ $filme->genero_code}}</div>
                        <div class="filme-label">Ano: {{ $filme->ano}}</div>

                        <!-- <div class="filme-info-trailer">{{ $filme->trailer_url}}</div> -->

                        <?php 
                     $url= $filme->trailer_url;
                     $urlParts   = explode('/', $url);
                     $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );

                     $trailer= 'https://www.youtube.com/embed/' . $vidid[0] ;
                    ?>

                        <iframe width="430" height="315" src="{{ $trailer}}" title="YouTube video player"
                            frameborder="0" allow="accelerometer; autoplay; 
                        clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>

                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="sessao-cart">
        @if(!empty($sessoes))
        <div class="filme-label">Sessão: </div>
        <select name="sessao" id="idSessao">
            @foreach($sessoes as $abr => $id)
            <option value="{{$abr}}" {{old('sessao')==$abr?'selected':''}}>{{$id->data}} {{$id->horario_inicio}} Sala:
                {{$id->sala_id}}</option>
            <input type="hidden" value="{{ $id->id }}" name="id">
            <input type="hidden" value="{{ $id }}" name="sessao">
            @endforeach
        </select>

        <div class="filme-label">Fila: </div>
        <!--<select name="fila" id="idFila">

    </select>-->
    <input type="hidden" value="{{ $filme->titulo }} {{$id->data}} {{$id->horario_inicio}} Sala: {{$id->sala_id}}" name="name">
    <input type="hidden" value="1" name="quantity">
    <input type="hidden" value="{{ Storage::url('/cartazes/' . $filme->cartaz_url) }}"  name="image">



        <div class="cart-btn">
            <button class="btn btn-primary" type="submit">Adicionar ao carrinho</button>
        </div>

        @else
        <div class="aviso">Sem sessões disponiveis para este filme</div>

        @endif
    </div>

</form>
</div>
@endsection