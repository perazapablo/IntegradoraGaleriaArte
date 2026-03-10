<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
      <title>Art Gallery | Studio</title>
      <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <style>
        /* Base Styles */
        body { font-family: 'Inter', sans-serif; background-color: #fdfcf8; color: #1c1917; }
        h1, h2, h3, h4, .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Custom Scrollbar para un look más limpio */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e5e5e5; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #d4d4d4; }
        
        /* Utilitario para ocultar scrollbar en elementos horizontales pero permitir scroll */
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
      </style>
    </head>
    
    <body class="antialiased selection:bg-orange-100 selection:text-orange-900">
      <div id="app">
        <div class="relative flex h-screen w-full overflow-hidden bg-[#fdfcf8]">
          
          <div class="flex flex-1 flex-col h-full relative z-10">
              
              <header class="flex items-center justify-between px-8 py-6 md:px-12 md:py-8 bg-[#fdfcf8]/90 backdrop-blur-sm sticky top-0 z-20">
                <div class="flex items-baseline gap-1">
                  <h2 class="text-3xl font-serif font-bold tracking-tight text-gray-900">Studio<span class="text-orange-600">.</span></h2>
                </div>
                
                <nav class="hidden md:flex gap-8 text-xs font-medium uppercase tracking-[0.2em] text-gray-400">
                  <a class="hover:text-black transition-colors duration-300 relative group" href="#">
                      Inventario
                      <span class="absolute -bottom-1 left-0 w-0 h-px bg-black transition-all group-hover:w-full"></span>
                  </a>
                  <a class="hover:text-black transition-colors duration-300 relative group" href="#">
                      Exhibiciones
                      <span class="absolute -bottom-1 left-0 w-0 h-px bg-black transition-all group-hover:w-full"></span>
                  </a>
                </nav>

                <div class="flex items-center gap-6">
                    <button @click="catalogo" class="group flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                      <span>Admin</span>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                      </svg>
                    </button>
                    <div class="h-10 w-10 rounded-full bg-gray-200 border border-gray-300 overflow-hidden cursor-pointer hover:ring-2 hover:ring-orange-200 transition-all">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=random&color=fff" class="w-full h-full object-cover opacity-90 hover:opacity-100">
                    </div>
                </div>
              </header>

              <main class="flex-1 overflow-y-auto px-8 md:px-12 pb-20">
                
                <div class="mb-16 mt-4">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-gray-200 pb-2">
                      <div>
                          <span class="text-xs font-bold text-orange-600 uppercase tracking-widest mb-2 block">Colección 2026</span>
                          <h1 class="text-5xl md:text-6xl font-serif text-gray-900 leading-tight">
                              Nueva <br><span class="italic text-gray-500">Adquisición</span>
                          </h1>
                      </div>
                      
                      <div class="flex items-center gap-6 overflow-x-auto hide-scroll pb-2 md:pb-0">
                          <div v-for="tipo in tipos" :key="tipo.id">
                              <button 
                                  @click="categoria_seleccionada=tipo.id" 
                                  :class="{
                                      'text-black border-b-2 border-black': tipo.id == categoria_seleccionada,
                                      'text-gray-400 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-200': tipo.id != categoria_seleccionada 
                                  }"
                                  class="pb-2 text-sm uppercase tracking-widest font-medium transition-all duration-300 whitespace-nowrap">
                                  @{{tipo.nombre}}
                              </button>
                          </div>
                      </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="h-px bg-gray-200 flex-1"></div>
                        <h2 class="font-serif text-2xl italic text-gray-600">@{{productos_categoria}}</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-10 gap-y-16" id="producto">
                  
                  <div class="group relative flex flex-col" v-for="producto in filtro_categoria" :key="producto.id">
                      
                      <div class="relative aspect-[4/5] overflow-hidden bg-gray-100 mb-6 cursor-pointer">
                        
                          <img :src="imagenesXTipo[producto.idtipo] || imagenesXTipo[1]"
                              class="h-full w-full object-cover transition-transform duration-1000 ease-out group-hover:scale-110 grayscale-[20%] group-hover:grayscale-0" />
                          
                          <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                              <button @click="agregar_orden(producto)" 
                                      class="transform translate-y-4 group-hover:translate-x-0 transition-transform duration-300 bg-white text-black px-8 py-4 text-xs font-bold uppercase tracking-[0.25em] hover:bg-black hover:text-white border border-white">
                                  Adquirir
                              </button>
                          </div>
                      </div>

                      <div class="flex justify-between items-start gap-4">
                          <div>
                              <h3 class="text-2xl font-serif text-gray-900 mb-1 group-hover:text-orange-700 transition-colors">@{{producto.nombre}}</h3>
                              <p class="text-xs text-gray-500 uppercase tracking-wide line-clamp-2">@{{producto.descripcion}}</p>
                          </div>
                          <span class="text-lg font-serif italic text-gray-900 whitespace-nowrap">$ @{{producto.precio}}</span>
                      </div>
                  </div>
                </div>

              </main>
          </div>

          <transition 
              enter-active-class="transition ease-out duration-300"
              enter-from-class="translate-x-full opacity-0"
              enter-to-class="translate-x-0 opacity-100"
              leave-active-class="transition ease-in duration-200"
              leave-from-class="translate-x-0 opacity-100"
              leave-to-class="translate-x-full opacity-0">

              <aside v-if="orden.length>0" class="w-full md:w-[450px] bg-[#1c1917] text-white flex flex-col shadow-2xl relative z-30 border-l border-gray-800">
                  
                  <div class="p-10 border-b border-white/10 flex justify-between items-center">
                      <div>
                          <h2 class="text-3xl font-serif italic text-white">Su Selección</h2>
                        
                      </div>
                      <button @click="vaciar_carrito" class="group text-gray-500 hover:text-red-400 transition-colors flex flex-col items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                          <span class="text-[9px] uppercase mt-1 opacity-0 group-hover:opacity-100 transition-opacity">Vaciar</span>
                      </button>
                  </div>
                  
                  <div class="flex-1 overflow-y-auto p-10 space-y-8">
                      <div class="group relative flex gap-5 animate-fadeIn" v-for="(producto,indice) in orden" :key="producto.id">
                          
                          <div class="h-24 w-20 bg-gray-800 shrink-0 overflow-hidden relative">
                              <img src="https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=200&q=80" class="h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                          </div>

                          <div class="flex-1 flex flex-col justify-between py-1">
                              <div class="flex justify-between items-start">
                                  <h4 class="text-sm font-serif text-white tracking-wide">@{{producto.nombre}}</h4>
                                  
                              
                                  <button @click="eliminar(producto)" class="text-gray-600 hover:text-white transition-colors p-1">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                  </button>
                              </div>
                              <h4 class="text-sm font-serif text-white tracking-wide">@{{producto.descripcion}}</h4>
                              <button @click="mostrarAdds(indice)" 
                                      class="text-gray-400 hover:text-orange-400 transition-colors p-1" title="Agregar Adicionales">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                      <p>Personalizar</p>
                                  </svg>

                              </button>
                              <div class="flex items-end justify-between border-t border-white/10 pt-3 mt-2">
                                  <span class="text-[10px] text-gray-400 font-bold tracking-wider uppercase">Precio Unitario</span>
                                  <span class="text-base font-light tracking-wide text-orange-200">$@{{producto.precio}}</span>
                              </div>
                          </div>
                      </div>
                  </div>


                  <div class="bg-[#151311] p-10 border-t border-white/10">
                      <div class="space-y-3 mb-8">
                          <div class="flex justify-between text-xs text-gray-400 uppercase tracking-widest">
                              <span>Subtotal</span>
                              <span class="text-white">$@{{orden_summary.subtotal}}</span>
                          </div>
                          <div class="flex justify-between text-xs text-gray-400 uppercase tracking-widest">
                              <span>Impuestos (16%)</span>
                              <span class="text-white">$@{{orden_summary.impuesto}}</span>
                          </div>
                      </div>

                      <div class="flex justify-between items-baseline pt-6 border-t border-dashed border-white/20 mb-8">
                          <span class="text-xl font-serif italic">Total</span>
                          <span class="text-3xl font-light text-orange-500">$@{{orden_summary.total}}</span>
                      </div>

                      <button @click="enviarOrden" class="w-full relative overflow-hidden group bg-white text-black py-5 px-4 transition-all duration-300 hover:bg-orange-600 hover:text-white">
                          <span class="relative z-10 text-xs font-bold uppercase tracking-[0.35em] flex items-center justify-center gap-2">
                              Finalizar Transacción
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                              </svg>
                          </span>
                      </button>
                  </div>              

                  
              </aside>
          </transition>
          <transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
          >
            <div v-if="mostrarExtras" class="fixed inset-0 z-50 flex items-center justify-center px-4">
              
              <div class="absolute inset-0 bg-[#1c1917]/80 backdrop-blur-sm" @click="mostrarExtras = false"></div>

              <div class="relative w-full max-w-lg bg-[#fdfcf8] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-white">
                  <div>
                    <span class="text-xs font-bold text-orange-600 uppercase tracking-widest block mb-1">Personalización</span>
                    <h3 class="text-2xl font-serif text-gray-900 italic">Acabados & Marcos</h3>

                  </div>
                  <button @click="mostrarExtras = false" class="text-gray-400 hover:text-black transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
                <div class="p-8 overflow-y-auto bg-[#fdfcf8]">

                  <p class="text-sm text-gray-500 mb-6 font-light">Seleccione los tratamientos adicionales para la conservación y exhibición de la obra.</p>
                  <div class="space-y-4">
                  
                  <div > 
                    <h4 class="font-serif text-lg text-gray-900">Extras para @{{adicionaltipo}}</h4>
                    <label @click="agregarAdicional(add)" v-for="add in filtro_adicionales" class="group cursor-pointer relative block">
                      <div >
                        <input type="checkbox" :value="tipo" class="peer sr-only">

                      <div class="flex items-center justify-between p-4 border border-gray-200 bg-white transition-all duration-300 
                                  group-hover:border-orange-200 
                                  peer-checked:border-black peer-checked:bg-orange-50/30 peer-checked:shadow-md">
                        
                        <div class="flex items-center gap-4">
                          <div class="w-5 h-5 border border-gray-300 flex items-center justify-center transition-colors
                                      peer-checked:bg-black peer-checked:border-black">
                            <div class="w-2.5 h-2.5 bg-black peer-checked:bg-white"></div>
                          </div>

                          <div>
                              <h2> @{{add.nombre}}</h2>
                              <h3>Precio $@{{add.precio}}</h3>

                            </div>
                        </div>

                        <div class="text-right">
                        
                        </div>
                      </div>
                      
                      <div class="absolute -top-2 -right-2 bg-black text-white text-[9px] px-2 py-1 uppercase tracking-widest font-bold opacity-0 transition-opacity peer-checked:opacity-100 shadow-sm">
                        Añadido
                      </div>
                      </div>
                      
                    </label>
                  </div>
                    
                  </div>
                </div>

                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                  <div class="text-sm">
                      <span class="text-gray-500 mr-2">Costo Extra:</span>
                      <span class="font-serif font-bold text-lg">$0.00</span> 
                  </div>
                  
                  <button @click="" class="bg-[#1c1917] hover:bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-[0.2em] transition-colors shadow-lg">
                    Confirmar Cambios
                  </button>
                </div>

              </div>
            </div>
          </transition>                                                                       

        </div>
        
      </div>
    </body>
    
    <script src="{{asset('galeria_arte\dist\vue.js')}}"></script>
    <script>
      var app= new Vue({
        
      el:'#app',
      data:function(){
          return{
              productos:[],//Hay veo como paso los datos al formato correspondiente
              orden:[],
              adicionales:[],
              adicionalesxtipos:0,            
              tipos: @JSON($tipos),//tipo de producto
              imagenesXTipo: {
              1: 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=800&q=80', // Fotografía
              2: 'https://images.unsplash.com/photo-1561214115-f2f134cc4912?auto=format&fit=crop&w=800&q=80', // Escultura
              3: 'https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&w=800&q=80', // Pintura
              4: 'https://images.unsplash.com/photo-1513519245088-0e12902e35ca?auto=format&fit=crop&w=800&q=80', // Arte Digital
          },
           
              categoria_seleccionada:1,
              producto_seleccionado:-1,
              mostrarCarrito:false, 
              mostrarExtras:false,

              

              impuesto:0.16,
              usuario:{
                nombre:'',
                id:0,
                email:'',
                telefono:'',
                foto:'',
              },
              
          }},

      computed:{
        //Devuelve un arreglo de productos, pero solo devuelve los productos de la categoria seleccionada
        filtro_categoria(){
          return this.productos.filter(prod=>prod.idtipo==this.categoria_seleccionada)
        },
        //Devuelve los adicionales del producto DENTRO de la orden
        filtro_adicionales(){
          let producto=this.orden[this.producto_seleccionado];
          let adicionales_filtrados= this.adicionales.filter(add=>add.idtipo==producto.idtipo);
          
          return adicionales_filtrados;
        },
        
        //Devuelve un objeto nombre_categoria con el nombre de la categoria
        productos_categoria(){
          //La funcion compara si la categoria seleccionada en el momento coincide con algun id de tipo. 
          //Con nombre se puede acceder a cualquier propiedad de tipos.
          let n=this.tipos.findIndex(tipo=>tipo.id==this.categoria_seleccionada)
          // Quita el "this." antes de la n
          let nombre_categoria= (n < 0) ? '' : this.tipos[n].nombre;

          return nombre_categoria;
        }
        ,orden_summary(){
          let datos={
            subtotal:0,
            impuesto:0,
            total:0,
          };
          
          datos.subtotal=this.orden.reduce((acc,prod)=> {
            
            acc+=parseFloat(prod.precio)    
            return acc;

          },0);
          datos.impuesto = parseFloat((datos.subtotal * this.impuesto).toFixed(2));
          datos.total=datos.subtotal+datos.impuesto;
          return datos;
        }
        ,adicionaltipo(){
          let producto=this.orden[this.producto_seleccionado];
          let n=this.tipos.find(tipo=>tipo.id===producto.idtipo);
          return n ? n.nombre:'';
        }

      }
      ,methods:{
        agregar_orden(producto){
            this.orden.push({  id:producto.id,
              nombre:producto.nombre,
              precio:producto.precio,
              idtipo:producto.idtipo,
              descripcion:producto.descripcion,
              adicionales:[],
              })
            
        },
        
        
        eliminar(producto){
          this.orden.splice(producto,1);
        },
        catalogo(){
          window.location.href= '/catalogo_productos';
        }     
        ,vaciar_carrito(){
          this.orden=[];
        }

        //Mostrar los adds del tipo del producto
        ,mostrarAdds(indice){
          this.mostrarExtras=true;
          this.producto_seleccionado = indice; //INDICE
        } 
      
      ,enviarOrden(){
          xhr3= new XMLHttpRequest();
          xhr3.open('POST','/api/venta/save',true);
          xhr3.setRequestHeader('Content-type','application/json');
          xhr3.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

          xhr3.send(JSON.stringify(this.orden)); 
        }
        ,agregarAdicional(adicional){
          this.orden[this.producto_seleccionado].adicionales.push(adicional);
          
        }
        

      }
      ,created(){
      var xhr = new XMLHttpRequest();
      xhr.open('GET','/productos',true);
      //funcion flecha para que el this apunte directamente a vue
      xhr.onreadystatechange= ()=>{
        if(xhr.readyState==4){
          if(xhr.status==200){
            this.productos=JSON.parse(xhr.responseText);              
          }
          else{
          alert("Falla");
          }
        }
      };
      xhr.send();
      
      // var xhr2 = new XMLHttpRequest();
      // xhr2.open('GET','/adicionales',true);
      // //funcion flecha para que el this apunte directamente a vue
      // xhr2.onreadystatechange= ()=>{
      //   if(xhr2.readyState==4){
      //     if(xhr2.status==200){
      //       this.adicionales=JSON.parse(xhr.responseText);              
      //     }
      //     else{
      //     alert("Falla");
      //     }
      //   }
      // };
      // xhr2.send();


      axios.get('/adds')
        .then(response=>{
          this.adicionales=response.data;
        })
        .catch(error=>{
          alert('error');
        });

    }
  })
    </script>
  </html>