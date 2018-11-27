<template>
    <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Servicios
                        <button type="button" @click="abrirModal('servicio','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="servicio">Servicio</option>
                                      <option value="descripcion">Descripcion</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarServicio(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarServicio(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Especialidad</th>
                                    <th>Servicio</th>
                                    <th>Descripcion</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="servicio in arrayServicio" :key="servicio.id">
                                    <td>
                                        <button type="button" @click="abrirModal('servicio','actualizar',servicio)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="servicio.nombre_especialidad"></td>
                                    <td v-text="servicio.servicio"></td>
                                    <td v-text="servicio.descripcion"></td>
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
                                      <select class="form-control" v-model="especialidad_id"> <!--"especialidad_id" de la propiedad data-->
                                        <option value="0" disabled>Seleccione la especialidad</option>
                                        <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id" :value="especialidad.id" v-text="especialidad.especialidad"></option>
                                      </select>  
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Servicio</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="servicio" class="form-control" placeholder="Ingrese el nombre del servicio">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese la descripcion del servicio">
                                    </div>
                                </div>

                                <div v-show="errorServicio" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjServicio" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarServicio()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarServicio()">Actualizar</button>
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
            
               servicio_id: 0,
               especialidad_id: 0,
               nombre_especialidad: '',
               servicio:'', //nombre del servicio
               descripcion:'',
               arrayServicio: [],
               modal:0,
               tituloModal:'',
               tipoAccion: 0,
               errorServicio: 0,
               errorMostrarMsjServicio: [],
               
               pagination: {
                'total' : 0,     
                'current_page' : 0, 
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
               },
               offset:3,
               criterio: 'servicio',
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
            listarServicio(page,buscar,criterio){
                let me=this;
                var url='/servicio?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                 var respuesta = response.data;
                 me.arrayServicio = respuesta.servicios.data;
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
                me.listarServicio(page,buscar,criterio);
            },
            registrarServicio(){
               if(this.validarServicio()){
                   return; 
               }
               
               let me= this;
                
                axios.post('/servicio/registrar',{
                    'especialidad_id': this.especialidad_id,
                    'servicio':this.servicio,
                    'descripcion':this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarServicio(1,'','servicio'); 
                 
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
            },

            actualizarServicio(){
                if(this.validarServicio()){
                   return; 
               }
               
               let me= this;
                
                axios.put('/servicio/actualizar',{
                    'especialidad_id': this.especialidad_id,
                    'servicio':this.servicio,
                    'descripcion':this.descripcion,
                    'id': this.servicio_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarServicio(1,'','servicio'); 
                 // handle success
                 me.arrayEspecialidad = response.data;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            validarServicio(){
                this.errorServicio=0;
                this.errorMostrarMsjServicio= [];
                if(!this.especialidad_id != 0) this.errorMostrarMsjServicio.push("Seleccione una especialidad"); //OJOOOOO!!!!!! AQUI EN DONDE LE CAMBIE DE "==" A "!=" NO ES SI ESTE BIEN, PERO "FUNCIONA".
                if(!this.servicio) this.errorMostrarMsjServicio.push("El nombre del servicio no debe estar vacio");
                if(!this.descripcion) this.errorMostrarMsjServicio.push("La descripcion no puede estar vacia");

                if(this.errorMostrarMsjServicio.length) this.errorServicio=1;
                return this.errorServicio;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.especialidad_id=0;
                this.nombre_especialidad= '';
                this.servicio='';
                this.descripcion='';
                this.errorServicio=0;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "servicio":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Servicio';
                                this.especialidad_id= 0;
                                this.nombre_especialidad='';
                                this.servicio='';
                                this.descripcion='';
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);
                               this.modal=1;
                               this.tituloModal='Actualizar servicio';
                               this.tipoAccion=2;
                               this.servicio_id=data['id'];
                               this.especialidad_id=data['especialidad_id'];
                               this.servicio=data['servicio'];
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
           this.listarServicio(1,this.buscar,this.criterio);
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
