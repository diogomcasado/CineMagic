<table class="table table-bordered table-striped table-sm">

<div class="form-group">
 <label for="inputAbr">Nome</label>
  <input type="text" class="form-control" name="sala" id="inputAbr"  />

    @error('nome')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

</table>


