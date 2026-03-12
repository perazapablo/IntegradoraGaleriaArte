<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Work+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <title>Dashboard Galería</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}"> <!--Este archivo contiene los estilos de ApexCharts (los gráficos)-->
  </head>
  <body>
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-white group/design-root overflow-x-hidden" style='font-family: "Work Sans", "Noto Sans", sans-serif;'>
      <div id="app" class="layout-container flex h-full grow flex-col"> <!-- Punto de montaje de Vue: todo lo que esté dentro de este div será controlado por Vue -->
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f4f3f0] px-10 py-3">
          <div class="flex items-center gap-4 text-[#181511]">
            <div class="size-4">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M42.4379 44C42.4379 44 36.0744 33.9038 41.1692 24C46.8624 12.9336 42.2078 4 42.2078 4L7.01134 4C7.01134 4 11.6577 12.932 5.96912 23.9969C0.876273 33.9029 7.27094 44 7.27094 44L42.4379 44Z"
                  fill="currentColor"
                ></path>
              </svg>
            </div>
            <h2 class="text-[#181511] text-lg font-bold leading-tight tracking-[-0.015em]">Galeria de arte</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-[#181511] text-sm font-medium leading-normal" href="#">Dashboard</a>
              <a class="text-[#181511] text-sm font-medium leading-normal" href="#">Obras</a>
              <a class="text-[#181511] text-sm font-medium leading-normal" href="#">Clientes</a>
              <a class="text-[#181511] text-sm font-medium leading-normal" href="#">Ventas</a>
              <a class="text-[#181511] text-sm font-medium leading-normal" href="#">Reportes</a>
            </div>
            <button
              class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-[#f4f3f0] text-[#181511] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
            >
              <div class="text-[#181511]" data-icon="Bell" data-size="20px" data-weight="regular">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                  <path
                    d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z"
                  ></path>
                </svg>
              </div>
            </button>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiWzftYojm6n802x2Ii1YpfttBNrsLyT7QtPoMWw-v8AJgjAPIH8gvcar6Ssi3uVkJLQKNVEm6K3LaTmgGYXBx1WZ5xNm08RCWbs7wMVhlzN_0PvQAflkGMIBynOl44EKyNJnBT0U6u6ELwqFlXupon0xegknFwutU04uVXhuDePbpXH9nyj8U7VzscyAz2XthKOAGcSB1D2ZmVG8SDdMKmzHD10rLwu271OoxLyrvnqFR2BrlRQNSatzfBXmtSFTTv4HTKOWxH5E");'
            ></div>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <div class="flex min-w-72 flex-col gap-3">
                <p class="text-[#181511] tracking-light text-[32px] font-bold leading-tight">Consola de la Galería</p>
                <p class="text-[#897961] text-sm font-normal leading-normal">Indicadores de ventas y comportamiento de clientes de la galería.</p>
              </div>
            </div>            
      <h2 class="text-[#181511] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Indicadores de ventas</h2>
      <p class="text-[#897961] px-4 text-sm font-normal leading-normal">Últimos 3 meses.</p>
      <div class="flex flex-wrap gap-4 px-4 py-6">
        <!-- CARD 1 -->
        <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6">
          <div class="flex items-start justify-between">
            <div class="flex flex-col gap-2">
              <p class="text-[#181511] text-base font-medium leading-normal">Ventas totales</p>
              <p class="text-[#181511] tracking-light text-[32px] font-bold leading-tight truncate">$@{{total_ventas}}</p>
              <div class="flex gap-1">
                <p class="text-[#897961] text-base font-normal leading-normal">Promedio</p>
                <p class="text-[#078810] text-base font-medium leading-normal">Estimado</p>
              </div>
            </div>
            <div class="flex items-center">
              <select class="custom-select h-9 cursor-pointer rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961] focus:border-[#897961] focus:ring-0">
                <option value="today">Today</option>
                <option selected value="last7">Last 7 Days</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
              </select>
            </div>
          </div>
          <!-- gráfico -->
          <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
            <evndchart 
              :series="chart1.series"
              :options="chart1.opciones"></evndchart>
          </div>
          </div>
          <!-- CARD 2 -->
          <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6">
            <div class="flex items-start justify-between">
              <div class="flex flex-col gap-2">
                <p class="text-[#181511] text-base font-medium leading-normal">Ventas por canal</p>
                <p class="text-[#181511] tracking-light text-[32px] font-bold leading-tight truncate">Indicador</p>
                <div class="flex gap-1">
                  <p class="text-[#897961] text-base font-normal leading-normal">Canal destacado</p>
                  <p class="text-[#078810] text-base font-medium leading-normal">Dato</p>
                </div>
              </div>
              @{{filtro_chart2}}
              <div class="flex items-center">
                <select v-model="filtro_chart2" class="custom-select h-9 cursor-pointer rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961] focus:border-[#897961] focus:ring-0">
                  <option value="">Todos</option>
                  <option v-for="canal in canales" :value="canal">@{{canal}}</option>
                </select>
              </div>
            </div>
            <!-- gráfico -->
            <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
              <evndchart 
                :series="chart2.series"
                :options="chart2.opciones"></evndchart>
            </div>
          </div>
          <!-- CARD 3 -->
          <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6">
            <div class="flex items-start justify-between">
              <div class="flex flex-col gap-2">
                <p class="text-[#181511] text-base font-medium leading-normal">Productos mas vendidos</p>
                <p class="text-[#181511] tracking-light text-[32px] font-bold leading-tight truncate">250</p>
                <div class="flex gap-1">
                  <p class="text-[#897961] text-base font-normal leading-normal">Obra destacada</p>
                  <p class="text-[#078810] text-base font-medium leading-normal">Estimado</p>
                </div>
              </div>
              @{{filtro_chart3}}
              <div class="flex items-center">
                <select v-model="filtro_chart3" class="custom-select h-9 cursor-pointer rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961] focus:border-[#897961] focus:ring-0">
                  <option value="">Todos</option>
                  <option v-for="categoria in categorias" :value="categoria.id">@{{categoria.nombre}}</option>
                </select>
              </div>
            </div>
            <!-- gráfico -->
            <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">   
            <evndchart 
                :series="chart3.series"
                :options="chart3.opciones"></evndchart> 
            </div>
          </div>  
      </div>
      <h2 class="text-[#181511] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Analisis  Demográfico</h2>
      <!-- SEGUNDA FILA DE GRAFICAS -->
      <div class="flex flex-wrap gap-4 px-4 py-6">
          <!-- Grafica 1 -->
          <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6">
            <p class="text-[#181511] text-base font-medium leading-normal">Usuarios x genero</p>
               <select v-model="filtro_chart4.idedad"class="custom-select h-9 cursor-pointer rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961] focus:border-[#897961] focus:ring-0">
                  <option value="">Todas las edades</option>
                  <option v-for="edad in edades" :value="edad.id">@{{edad.nombre}}</option>
                </select>
                <select v-model="filtro_chart4.idocupacion" class="custom-select h-9 cursor-pointer rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961] focus:border-[#897961] focus:ring-0">
                  <option value="">Todas las ocupaciones</option>
                  <option v-for="ocupacion in ocupaciones" :value="ocupacion.id">@{{ocupacion.nombre}}</option>
                </select>
                <evndchart 
                  :series="chart4.series"
                  :options="chart4.opciones"></evndchart> 
          </div>
          <!-- Grafica 2 -->
          <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6">
              Grafica 2
          </div>
      </div>
     <div class="flex flex-wrap gap-4 px-4 py-6">
<div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6 relative">
<div class="flex items-start justify-between">
<div class="flex flex-col gap-2">
<div class="h-5 w-48 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="mt-2 h-10 w-32 animate-pulse rounded bg-[#e6e1db]"></div>
</div>
<div class="flex items-center">
<div class="h-9 w-24 animate-pulse rounded-md bg-[#e6e1db]"></div>
</div>
</div>
<div class="mt-1 flex gap-2">
<div class="h-4 w-20 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-4 w-12 animate-pulse rounded bg-[#e6e1db]"></div>
</div>
<div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
<div class="relative h-[148px] w-full">
<div class="flex h-full items-end justify-between gap-4 px-2">
<div class="h-[30%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[60%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[45%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[80%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[55%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[70%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
<div class="h-[40%] w-full animate-pulse rounded-t bg-[#f4f3f0]"></div>
</div>
</div>
<div class="flex justify-around">
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
<div class="h-3 w-8 animate-pulse rounded bg-[#e6e1db]"></div>
</div>
</div>
</div>
<div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e6e1db] p-6 relative bg-white/50">
<div class="flex items-start justify-between">
<div class="flex flex-col gap-2">
<p class="text-[#181511] text-base font-medium leading-normal">Proyección de tráfico de clientes</p>
<div class="mt-2 h-10 w-24 animate-pulse rounded bg-[#e6e1db]"></div>
</div>
<div class="flex items-center">
<select class="custom-select h-9 cursor-not-allowed rounded-md border border-[#e6e1db] bg-white px-3 py-1 text-xs font-semibold text-[#897961]/50 focus:outline-none">
<option>Loading...</option>
</select>
</div>
</div>
<div class="flex gap-1">
<div class="h-4 w-28 animate-pulse rounded bg-[#e6e1db]"></div>
</div>
<div class="flex min-h-[180px] flex-1 items-center justify-center py-4">
<div class="flex h-[148px] w-full flex-col justify-center gap-4">
<div class="h-2 w-full animate-pulse rounded bg-[#f4f3f0]"></div>
<div class="h-2 w-3/4 animate-pulse rounded bg-[#f4f3f0]"></div>
<div class="h-2 w-5/6 animate-pulse rounded bg-[#f4f3f0]"></div>
<div class="h-2 w-1/2 animate-pulse rounded bg-[#f4f3f0]"></div>
<div class="h-2 w-2/3 animate-pulse rounded bg-[#f4f3f0]"></div>
</div>
</div>
</div>
</div>
            
            
            
          </div>
        </div>
      </div>
    </div>

<!-- Librería principal de ApexCharts: se encarga de dibujar los gráficos (barras, pastel, líneas, etc.) -->
<script src="{{ asset('js/apexcharts.js') }}"></script>

<!-- Framework Vue.js: permite crear componentes dinámicos y controlar la interfaz del dashboard -->
<script src="{{ asset('js/vue.js') }}"></script>

<!-- Integración entre Vue y ApexCharts: permite usar gráficos de ApexCharts como componentes de Vue -->
<script src="{{ asset('js/vue-apexcharts.js') }}"></script>

<!-- Archivo del componente Columna: define la gráfica de columnas que será usada dentro de Vue -->
<script src="{{ asset('js/Columna.js')}}"></script>

<!-- Archivo del componente Pie: define la gráfica de columnas que será usada dentro de Vue -->
<script src="{{ asset('js/Pie.js')}}"></script>

<script>
      Vue.use(VueApexCharts); //activar Apexcharts dentro de Vue

      var app = new Vue({
        el: "#app" //Vue se monta en el div con id="app"

        ,data:function(){
          return{
            total_ventas:0,
            // arreglo con los valores que usará la gráfica
            valores:[],
            valores_chart2:{
              canales:[],
              tendencias:[]
            },
            valores_chart3:{
              categorias:[],
              tendencias:[]
            },
            valores_chart4:{
              cliente:[],
              genero:[]
            },
            // datos enviados desde Laravel (forma compatible con Blade actual)
            canales:@json($canales),
            categorias:@json($categorias),
            edades:@json($edades),
            ocupaciones:@json($ocupaciones),
            filtro_chart1:'',
            filtro_chart2:'',
            filtro_chart3:'',
            filtro_chart4:{
              idocupacion:0,
              idedad:0
            }

        }
        }

        ,components:{ // Registro de componentes que Vue podrá usar en el HTML
          evndchart: VueApexCharts ///puedo elegir como quiero llamar al componente pero no el nombre de la libreria
        }
        ,watch:{
          filtro_chart4:{
            handler:function(newValue){
              ///peticion asincrona
              var xhr4=new XMLHttpRequest();
              // Se usa route() porque este proyecto trabaja con rutas nombradas en web.php.
              // action() daba error "Action not defined" y corresponde a una version de sintaxis anterior
              xhr4.open('POST','{{route("dashboard.demograficos")}}',true);
              var self=this;
              xhr4.onreadystatechange=function(){
                //pregunto si la conexion termino
                if(this.readyState==4){
                //pregunto si todo salió bien   
                if(this.status==200){
                  // Se limpia el arreglo antes de cargar nuevos datos del filtro.
                    self.valores_chart4.splice(0,self.valores_chart4.length)
                    var info3=JSON.parse(this.responseText);
                    self.valores_chart4.genero = info3;
                  }

                }

              }

            xhr4.setRequestHeader('Content-type','application/json');
                 xhr4.send(JSON.stringify({
                  idedad:newValue.idedad, // corregí"iedad" por "idedad" porque el filtro lo usa asi
                  idocupacion:newValue.idocupacion,
                  _token:'{{csrf_token()}}'
                 }));
            },
            deep:true // se mantiene pendiente cuando cambie cualquiera de los dos atributos, signif:profundidad
          }
        }
        
         ////es para los valores que se actualizan automaticamente de las graficas
         ,computed:{ // computed transforma los datos al formato que ApexCharts necesita.
            ///primero
            chart1:function(){
              var final={
                series:this.valores,
                opciones:Columna()
              }
              final.opciones.xaxis.categories.push('Ventas');
              return final;            
            },
            ///segundo
            chart2:function(){
                var final={
                  series:[],
                  opciones:Columna()
                }
              if(this.filtro_chart2==""){ 
                /// la informacion la voy a tomar de los canales
    
                for(let i=0;i<this.valores_chart2.canales.length;i++){ ///NOTA: le puse let según para evitar errores pero hay que revisar si es necesario
                  final.series.push({
                    name:this.valores_chart2.canales[i].canal,
                    data:[this.valores_chart2.canales[i].total] ///data siempre debe ser arreglo, regla de sintaxis
                  })
                }
                final.opciones.xaxis.categories.push('Ventas');
              }
              else{ 
              /// la informacion la voy a tomar de las tendencias 
              var self2=this;
              let fg=this.valores_chart2.tendencias.filter(function(item){
            
              return item.canal==self2.filtro_chart2;
              })
              for(let i=0;i<fg.length;i++){ ///NOTA: le puse let según para evitar errores pero hay que revisar si es necesario
                final.series.push({
                  name:fg[i].fecha,
                  data:[fg[i].total]
                })
              }
              final.opciones.xaxis.categories.push('Ventas');
            }
              return final;
            },
            chart3:function(){
              var final={
                series:[],
                opciones:Columna()
              }

              if(this.filtro_chart3==''){
                  //categorias
                  for(let i=0;i<this.valores_chart3.categorias.length;i++){ ///NOTA: le puse let según para evitar errores pero hay que revisar si es necesario
                    final.series.push({
                      name:this.valores_chart3.categorias[i].nombre,
                      data:[this.valores_chart3.categorias[i].total]
                    })
                  }

                  final.opciones.xaxis.categories.push('Ventas');
                }
                else{
                  var self2=this;
                  let fg=this.valores_chart3.tendencias.filter(function(item){
                
                  return item.id==self2.filtro_chart3;
                  })
                  for(let i=0;i<fg.length;i++){///NOTA: le puse let según para evitar errores pero hay que revisar si es necesario
                    final.series.push({
                      name:fg[i].fecha,
                      data:[fg[i].total]
                    })
                  }
                  final.opciones.xaxis.categories.push('Ventas');
                }

              return final;
            }
            ,chart4:function(){
            var final={
              series:[],
              opciones:Pie()
            }

            final.opciones.labels=[];

            for(let i=0;i<this.valores_chart4.genero.length;i++){
              final.series.push(this.valores_chart4.genero[i].total);
              final.opciones.labels.push(this.valores_chart4.genero[i].genero);
            }

            return final;
          }
         }
         // created() carga los datos iniciales del dashboard mediante AJAX.
        ,created(){
          //primero
          var xhr=new XMLHttpRequest();
          // Se usa route() porque este proyecto trabaja con rutas nombradas en web.php.
          // action() daba error "Action not defined" y corresponde a una version de sintaxis anterior
          xhr.open('GET','{{route("dashboard.ventas")}}',true);
          var self=this;
          xhr.onreadystatechange=function(){
            //pregunto si la conexion termino
            if(this.readyState==4){
            //pregunto si todo salió bien   
            if(this.status==200){
              var info=JSON.parse(this.responseText);
              self.total_ventas=info.total;
              for(let i=0;i<info.tendencias.length;i++){ ///NOTA: le puse let según para evitar errores pero hay que revisar si es necesario
                self.valores.push({
                  name: info.tendencias[i].fecha,
                  data:[info.tendencias[i].total] // ApexCharts exige que data sea un arreglo, aunque tenga un solo valor.
                });
               }
              }
            }
            
          }
          xhr.send();

          //segundo
          var xhr2=new XMLHttpRequest();
          // Se usa route() porque este proyecto trabaja con rutas nombradas en web.php.
          // action() daba error "Action not defined" y corresponde a una version de sintaxis anterior
          xhr2.open('GET','{{route("dashboard.canal")}}',true); 
          var self=this;
          xhr2.onreadystatechange=function(){
            //pregunto si la conexion termino
            if(this.readyState==4){
            //pregunto si todo salió bien   
            if(this.status==200){
              var info2=JSON.parse(this.responseText);
              console.log('Estos son los datos del chart 2:', info2);
              self.valores_chart2.canales = info2.canales;
              self.valores_chart2.tendencias = info2.tendencias; //verificar se reinicio el codigo aqui
              }
            }            
          }
          xhr2.send();

          //tercero
          var xhr3=new XMLHttpRequest();
          // Se usa route() porque este proyecto trabaja con rutas nombradas en web.php.
          // action() daba error "Action not defined" y corresponde a una version de sintaxis anterior
          xhr3.open('GET','{{route("dashboard.categoria")}}',true);
          var self=this;
          xhr3.onreadystatechange=function(){
            //pregunto si la conexion termino
            if(this.readyState==4){
            //pregunto si todo salió bien   
            if(this.status==200){
              var info3=JSON.parse(this.responseText);
              console.log('Estos son los datos del chart 3:', info3);
              self.valores_chart3.categorias = info3.categorias;// Se guarda el JSON del controlador para que Vue pueda generar la gráfica.
              self.valores_chart3.tendencias = info3.tendencias; 
              /*Explicacion:
              El controlador devuelve un JSON con categorias que contiene nombre y total.
              En Vue lo guardo en valores_chart3.categorias.
              Luego en computed chart3 recorro ese arreglo y transformo cada elemento al formato que ApexCharts necesita, que es {name, data}.
              Por eso name toma nombre y data toma total.*/ 
              }
            }            
          }
          xhr3.send();

          //cuarto
          var xhr4=new XMLHttpRequest();
          // Se usa route() porque este proyecto trabaja con rutas nombradas en web.php.
          // action() daba error "Action not defined" y corresponde a una version de sintaxis anterior
          xhr4.open('GET','{{route("dashboard.demograficos")}}',true);
          var self=this;
          xhr4.onreadystatechange=function(){
            //pregunto si la conexion termino
            if(this.readyState==4){
            //pregunto si todo salió bien   
            if(this.status==200){

                var info3=JSON.parse(this.responseText);
                self.valores_chart4.genero = info3;
              }
            }
          }
          xhr4.send();
        }
      }
    );
</script>

</body>
</html>

<!---video 3 de marzo//////////
                                ///////////Finalizados los 8 videos del 19 de febrero al 3 de marzo 
                                video 1. tuto terminado--->

<!-- Regla de los dashboards:
            Base de datos
            ↓
            Controlador (arma JSON)
            ↓
            Vue guarda datos
            ↓
            Computed los transforma
            ↓
            ApexCharts los dibuja-->

