<template>
    <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Medicamento
                        <button type="button" @click="abrirModal('medicamento','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="unidadDeMedida">Unidad de Medida</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMedicamento(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMedicamento(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Unidad de Medida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="medicamento in arrayMedicamento" :key="medicamento.id">
                                    <td>
                                        <button type="button" @click="abrirModal('medicamento','actualizar',medicamento)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="medicamento.nombre"></td>
                                    <td v-text="medicamento.descripcion"></td>
                                    <td v-text="medicamento.unidadDeMedida"></td>
                                    <!--<td> *********************************-->
                                        <!--
                                        <div v-if="medicamento.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivo</span>
                                        </div>
                                        -->
                                    <!--</td> *********************************-->
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
                                    <label class="col-md-3 form-control-label" for="email-input">Nombre Medicamento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese nombre del Medicamento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese la descripcion del medicamento">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Unidad de medida</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="unidadDeMedida" class="form-control" placeholder="Ingrese la unidad de medida">
                                    </div>
                                </div>

                                <div v-show="errorMedicamento" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMedicamento" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMedicamento()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMedicamento()">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Signo Vital</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar esta Signo Vital?</p>
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
               nombre: '',
               descripcion:'',
               unidadDeMedida:'',
               arrayMedicamento: [],
               modal:0,
               tituloModal:'',
               tipoAccion: 0,
               errorMedicamento: 0,
               errorMostrarMsjMedicamento: [],
               
               pagination: {
                'total' : 0,     
                'current_page' : 0, 
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
               },
               offset:3,
               criterio: 'nombre',
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
            listarMedicamento(page,buscar,criterio){
                let me=this;
                var url='/medicamento?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                 var respuesta = response.data;
                 me.arrayMedicamento = respuesta.medicamentos.data; //AQUI!!!!!!!!!!
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
                me.listarMedicamento(page,buscar,criterio);
            },
            registrarMedicamento(){
               if(this.validarMedicamento()){
                   return; 
               }
               
               let me= this;
                
                axios.post('/medicamento/registrar',{
                    'nombre':this.nombre,
                    'descripcion':this.descripcion,
                    'unidadDeMedida':this.unidadDeMedida
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMedicamento(1,'','nombre'); 
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });
            },

            actualizarMedicamento(){
                if(this.validarMedicamento()){
                   return; 
               }
               
               let me= this;
                
                axios.put('/medicamento/actualizar',{
                    'nombre':this.nombre,
                    'descripcion':this.descripcion,
                    'unidadDeMedida': this.unidadDeMedida,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMedicamento(1,'','nombre'); 
                 // handle success
                 me.arrayMedicamento = response.data;
                })
                .catch(function (error) {
                // handle error
                console.log(error);
                 });

            },
            validarMedicamento(){
                this.errorMedicamento=0;
                this.errorMostrarMsjMedicamento= [];
                if(!this.nombre) this.errorMostrarMsjMedicamento.push("El nombre debe incluirse");
                if(!this.descripcion) this.errorMostrarMsjMedicamento.push("La descripcion debe incluirse");
                if(!this.unidadDeMedida) this.errorMostrarMsjMedicamento.push("La unidad de medida debe incluirse");

                if(this.errorMostrarMsjMedicamento.length) this.errorMedicamento=1;
                return this.errorMedicamento;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
                this.unidadDeMedida='';
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "medicamento":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Medicamento';
                                this.nombre='';
                                this.descripcion='';
                                this.unidadDeMedida='';
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                               // console.log(data);
                               this.modal=1;
                               this.tituloModal='Actualizar Medicamento';
                               this.tipoAccion=2;
                               this.id=data['id'];
                               this.nombre=data['nombre'];
                               this.descripcion=data['descripcion'];
                               this.unidadDeMedida=data['unidadDeMedida'];
                               break;
                            }
                        }
                    }
                }

            }
        },
        mounted() {
           this.listarMedicamento(1,this.buscar,this.criterio);
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
