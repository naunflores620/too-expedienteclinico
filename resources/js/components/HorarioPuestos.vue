<template>
  <main class="main">
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                <div class="card-header">
                        <i class="fa fa-align-justify"></i> Horario de Puestos
                        <button type="button" @click="abrirModal('horariopuestos','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Trabajador</th>
                                    <th>Puesto</th>
                                    <th>Día</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="horariopuestos in arrayhorariopuesto" :key="horariopuestos.id">
                                    <td>
                                        <button type="button" @click="abrirModal('horariopuestos','actualizar',horariopuestos)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="horariopuestos.nombre"></td>
                                    <td v-text="horariopuestos.puesto"></td>
                                    <td v-if="horariopuestos.dia==1">Lunes</td>
                                    <td v-else-if="horariopuestos.dia==2">Martes</td>
                                    <td v-else-if="horariopuestos.dia==3">Miércoles</td>
                                    <td v-else-if="horariopuestos.dia==4">Jueves</td>
                                    <td v-else-if="horariopuestos.dia==5">Viernes</td>
                                    <td v-else-if="horariopuestos.dia==6">Sábado</td>
                                    <td v-else-if="horariopuestos.dia==7">Domingo</td>
                                    <td v-else>Lunes a Viernes</td>
                                    <td v-text="horariopuestos.desde"></td>
                                    <td v-text="horariopuestos.hasta"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Trabajador/Puesto</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="asignacion_puesto_id" v-if="asignacion_puesto_id==0">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="asignacion_puesto in arrayTrabajador" :key="asignacion_puesto.id" :value="asignacion_puesto.id" v-text="asignacion_puesto.nombre + ' / ' + asignacion_puesto.puesto"></option>
                                        </select>
                                        <select class="form-control" v-model="asignacion_puesto_id" disabled="disabled" v-else >
                                        <option v-for="asignacion_puesto in arrayTrabajador" :key="asignacion_puesto.id" :value="asignacion_puesto.id" v-text="asignacion_puesto.nombre + ' / ' + asignacion_puesto.puesto"></option>
                                        </select>
                                    </div>
                                </div> 
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Día</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="dia">
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miércoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sábado</option>
                                        <option value="7">Domingo</option>
                                        <option value="8">Lunes a Viernes</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Desde</label>
                                    <div class="col-md-9">
                                        <input type="time" max="22:30:00" min="10:00:00" step="1" v-model="desde" class="form-control" placeholder="00:00:00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Hasta</label>
                                    <div class="col-md-9">
                                        <input type="time" max="22:30:00" min="10:00:00" step="1"  v-model="hasta" class="form-control" placeholder="00:00:00">
                                    </div>
                                </div>
                                <div v-show="errorHorarioPuesto" class="form-group row">
                                    <div class="text-center text-error" >
                                        <div v-for="error in errorMSJHorarioPuesto" :key="error" v-text="error"></div>
                                </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-secondary" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarHorario()">Guardar</button>
                             <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarHorario()">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Horario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la horariopuestos?</p>
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
                hasta: '',
                desde: '',
                dia:'',
                horario_id:'',
                asignacion_puesto_id:0,
                nombre:'',
                puesto:'',
                arrayhorariopuesto: [],
                arrayTrabajador:[],
                modal : 0,
                tituloModal :'',
                tipoAccion: 0,
                errorHorarioPuesto : 0,
                errorMSJHorarioPuesto: [],
                arrayMedicamento: []
            }
        },
        methods :{
            selectTrabajador(){
                  let ex=this;
                  var url='/asignacion_puesto/selectTrabajador';
                axios.get(url).then(function (response){
                    var respuesta=response.data;
                  ex.arrayTrabajador=respuesta.puestos;
                })
                .catch(function(error){
                    console.log(error);
                });
            },

            listarHorarioPuesto(){
                let ex=this;
                axios.get('/horariopuestos').then(function (response){
                  ex.arrayhorariopuesto=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            validarHorario(){
                this.errorHorarioPuesto=0;
                this.errorMSJHorarioPuesto= [];
                if(this.asignacion_puesto_id==0) this.errorMSJHorarioPuesto.push("Seleccione un Trabajador");
                if(!this.dia) this.errorMSJHorarioPuesto.push("El día no puede estar vacio");
                if(!this.hasta) this.errorMSJHorarioPuesto.push("La hora final no puede estar vacia");
                if(!this.desde) this.errorMSJHorarioPuesto.push("La hora inicial no puede estar vacion");
                if(this.errorMSJHorarioPuesto.length) this.errorHorarioPuesto=1;

                return this.errorHorarioPuesto;
            },
               registrarHorarioPuesto(){
                let ex=this;

                axios.post('/horariopuestos/registrar',{
                    'puesto':this.asignacion_puesto_id,
                }).then(function (response){
                    ex.cerrarModal();
                }).catch(function (error){
                    console.log(error);
                });
            },
            registrarHorario(){
                if(this.validarHorario()){
                    return;
                }
                let ex=this;

                axios.post('/horario/registrar', {
                    'dia':this.dia,
                    'hasta':this.hasta,
                    'desde' : this.desde
                }).then(function (response){
                    ex.registrarHorarioPuesto();
                    ex.listarHorarioPuesto();
                }).catch(function (error){
                    console.log(error);
                });
                    

            },
            actualizarHorario(){
                    if(this.validarHorario()){
                    return;
                }
                 let ex=this;
        
                axios.put('/horario/update', {
                    'dia':this.dia,
                    'id':this.horario_id,
                    'hasta':this.hasta,
                    'desde' : this.desde
                    
                }).then(function (response){
                    ex.cerrarModal();
                    ex.listarHorarioPuesto();
                }).catch(function (error){
                    console.log(error);
                });

            },
            cerrarModal(){
                this.modal=0;
                this.horario_id=0;
                this.nombre_medicamento='';
                this.tituloModal='';
                this.hasta= '';
                this.desde= '';

            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "horariopuestos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Registar Horario de Puesto";
                                this.asignacion_puesto_id=0;
                                this.dia=0;
                                this.hasta='';
                                this.desde='';
                                this.tipoAccion =1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Actualizar Horario de Puesto";
                                this.tipoAccion =2;
                                this.asignacion_puesto_id= data['ap_id'];
                                //this.mientras=dia(dia);
                                this.dia= data['dia'];
                                this.hasta= data['hasta'];
                                this.desde= data['desde'];
                                this.horario_id= data['id'];
                                break;
                            }
                        }
                    }
                }
                this.selectTrabajador();

            }

        },
        mounted() {
            this.listarHorarioPuesto();
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

