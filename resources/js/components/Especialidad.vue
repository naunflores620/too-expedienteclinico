<template>
    <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Especialidad
                        <button type="button" @click="abrirModal('especialidad','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="id">id</option>
                                      <option value="especialidad">Especialidad</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEspecialidad(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEspecialidad(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Especialidad</th>
                                    <!--<th>Estado</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="especialidad in arrayEspecialidad" :key="especialidad.id">
                                    <td>
                                        <button type="button" @click="abrirModal('especialidad','actualizar',especialidad)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="especialidad.id"></td>
                                    <td v-text="especialidad.especialidad"></td>
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
                                        <input type="text" v-model="especialidad" class="form-control" placeholder="Ingrese especialidad">
                                    </div>
                                </div>

                                <div v-show="errorEspecialidad" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEspecialidad" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEspecialidad()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEspecialidad()">Actualizar</button>
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
            
               id:0,
               especialidad: '',
               arrayEspecialidad: [],
               modal:0,
               tituloModal:'',
               tipoAccion: 0,
               errorEspecialidad: 0,
               errorMostrarMsjEspecialidad: [],
               
               pagination: {
                'total' : 0,     
                'current_page' : 0, 
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
               },
               offset:3,
               criterio: 'especialidad',
               buscar: ''
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
            listarEspecialidad(page,buscar,criterio){
                let me=this;
                var url='/especialidad?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                 var respuesta = response.data;
                 me.arrayEspecialidad = respuesta.especialidades.data;
                 me.pagination = respuesta.pagination;
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
                me.listarEspecialidad(page,buscar,criterio);
            },
            registrarEspecialidad(){
               if(this.validarEspecialidad()){
                   return; 
               }
               
               let me= this;
                
                axios.post('/especialidad/registrar',{
                    'especialidad':this.especialidad
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad(1,'','especialidad'); 
                 // handle success
                 me.arrayEspecialidad = response.data;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
            },

            actualizarEspecialidad(){
                if(this.validarEspecialidad()){
                   return; 
               }
               
               let me= this;
                
                axios.put('/especialidad/actualizar',{
                    'especialidad':this.especialidad,
                    'id': this.id,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad(1,'','especialidad'); 
                 // handle success
                 me.arrayEspecialidad = response.data;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            validarEspecialidad(){
                this.errorEspecialidad=0;
                this.errorMostrarMsjEspecialidad= [];
                if(!this.especialidad) this.errorMostrarMsjEspecialidad.push("Este campo no debe estar vacio");

                if(this.errorMostrarMsjEspecialidad.length) this.errorEspecialidad=1;
                return this.errorEspecialidad;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.especialidad='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "especialidad":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Especialidad';
                                this.especialidad='';
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);
                               this.modal=1;
                               this.tituloModal='Actualizar Especiaildad';
                               this.tipoAccion=2;
                               this.id=data['id'];
                               this.especialidad=data['especialidad'];
                               break;
                            }
                        }
                    }
                }

            }
        },
        mounted() {
           this.listarEspecialidad(1,this.buscar,this.criterio);
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
