<template>
  <main class="main">
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                <div class="card-header">
                        <button type="button" @click="abrirModal('examen','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarexamen(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarexamen(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="examen in arrayExamen" :key="examen.id">
                                    <td>
                                        <button type="button" @click="abrirModal('examen','actualizar',examen)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="examen.nombre"></td>
                                    <td v-text="examen.descripcion"></td>
                                    <td>
                                       <!-- <div v-if="examen.condicion">
                                        <span class="badge badge-success">Activo</span>
                                        </div>
                                         <div v-else>
                                        <span class="badge badge-success">Inactivo</span>
                                        </div> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page -1, buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page +1, buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
             <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" @click="cerrarModal()" class="close"  aria-label="Close">
                              <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de examen">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripción de examen">
                                    </div>
                                </div>
                                <div v-show="errorExamen" class="form-group row">
                                    <div class="text-center text-error" >
                                        <div v-for="error in errorMSJExamen" :key="error" v-text="error"></div>
                                </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarExamen()">Guardar</button>
                             <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarExamen()">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
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
          

        <!-- /Fin del contenido principal -->
</template>

<script>
    export default {
        data(){
            return { 
                nombre: '',
                descripcion: '',
                id_examen: 0,
                arrayExamen: [],
                modal : 0,
                tituloModal :'',
                tipoAccion: 0,
                errorExamen : 0,
                errorMSJExamen: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
         computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods :{
            listarexamen(page, buscar,criterio){
                let ex=this;
                 var url= '/examen?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                    var respuesta= response.data;
                    ex.arrayExamen = respuesta.examenes.data;
                    ex.pagination= respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            cambiarPagina(page, buscar,criterio){
                let ex= this;
                ex.pagination.current_page= page;
                ex.listarexamen(page,buscar,criterio);

            },
            validarExamen(){
                this.errorExamen=0;
                this.errorMSJExamen= [];
                if(!this.nombre) this.errorMSJExamen.push("El nombre del examen no debe de estar vacio.");
                if(this.errorMSJExamen.length) this.errorExamen=1;

                return this.errorExamen;
            },
            registrarExamen(){
                if(this.validarExamen()){
                    return;
                }
                let ex=this;

                axios.post('/examen/registrar', {
                    'nombre':this.nombre,
                    'descripcion' : this.descripcion
                }).then(function (response){
                    ex.cerrarModal();
                    ex.listarexamen(1,'','nombre');
                }).catch(function (error){
                    console.log(error);
                });

            },
            actualizarExamen(){
                    if(this.validarExamen()){
                    return;
                }
                 let ex=this;

                axios.put('/examen/actualizar', {
                    'nombre':this.nombre,
                    'descripcion' : this.descripcion,
                    'id': this.id_examen
                }).then(function (response){
                    ex.cerrarModal();
                    ex.listarexamen(1,'','nombre');
                }).catch(function (error){
                    console.log(error);
                });

            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre= '';
                this.descripcion= '';


            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "examen":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Registar Examen";
                                this.nombre='';
                                this.descripcion='';
                                this.tipoAccion =1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.id_examen= data['id'];
                                this.modal =1 ;
                                this.tituloModal ="Actualizar Examen";
                                this.tipoAccion =2;
                                this.nombre= data['nombre'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }

            }

        },
        mounted() {
            this.listarexamen(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
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
        color: red !important;
        font-weight: bold;
    }
</style>

