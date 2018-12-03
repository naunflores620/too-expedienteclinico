<template>
  <main class="main">
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                <div class="card-header">
                        <i class="fa fa-align-justify"></i> Receta
                        <button type="button" @click="abrirModal('receta','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Medicamento</th>
                                    <th>Cantidad</th>
                                    <th>Indicaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="receta in arrayreceta" :key="receta.id">
                                    <td>
                                        <button type="button" @click="abrirModal('receta','actualizar',receta)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="receta.nombre"></td>
                                    <td v-text="receta.cantidad"></td>
                                    <td v-text="receta.indicaciones"></td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Medicamento</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="medicamento_id">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="medicamento in arrayMedicamento" :key="medicamento.id" :value="medicamento.id" v-text="medicamento.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Indicaciones</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="indicaciones" class="form-control" placeholder="Indicaciones">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Cantidad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="cantidad" class="form-control" placeholder="Cantidad">
                                    </div>
                                </div>
                                <div v-show="errorReceta" class="form-group row">
                                    <div class="text-center text-error" >
                                        <div v-for="error in errorMSJReceta" :key="error" v-text="error"></div>
                                </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarReceta()">Guardar</button>
                             <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarReceta()">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Receta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la receta?</p>
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
                indicaciones: '',
                cantidad: '',
                id_receta: 0,
                id_consulta: 0,
                medicamento_id:0,
                nombre_medicamento:'',
                arrayreceta: [],
                modal : 0,
                tituloModal :'',
                tipoAccion: 0,
                errorReceta : 0,
                errorMSJReceta: [],
                arrayMedicamento: []
            }
        },
        methods :{
            selectMedicamento(){
                  let ex=this;
                  var url='/medicamento/selectMedicamento';
                axios.get(url).then(function (response){
                    var respuesta=response.data;
                  ex.arrayMedicamento=respuesta.medicamentos;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarreceta(){
                let ex=this;
                axios.get('/receta').then(function (response){
                  ex.arrayreceta=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            validarReceta(){
                this.errorReceta=0;
                this.errorMSJReceta= [];
                if(this.medicamento_id==0) this.errorMSJReceta.push("Seleccione un medicamento");
                if(!this.indicaciones) this.errorMSJReceta.push("La indicaccion no puede estar vacia");
                if(!this.cantidad) this.errorMSJReceta.push("La cantidad no puede estar vacion");
                if(this.errorMSJReceta.length) this.errorReceta=1;

                return this.errorReceta;
            },
            registrarReceta(){
                if(this.validarReceta()){
                    return;
                }
                let ex=this;
                axios.post('/receta/registrar', {
                    'medicamento_id':this.medicamento_id,
                    'indicaciones':this.indicaciones,
                    'cantidad' : this.cantidad
                }).then(function (response){
                    ex.cerrarModal();
                    ex.listarreceta();
                }).catch(function (error){
                    console.log(error);
                });
            },
            actualizarReceta(){
                    if(this.validarReceta()){
                    return;
                }
                 let ex=this;
                axios.put('/receta/update', {
                    'id':this.id_receta,
                    'indicaciones':this.indicaciones,
                    'cantidad' : this.cantidad,
                      'medicamento_id':this.medicamento_id,
                }).then(function (response){
                    ex.cerrarModal();
                    ex.listarreceta();
                }).catch(function (error){
                    console.log(error);
                });

            },
            cerrarModal(){
                this.modal=0;
                this.medicamento_id=0;
                this.nombre_medicamento='';
                this.tituloModal='';
                this.indicaciones= '';
                this.cantidad= '';

            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "receta":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Registar Receta";
                                this.medicamento_id=0;
                                this.nombre_medicamento='';
                                this.indicaciones='';
                                this.cantidad='';
                                this.tipoAccion =1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Actualizar Receta";
                                this.tipoAccion =2;
                                this.id_receta= data['id'];
                                this.indicaciones= data['indicaciones'];
                                this.cantidad= data['cantidad'];
                                this.medicamento_id= data['medicamento_id'];
                                break;
                            }
                        }
                    }
                }
                this.selectMedicamento();

            }

        },
        mounted() {
            this.listarreceta();
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

