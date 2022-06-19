<table class="table table-bordered table-striped table-sm">

<div class="form-group">
 <label for="inputAbr">Titulo</label>
  <input type="text" class="form-control" name="titulo" id="inputAbr" value="{{old('titulo', $filme->titulo)}}" />
    @error('titulo')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
  <label for="inputNome">Sumario</label>
  <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('sumario', $filme->sumario)}}" />
    @error('sumario')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
  <label for="inputNome">URL Trailer</label>
  <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('URLTrailer', $filme->trailer_url)}}" />
    @error('url_trailer')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputGenero">Genero</label>
    <select class="form-control" name="Genero" id="inputGenenro">
    @foreach ($generos as $genero)
           <option value="{{$genero->code}}" {{ old("genero_code") == $genero->code ? "selected" : "" }}>
                        {{$genero->code}}
                    </option>
        @endforeach
    </select>
 
</div>

<div class="form-group">
    <label for="inputCartaz">Upload da Cartaz</label>
    <input type="file" class="form-control" name="cartaz" id="inputCartaz">
    
</div>
</table>


