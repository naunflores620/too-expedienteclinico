<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>SoftClinic</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/template.css" rel="stylesheet">

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
      <div id="app">

        <!-- Contenido Principal -->
        @yield('contenido') 
        <!-- /Fin del contenido principal -->
    </div>
    </div>

    <script src="js/app.js"></script>
    <script src="js/template.js"></script>
</body>

</html>