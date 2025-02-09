<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Sistema Ventas</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/adminlte/dist/js/adminlte.min.js"></script>

    <link rel="stylesheet" href="archivos/css/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> Administrador
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ route('login') }}">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center">
                <img src="/adminlte/dist/img/shop.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="text-muted" style="font-size: 14px; color:rgb(216, 216, 216); margin-top:1rem">Operaciones</li>
                            <hr>

                        <li class="nav-item">
                            <a href="{{ route('clientes.index') }}"
                                class="nav-link {{ Request::is('cliente*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('categorias.index') }}"
                                class="nav-link {{ Request::is('categoria*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Categorías</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('tallas.index') }}"
                                class="nav-link {{ Request::is('talla*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-ruler-vertical"></i>
                                <p>Tallas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('productos.index') }}"
                                class="nav-link {{ Request::is('producto*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Productos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('ventas.index') }}"
                                class="nav-link {{ Request::is('ventas*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                @yield('contenido')
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Demo</b>
            </div>
            <strong>&copy; 2025 <a href="{{ route('dashboard') }}">Sistema Venta</a>. Todos los derechos
                reservados.</strong>
        </footer>
    </div>
    @yield('script')
</body>

</html>
