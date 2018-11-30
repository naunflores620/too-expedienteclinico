<template>
    <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Profesionales en Medicina
                        <button type="button" @click="abrirModal('profesionalEnMedicina','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="JVPM">JVPM</option>
                                    <!--  <option value="especialidad">Especialidad</option>
                                      <option value="nit">NIT</option>-->
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPem(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPem(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>JVPM</th>
                                    <th>Especialidad</th>
                                    <th>NIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pem in arrayPem" :key="pem.id"> <!--objeto pem-->
                                    <td>
                                        <button type="button" @click="abrirModal('profesionalEnMedicina','actualizar',pem)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="pem.JVPM"></td>
                                    <td v-text="pem.especialidad"></td>
                                    <td v-text="pem.nit"></td>
                                    <!--<td>
                                        
                                        <div v-if="especialidad.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                        
                                    </td>-->
                                </tr>
                            
                            </tbody>
                        </table>
                         <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                               
                               <!-- <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Id</label>
                                    <div class="col-md-9">
                                        <input type="text" id="id" name="id" class="form-control" placeholder="">
                                        <span class="help-block">(*) Ingrese Id</span>
                                    </div>
                                </div> -->

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">JVPM</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="JVPM" class="form-control" placeholder="Ingrese el JVPM">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Especialidad</label>
                                    <div class="col-md-9">
                                       <select class="form-control" v-model="especialidad_id">
                                          <option value="0" disabled>Seleccione la especialidad</option>
                                        <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id" v-text="especialidad.especialidad"></option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">NIT</label>
                                    <div class="col-md-9">
                                       <select class="form-control" v-model="trabajador_id">
                                           <option value="0" disabled >Seleccione el NIT</option>
                                          <option v-for="trabajador in arrayTrabajador" :key="trabajador.id" :value="trabajador.id" v-text="trabajador.nit"></option>
                                       </select>
                                    </div>
                                </div>

                                <div v-show="errorPem" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPem" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPem()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPem()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Especialidad</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar esta Especialidad?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
    
        </main>

</template>

<script>
    export default {
        data(){
           return {
            
               pem_id:0,
               trabajador_id:0,
               especialidad_id:0,
               especialidad:'',
               trabajador_nit:'',
               JVPM:0,
               arrayPem: [],
               modal:0,
               tituloModal:'',
               tipoAccion: 0,
               errorPem: 0,
               errorMostrarMsjPem: [],
               
               pagination: {
                'total' : 0,     
                'current_page' : 0, 
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
               },
               offset:3,
               criterio: 'JVPM',
               buscar: '',
               arrayEspecialidad:[],
               arrayTrabajador:[]
           }
        },
         computed:{
             isActived:function(){
                 return this.pagination.current_page;
             },
             pagesNumber: function(){
                 if(!this.pagination.to){
                     return[];
                 }
                 var from = this.pagination.current_page - this.offset;
                 if(from <1){
                     from=1;
                 }

                 var to = from + (this.offset * 2);
                 if(to >= this.pagination.last_page){
                     to=this.pagination.last_page;
                 }
                 var pagesArray =[];
                 while(from <=to){
                     pagesArray.push(from);
                     from++;
                 }
                 return pagesArray;
             }
         },
        methods: {
            listarPem(page,buscar,criterio){
                let me=this;
                var url='/pem?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                 var respuesta = response.data;
                 me.arrayPem = respuesta.profesionalesEnMedicina.data;
                 me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            selectEspecialidad(){
                let me=this;
                var url='/especialidad/selectEspecialidad'; 
                axios.get(url).then(function (response) {
                 //  console.log(response); 
                 var respuesta = response.data;
                 me.arrayEspecialidad = respuesta.especialidades;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
                
            },
             selectTrabajador(){
                let me=this;
                var url='/trabajador/selectTrabajador'; 
                axios.get(url).then(function (response) {
               //    console.log(response); 
                 var respuesta = response.data;
                 me.arrayTrabajador = respuesta.trabajador;
               })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
                
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page=page;
                //Enviar la peticion para visualizar la data de esa pagina
                me.listarPem(page,buscar,criterio);
            },
            registrarPem(){
               if(this.validarPem()){
                   return; 
               }
               
               let me= this;
                
                axios.post('/pem/registrar',{
                    'especialidad_id':this.especialidad_id,
                    'trabajador_id':this.trabajador_id,
                    'JVPM':this.JVPM
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPem(1,'','JVPM'); 
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
            },

            actualizarPem(){
                if(this.validarPem()){
                   return; 
               }
               
               let me= this;
                
                axios.put('/pem/actualizar',{
                    'especialidad_id':this.especialidad_id,
                    'trabajador_id':this.trabajador_id,
                    'JVPM':this.JVPM,
                    'id': this.pem_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPem(1,'','JVPM'); 
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            validarPem(){
                this.errorPem=0;
                this.errorMostrarMsjPem= [];
                 if(this.especialidad_id == 0) this.errorMostrarMsjPem.push("Seleccione una especialidad");
                 if(this.trabajador_id == 0) this.errorMostrarMsjPem.push("Seleccione un trabajador");
                 if(!this.JVPM) this.errorMostrarMsjPem.push("El numero del JVPM no debe estar vacio y debe ser un numero entero");

                if(this.errorMostrarMsjPem.length) this.errorPem=1;
                return this.errorPem;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.especialidad_id= 0;
                this.trabajador_id= 0;
                this.especialidad='';
                this.trabajador_nit='';
                this.JVPM= 0;
                this.errorPem= 0;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "profesionalEnMedicina":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Profesional en medicina';
                                this.especialidad_id= 0;
                                this.trabajador_id= 0;
                                this.especialidad='';
                                this.trabajador_nit='';
                                this.JVPM= 0;
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);
                               this.modal=1;
                               this.tituloModal='Actualizar Profesional en medicina';
                               this.tipoAccion=2;
                               this.pem_id=data['id'];
                               this.especialidad_id= data['especialidad_id'];
                               this.trabajador_id= data['trabajador_id'];
                               this.JVPM=data['JVPM'];
                               break;
                            }
                        }
                    }
                }
                this.selectEspecialidad();
                this.selectTrabajador();

            }
        },
        mounted() {
           this.listarPem(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
   .modal-content{
       widows: 100% !important;
       position: absolute !important;
   }
   .mostrar{
     display: list-item !important;
     opacity: 1 !important;
     position: absolute !important;
     background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color:red !important;
        font-weight: bold;
    }
</style>
