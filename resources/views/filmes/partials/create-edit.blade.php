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
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
  <label for="inputNome">URL Trailer</label>
  <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('URLTrailer', $filme->trailer_url)}}" />
    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputGenero">Genero</label>
    <select class="form-control" name="Genero" id="inputGenenro">
    @foreach ($generos as $abr => $nome)
           <option value={{$abr}} {{$abr == old('filme', $filme->genero_code) ? 'selected' : ''}}>{{$nome}}</option>
        @endforeach
    </select>
    @error('genero')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>




<div class="form-group">
    <label for="inputCartaz">Upload da Cartaz</label>
    <input type="file" class="form-control" name="cartaz" id="inputCartaz">
    @error('cartaz')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
</table>


