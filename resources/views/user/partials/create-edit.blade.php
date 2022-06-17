<table class="table table-bordered table-striped table-sm">

<div class="main">
    <form >
        @csrf
        <div class="col-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <div class="col-12">
            <!-- email_verified_at need to verify to put date  -->
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>


        <div class="col-12">
            <label for="name" class="form-label">Tipo</label>
            <select class="form-control" name="tipo_pagamento" id="tipo_pagamento" value="{{ $user->tipo }}">
            <option >Escolha</option>
                <option value="A">Administrador</option>
                <option value="F">Funcionario</option>
                <option value="C">Cliente</option>

            </select>
        </div>

        <div class="form-group">
    <div class="form-check form-check-inline">
        <input type="hidden" name="bloquado" value="0">
        <input type="checkbox" class="form-check-input" id="inputAdmin" name="admin" value="1" {{old('admin', $user->bloqueado) == '1' ? 'checked' : ''}}>
        <label class="form-check-label" for="inputAdmin">
            Bloqueado
        </label>
    </div>
    @error('admin')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

        <div class="col-12">
            <!-- password_updated_at to put date of password change -->
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="col-12">
            <label for="photo" class="form-label">Photo Link</label>
            <input type="file" id="photo" name="photo" class="form-control">
        </div>

        
    </form>
</div>

</table>


