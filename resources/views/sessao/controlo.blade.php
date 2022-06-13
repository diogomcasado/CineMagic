@extends('layouts.app')


<link href="{{ asset('css/sessao/sessao.css') }}" rel="stylesheet">


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
            <label for="name" class="form-label">Filme: </label>
            <select name="filme" id="idFilme">
                @foreach($filmesListFinal as $abr)
                <option value="{{$abr->id}}">{{$abr->titulo}}</option>
                @endforeach
            </select>

        </div>

        <div class="col-12">
            <label for="sessao" class="form-label">Sala: </label>
            <select name="city_id" id="sessao" class="form-control">
                <option value="">{{ trans('global.pleaseSelect') }}</option>
            </select>

        </div>
        
        <div class="col-12">
            <label for="email" class="form-label">Horario: </label>
        </div>
        

        <div class="btn">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Guardar</button>
        </div>

        @else
        <div class="aviso">Sem filmes disponiveis</div>

        @endif
    </form>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#idFilme").change(function(){
            $.ajax({
                url: "{{ route('controlo.sessao') }}?filme_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#sessao').html(data.html);
                }
            });
        });
    </script>
@endsection