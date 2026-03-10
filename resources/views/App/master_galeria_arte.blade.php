<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galería de Arte')</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
  
    </style>
</head>
<body class="bg-gray-100 font-sans" v-cloak>

    <!-- NAVBAR SIMPLE -->
<!-- NAVBAR SIMPLE -->
<nav class="bg-gray-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex items-center">
                <!-- Título/Logo -->
                <span class="text-white text-xl font-bold flex-shrink-0">@yield('header', 'Galería de Arte')</span>
                
                <!-- Contenedor de Botones de Catálogos -->
                <div class="flex items-center ml-8 space-x-4">
                    <!-- Botón Productos -->
                    <a href="{{route('Galeria.catalogo_productos')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm transition duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Catálogo Productos 
                    </a>
                     <a href="{{route('Rol.index')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm transition duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Catálogo Rol
                    </a>
                     <a href="{{route('catalogo_adicionales')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm transition duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Catalogo Adicionales
                    </a>
                     <a href="{{route('catalogo_tipos')}}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm transition duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Catalogo Tipos
                    </a>
                </div>
            </div>
            
            <!-- Botón Derecha -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('Galeria.home') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium border border-gray-600 hover:border-white transition-colors">
                    Volver al Home
                </a>
            </div>
            
        </div>
    </div>
</nav>

 <aside>
<!-- Envuelve TODO (botón y menú) en este contenedor -->

</aside>
    <!-- CONTENIDO PRINCIPAL -->
    <div class="container mx-auto px-4 py-8">
         @yield('catalogos') 

        @yield('content')
    </div>

    <!-- SCRIPTS -->
  <script src="{{asset('galeria_arte\dist\vue.js')}}"></script>
    <script>
        

    </script>
    @yield('scripts')

</body>
</html>