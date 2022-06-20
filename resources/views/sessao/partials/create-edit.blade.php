<table class="table table-bordered table-striped table-sm">

<div class="form-group">
 <label for="inputAbr">Filme id</label>
  <input type="text" class="form-control" name="filme_id" id="inputFilme" value="{{old('filme_id', $sessao->filme_id)}}" />
    @error('filme_id')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
  <label for="inputNome">Sala id</label>
  <input type="text" class="form-control" name="sala_id" id="inputSala" value="{{old('sessao', $sessao->sala_id)}}" />
    @error('sala_id')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
  <label for="inputNome">Data</label>
  <input type="text" class="form-control" name="data" id="inputData" value="{{old('data', $sessao->data)}}" />
    @error('data')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
  <label for="inputNome">Hora Inicio</label>
  <input type="text" class="form-control" name="Hora" id="inputHora" value="{{old('sessao', $sessao->horario_inicio)}}" />
    @error('horario_inicio')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


</table>


