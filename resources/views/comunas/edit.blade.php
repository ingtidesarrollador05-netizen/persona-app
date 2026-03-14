<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Comuna</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Editar</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('comunas.update', ['comuna' => $comuna->comu_codi]) }}">
                    @method('PUT')
                    @csrf

                    {{-- campo ID  --}}
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">Comune ID</label>
                        <input type="text" class="form-control bg-light" id="id" name="id" disabled value="{{$comuna->comu_codi}}">
                    </div>

                    {{-- campo Municipio --}}
                    <div class="mb-4">
                        <label for="municipality" class="form-label fw-bold">Municipio</label>
                        <select class="form-select border-primary" id="municipality" name="code" required>
                            <option disabled value="">Choose one..</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->muni_codi }}" 
                                    {{-- Si el código del municipio actual coincide con el de la comuna (editando un registro),imprime el atributo 'selected' para que aparezca marcado por defecto.--}}
                                    {{ $municipio->muni_codi == $comuna->muni_codi ? 'selected' : '' }}>
                                    {{ $municipio->muni_nomb }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>

                    {{-- ubicación superior --}}
                    <div class="row g-3 p-3 bg-light rounded border mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Departamento Actual</label>
                            {{-- etiqueta q muestra q el valor es nulo, debido a q al seleccionar de municipio se llenan esos campos readonly sirve para mostrar el campo en gris mostrando el campo como no operar "Solo lectura pero aparece N/A por q no hay nada debido a no se establese municipio"--}}
                            <input type="text" class="form-control form-control-sm" value="{{ $comuna->depa_nomb ?? 'N/A' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">País Actual</label>
                            <input type="text" class="form-control form-control-sm" value="{{ $comuna->pais_nomb ?? 'N/A' }}" readonly>
                        </div>
                    </div>
                    {{-- BOTONES DE CANCELAR Y ACTUALIZAR JIJIJA --}}
                    <div class="d-flex justify-content-between"> 
                        <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{route('comunas.index') }}" class="btn btn-warning">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>