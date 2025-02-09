@extends('layouts.plantilla')

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('dashboard') }}" method="GET" class="p-3 bg-light rounded shadow-sm">
                <div class="form-row align-items-center">
                    <div class="col-md-3 mb-2">
                        <label for="fecha" class="font-weight-bold">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}" class="form-control shadow-sm">
                    </div>

                    <div class="col-md-3 mb-2">
                        <label for="categoria_id" class="font-weight-bold">Categoría:</label>
                        <select name="categoria_id" id="categoria_id" class="form-control shadow-sm">
                            <option value="">Todas</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->idcategoria }}"
                                    {{ request('categoria_id') == $categoria->idcategoria ? 'selected' : '' }}>
                                    {{ $categoria->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block mt-4 shadow-sm">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Cards de Resultados -->
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info shadow-lg rounded-lg p-3">
                <div class="inner">
                    <h3 class="font-weight-bold">S/.{{ number_format($ventas_diarias, 2) }}</h3>
                    <p class="font-weight-bold">Ventas Diarias</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day text-bold"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success shadow-lg rounded-lg p-3">
                <div class="inner">
                    <h3 class="font-weight-bold">S/.{{ number_format($ventas_totales, 2) }}</h3>
                    <p class="font-weight-bold">Ventas Totales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line text-bold"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger shadow-lg rounded-lg p-3">
                <div class="inner">
                    <h4 class="font-weight-bold">{{ $producto_mas_solicitado->descripcion }}</h4>
                    <p class="font-weight-bold">Ventas: {{ $producto_mas_solicitado->cantidad }} unidades</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box text-bold"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning shadow-lg rounded-lg p-3">
                <div class="inner">
                    <h4 class="font-weight-bold">Mes con Más Ventas</h4>
                    <p class="font-weight-bold">Mes: {{ $mes_mas_ventas->mes }} (S/.{{ number_format($mes_mas_ventas->total_ventas, 2) }})</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt text-bold"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Gráficos -->
    <div class="row mt-3">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card shadow-lg rounded-lg w-50">
                <div class="card-body">
                    <h4 class="font-weight-bold text-center">Ventas por Tipo</h4>
                    <canvas id="ventasTipoChart" style="height: 150px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card shadow-lg rounded-lg w-100">
                <div class="card-body">
                    <h4 class="font-weight-bold text-center">Ventas por Talla</h4>
                    <canvas id="ventasTallaChart" style="height: 150px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para los gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ventasTipoChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($ventas_tipo->pluck('tipo')->toArray()),
                datasets: [{
                    data: @json($ventas_tipo->pluck('total_ventas')->toArray()),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCD56'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCD56'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': S/. ' + tooltipItem.raw.toFixed(2);
                            }
                        }
                    }
                }
            }
        });

        var ctxTalla = document.getElementById('ventasTallaChart').getContext('2d');
        new Chart(ctxTalla, {
            type: 'bar',
            data: {
                labels: @json($tallas_mas_vendidas->pluck('talla')->toArray()),
                datasets: [{
                    label: 'Ventas por Talla',
                    data: @json($tallas_mas_vendidas->pluck('cantidad')->toArray()),
                    backgroundColor: '#36A2EB',
                    borderColor: '#1E88E5',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection
