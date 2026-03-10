@extends('App.master_galeria_arte')

    

{{-- 2. Inyectar el Título de la pestaña del navegador --}}
@section('title', 'Gestión de Adicionales')


@section('content')
<section id="app" >
        <div class="container mx-auto px-4" >
            <!-- Si mostrarFormulario=false, se vuelve true -->
                <div v-if="!mostrarFormulario">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Catalogo Adicionales</h2>
                        <button 
                            @click="nuevo"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Agregar Adicional
                        </button>
                    </div>

                
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr class="bg-gray-700 text-white text-left text-xs uppercase font-semibold tracking-wider">
                                        <th class="px-5 py-3">ID</th>
                                        <th class="px-5 py-3">Nombre de Adicional</th>
                                        <th classz="px-5 py-3">Tipo</th>                                
                                        <th class="px-5 py-3">Precio</th>
                                        <th class="px-5 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    <!-- v-for repite este <tr> por cada rol -->
                                    <tr v-for="adicional in adicionales" :key="adicional.id" class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-5 py-5 text-sm">@{{ adicional.id }}</td>
                                        <td class="px-5 py-5 text-sm font-bold">@{{ adicional.nombre }}</td>
                                        <td class="px-5 py-5 text-sm font-bold">@{{ adicional.tipo_nombre }}</td>
                                        <td class="px-5 py-5 text-sm text-gray-600">$@{{ adicional.precio }}</td>
                                        <td class="px-5 py-5 text-sm text-center">
                                            <button 
                                                @click="editarAdicional(adicional)" 
                                                class="text-indigo-600 hover:text-indigo-900 font-medium mr-3">
                                                Editar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="adicionales.length === 0">
                                        <td colspan="4" class="px-5 py-5 text-center text-gray-500">No hay adicionales registrados.</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex justify-center items-center" role="alert">
                                <strong class="font-bold mr-1">¡Éxito!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>

                            @endif
                              @if(session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex justify-center items-center" role="alert">
                                    <strong class="font-bold mr-1">¡Error!</strong>
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                            
                            <div v-else>
                           
                            <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
                                 <div class="bg-gray-700 px-6 py-4 flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-white">
                                        @{{ operacion==='Agregar'? 'Nuevo Adicional':'Editar Adicional ' + form.nombre}}
                                         
                                    </h3>
                                    <button @click="cancelar" class="text-gray-300 hover:text-white text-2xl">&times;</button>
                                </div>
                                  
                                <form method="POST" enctype="multipart/form-data" class="p-6" action="{{route('Adicionales.save')}}">
                                    @csrf
                                    <input type="hidden" name="id" :value="form.id">

                                    <div class="grid grid-cols-1 gap-6">
                                           <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre Adicional</label>
                                                <input type="text" name="nombre" v-model="form.nombre" required
                                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-2">Tipo</label>
                                                <select name="idtipo" v-model="form.idtipo" required
                                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                                                    <option value="" disabled>Seleccione un tipo</option>
                                                    <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id">
                                                        @{{ tipo.nombre }}
                                                    </option>
                                                </select>
                                            </div>
                                             <div>
                                                <label class="block text-gray-700 text-sm font-bold mb-2">Precio</label>
                                                <input type="number" step="0.01" name="precio" v-model="form.precio" required
                                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>
                                           
                                    </div>

                                               <div class="mt-8 pt-4 border-t border-gray-200 flex justify-between items-center">
                            
                            <!-- Botón Eliminar (solo en edición) -->
                            <div>
                                <button v-if="operacion === 'Editar'"
                                    type="submit" 
                                    name="operacion" 
                                    value="Eliminar"
                                    onclick="return confirm('¿Eliminar este producto permanentemente?')"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
                                    Eliminar
                                </button>
                            </div>

                            <!-- Botones Cancelar y Guardar -->
                            <div class="flex space-x-3">
                                <button type="button" @click="cancelar" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Cancelar
                                </button>
                                <button type="submit" name="operacion" :value="operacion"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                                    @{{ operacion }}
                                </button>
                            </div>
                        </div>

                                </form>

                            </div>
                    </div>
                </div>

            

        </div>
</section>

    
  <script src="{{asset('galeria_arte\dist\vue.js')}}"></script>
    
    <script>
        new Vue({
                el: '#app',            
                data:function(){
                return{
                    adicionales:@JSON($adicionales),
                    tipos:@JSON($tipos),
                    mostrarFormulario:false,
                    operacion:'Agregar',
                    form:{
                        id:'',
                        nombre:'',
                        descripcion:'',
                        tipo:'',
                        precio:'',
                    }
                }
            },

            methods:{
                nuevo(){
            this.operacion='Agregar';
                    this.resetForm();//Para mostrar el formulario limpio
                    this.mostrarFormulario= true;
                },

                editarAdicional(adicional){
                    this.operacion='Editar';
                    this.mostrarFormulario=true;
                    this.form.id=adicional.id;
                    this.form.tipo=adicional.idtipo;
                    this.form.nombre=adicional.nombre;
                    this.form.precio=adicional.precio;
                    this.form.descripcion=adicional.descripcion;
                },
                cancelar(){
                    this.resetForm();
                    this.mostrarFormulario=false;
                },
                 resetForm: function() {
                    this.form = {
                        id:'',
                        nombre:'',
                        descripcion:'',
                        tipo:'',
                        precio:'',
                    };
                }
            },
    })

    </script>

@endsection