 <div class="container">
    <form wire:submit.prevent='login'>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" wire:model='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('email') <span class="text-danger">{{$message}}</span>@enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" wire:model='password' class="form-control" id="exampleInputPassword1">
        </div>
        @error('error') <span class="text-danger">{{$message}}</span>@enderror
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>