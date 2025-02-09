<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            width: 350px;
            color: white;
        }
        .input-group-text {
            background: transparent;
            border: none;
            color: white;
        }
        .form-control {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        .form-control:focus {
            background: transparent;
            border-color: white;
            box-shadow: none;
        }
        .btn-custom {
            background: #1a73e8;
            border: none;
            color: white;
        }
        .btn-custom:hover {
            background: #1358c8;
        }
    </style>
</head>
<body>
    <div class="login-container text-center">
        <div class="mb-4">
            <i class="fas fa-store fa-3x"></i>
            <h2 class="mt-2">Sistema de Ventas</h2>
        </div>
        <form method="POST" action="{{route('identificacion')}}">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Ingrese usuario" value="{{old('name')}}">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese contraseña">
                </div>
            </div>
            <button type="submit" class="btn btn-custom w-100">Ingresar</button>
        </form>
        <p class="mt-4 text-light small">2025 &copy; Sistema de Ventas & ABC.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
