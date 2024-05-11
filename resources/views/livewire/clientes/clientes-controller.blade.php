<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>Clientes</h6>
                            <button class="btn btn-primary" wire:click="irACrearCliente()">Agregar Cliente</button>

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cliente</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Inscrito</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="https://firebasestorage.googleapis.com/v0/b/infinitytech-15a41.appspot.com/o/user.png?alt=media&token=6d9838ed-5f9d-441f-aae5-848ec0fbc0ca" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $cliente->nombre }}
                                                        {{ $cliente->apellido }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $cliente->correo }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($cliente->status == 1)
                                            <span class="badge badge-sm bg-gradient-success">Activo</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-secondary">No Activo</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $cliente->created_at }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                        <!-- Agrega más columnas si es necesario -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
