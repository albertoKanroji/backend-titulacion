<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">

                @if ($showDemoNotification)
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">
                        {{ __('You are in a demo version, you can\'t update the profile.') }}
                    </span>
                    <button wire:click="$set('showDemoNotification', false)" type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($showSuccesNotification)
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text text-white">{{ __('Cliente Guardado Correctamente') }}</span>
                    <button wire:click="$set('showSuccesNotification', false)" type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-nombre" class="form-control-label">{{ __('Nombre') }}</label>
                                <div class="@error('cliente.nombre')border border-danger rounded-3 @enderror">
                                    <input wire:model="cliente.nombre" class="form-control" type="text"
                                        placeholder="Nombre" id="cliente-nombre">
                                </div>
                                @error('cliente.nombre') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-apellido" class="form-control-label">{{ __('Apellido') }}</label>
                                <div class="@error('cliente.apellido')border border-danger rounded-3 @enderror">
                                    <input wire:model="cliente.apellido" class="form-control" type="text"
                                        placeholder="Apellido" id="cliente-apellido">
                                </div>
                                @error('cliente.apellido') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-apellido2" class="form-control-label">{{ __('Segundo Apellido')
                                    }}</label>
                                <div class="@error('cliente.apellido2')border border-danger rounded-3 @enderror">
                                    <input wire:model="cliente.apellido2" class="form-control" type="text"
                                        placeholder="Segundo Apellido" id="cliente-apellido2">
                                </div>
                                @error('cliente.apellido2') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-correo" class="form-control-label">{{ __('Correo') }}</label>
                                <div class="@error('cliente.correo')border border-danger rounded-3 @enderror">
                                    <input wire:model="cliente.correo" class="form-control" type="email"
                                        placeholder="Correo" id="cliente-correo">
                                </div>
                                @error('cliente.correo') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-password" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('cliente.password')border border-danger rounded-3 @enderror">
                                    <input wire:model="cliente.password" class="form-control" type="password"
                                        placeholder="Contraseña" id="cliente-password">
                                </div>
                                @error('cliente.password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente-status" class="form-control-label">{{ __('Status') }}</label>
                                <select wire:model="cliente.status" class="form-select" id="cliente-status">
                                    <option value="">Seleccionar</option>
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>
                                </select>
                                @error('cliente.status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ $cliente->exists ?
                            'Actualizar Cliente' : 'Guardar Cliente' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>