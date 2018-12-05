<template>
    <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Tratamientos
                        <button type="button" @click="abrirModal('ordenes_de_tratamiento_medico','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="Tratamiento">Tratamiento</option>
                                      <option value="consulta">Consulta</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarTratamiento(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarTratamiento(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Indicaciones</th>
                                    <th>Razon del Tratamiento</th>
                                    <th>Consulta</th>
                                    <th>Tratamiento</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="Tratamiento in arrayTratamiento" :key="Tratamiento.id">
                                    <td>
                                        <button type="button" @click="abrirModal('ordenes_de_tratamiento_medico','actualizar',ordenes_de_tratamiento_medico)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="ordenes_de_tratamiento_medico.indicaciones"></td>
                                    <td v-text="ordenes_de_tratamiento_medico.razon_del_tratamiento"></td>
                                    <td v-text="ordenes_de_tratamiento_medico.consulta"></td>
                                    <td v-text="ordenes_de_tratamiento_medico.tratamiento"></td>
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
                                    <label class="col-md-3 form-control-label" for="email-input">Especialidad</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="ordenes_de_tratamiento_medico_id"> <!--"ordenes_de_tratamiento_medico_id" de la propiedad data-->
                                        <option value="0" disabled>Seleccione la especialidad</option>
                                        <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id" v-text="especialidad.especialidad"></option>
                                      </select>  
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Tratamiento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="Tratamiento" class="form-control" placeholder="Ingrese el nombre del Tratamiento">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese la descripcion del Tratamiento">
                                    </div>
                                </div>

                                <div v-show="errorTratamiento" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTratamiento" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTratamiento()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTratamiento()">Actualizar</button>
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
            
               Tratamiento_id: 0,
               ordenes_de_tratamiento_medico_id: 0,
               nombre_especialidad: '',
               Tratamiento:'', //nombre del Tratamiento
               descripcion:'',
               arrayTratamiento: [],
               modal:0,
               tituloModal:'',
               tipoAccion: 0,
               errorTratamiento: 0,
               errorMostrarMsjTratamiento: [],
               
               pagination: {
                'total' : 0,     
                'current_page' : 0, 
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
               },
               offset:3,
               criterio: 'Tratamiento',
               buscar: '',
               arrayEspecialidad:[]
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
            listarTratamiento(page,buscar,criterio){
                let me=this;
                var url='/odtm?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                 var respuesta = response.data;
                 me.arrayTratamiento = respuesta.Tratamientos.data;
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
                // console.log(response);
                var respuesta = response.data;
                me.arrayEspecialidad = respuesta.especialidades;
                })
                .catch(function (error) {
                // handle error
                consosle.log(error);
                 });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page=page;
                //Enviar la peticion para visualizar la data de esa pagina
                me.listarTratamiento(page,buscar,criterio);
            },
            registrarTratamiento(){
               if(this.validarTratamiento()){
                   return; 
               }
               
               let me= this;
                
                axios.post('/Tratamiento/registrar',{
                    'ordenes_de_tratamiento_medico_id': this.ordenes_de_tratamiento_medico_id,
                    'Tratamiento':this.Tratamiento,
                    'descripcion':this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTratamiento(1,'','Tratamiento'); 
                 
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
            },

            actualizarTratamiento(){
                if(this.validarTratamiento()){
                   return; 
               }
               
               let me= this;
                
                axios.put('/Tratamiento/actualizar',{
                    'ordenes_de_tratamiento_medico_id': this.ordenes_de_tratamiento_medico_id,
                    'Tratamiento':this.Tratamiento,
                    'descripcion':this.descripcion,
                    'id': this.Tratamiento_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTratamiento(1,'','Tratamiento'); 
                 // handle success
                 me.arrayEspecialidad = response.data;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            validarTratamiento(){
                this.errorTratamiento=0;
                this.errorMostrarMsjTratamiento= [];
                if(this.ordenes_de_tratamiento_medico_id == 0) this.errorMostrarMsjTratamiento.push("Seleccione una especialidad"); //OJOOOOO!!!!!! AQUI EN DONDE LE CAMBIE DE "==" A "!=" NO ES SI ESTE BIEN, PERO "FUNCIONA".
                if(!this.Tratamiento) this.errorMostrarMsjTratamiento.push("El nombre del Tratamiento no debe estar vacio");
                if(!this.descripcion) this.errorMostrarMsjTratamiento.push("La descripcion no puede estar vacia");

                if(this.errorMostrarMsjTratamiento.length) this.errorTratamiento=1;
                return this.errorTratamiento;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.ordenes_de_tratamiento_medico_id=0;
                this.nombre_especialidad= '';
                this.Tratamiento='';
                this.descripcion='';
                this.errorTratamiento=0;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "Tratamiento":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Tratamiento';
                                this.ordenes_de_tratamiento_medico_id= 0;
                                this.nombre_especialidad='';
                                this.Tratamiento='';
                                this.descripcion='';
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);
                               this.modal=1;
                               this.tituloModal='Actualizar Tratamiento';
                               this.tipoAccion=2;
                               this.Tratamiento_id=data['id'];
                               this.ordenes_de_tratamiento_medico_id=data['ordenes_de_tratamiento_medico_id'];
                               this.Tratamiento=data['Tratamiento'];
                               this.descripcion=data['descripcion'];
                               break;
                            }
                        }
                    }
                }
                this.selectEspecialidad(); //le agragamos esta madre, NO olvidar u:< No confundir 

            }
        },
        mounted() {
           this.listarTratamiento(1,this.buscar,this.criterio);
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