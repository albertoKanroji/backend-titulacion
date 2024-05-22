<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Información del Grupo Muscular') }}</h6>
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
                    <span class="alert-text text-white">{{ __('Grupo Muscular Guardado Correctamente') }}</span>
                    <button wire:click="$set('showSuccesNotification', false)" type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="form-control-label">{{ __('Nombre') }}</label>
                                <div class="@error('nombre')border border-danger rounded-3 @enderror">
                                    <input wire:model="nombre" class="form-control" type="text" placeholder="Nombre"
                                        id="nombre">
                                </div>
                                @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">{{ __('Descripción') }}</label>
                                <div class="@error('descripcion')border border-danger rounded-3 @enderror">
                                    <input wire:model="descripcion" class="form-control" type="text"
                                        placeholder="Descripción" id="descripcion">
                                </div>
                                @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen" class="form-control-label">{{ __('Imagen') }}</label>
                                <div class="@error('imagen')border border-danger rounded-3 @enderror">
                                    <input type="file" class="form-control" id="imagen" wire:model="imagen">
                                </div>
                                @error('imagen') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    @if ($grupoMuscularId && $grupoMuscular = \App\Models\GruposMusculares::find($grupoMuscularId))
                    @if ($grupoMuscular->imagen)
                    <div class="form-group">
                        <label>Imagen Actual</label>
                        <img src="data:image/jpeg;base64,{{ $grupoMuscular->imagen }}" class="img-fluid">
                    </div>
                    @endif
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ $grupoMuscularId ? 'Actualizar Grupo Muscular' : 'Guardar Grupo Muscular' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>