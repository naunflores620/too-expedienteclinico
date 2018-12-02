<template>
  <main class="main">
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                <div class="card-header">
                        <i class="fa fa-align-justify"></i> Horario de Clinica
                        <button type="button" @click="abrirModal('horariosclinica','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Día</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="horariosclinica in arrayhorariosclinica" :key="horariosclinica.id">
                                    <td>
                                        <button type="button" @click="abrirModal('horariosclinica','actualizar',horariosclinica)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-if="horariosclinica.dia==1">Lunes</td>
                                    <td v-else-if="horariosclinica.dia==2">Martes</td>
                                    <td v-else-if="horariosclinica.dia==3">Miércoles</td>
                                    <td v-else-if="horariosclinica.dia==4">Jueves</td>
                                    <td v-else-if="horariosclinica.dia==5">Viernes</td>
                                    <td v-else-if="horariosclinica.dia==6">Sábado</td>
                                    <td v-else-if="horariosclinica.dia==7">Domingo</td>
                                    <td v-else>Lunes a Viernes</td>
                                    <td v-text="horariosclinica.desde"></td>
                                    <td v-text="horariosclinica.hasta"></td>
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
                                        <input type="time" max="22:30:00" min="10:00:00" step="1" v-model="hasta" class="form-control" placeholder="00:00:00">
                                    </div>
                                </div>
                                <div v-show="errorHorarioClinica" class="form-group row">
                                    <div class="text-center text-error" >
                                        <div v-for="error in errorMSJHorarioClinica" :key="error" v-text="error"></div>
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
                            <p>Estas seguro de eliminar la horariosclinica?</p>
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
                id_horariosclinica: 0,
                horario_id:'',
                asiganacion_puesto_id:0,
                nombre_medicamento:'',
                arrayhorariosclinica: [],
                modal : 0,
                tituloModal :'',
                tipoAccion: 0,
                errorHorarioClinica : 0,
                errorMSJHorarioClinica: [],
                arrayMedicamento: []
            }
        },
        methods :{

            listarHorarioClinica(){
                let ex=this;
                axios.get('/horariosclinica').then(function (response){
                  ex.arrayhorariosclinica=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            validarHorario(){
                this.errorHorarioClinica=0;
                this.errorMSJHorarioClinica= [];
                if(this.dia==0) this.errorMSJHorarioClinica.push("Seleccione un medicamento");
                if(!this.hasta) this.errorMSJHorarioClinica.push("La indicaccion no puede estar vacia");
                if(!this.desde) this.errorMSJHorarioClinica.push("La desde no puede estar vacion");
                if(this.errorMSJHorarioClinica.length) this.errorHorarioClinica=1;

                return this.errorHorarioClinica;
            },
               registrarHorarioClinica(){
                let ex=this;

                axios.post('/horariosclinica/registrar').then(function (response){
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
                    ex.registrarHorarioClinica();
    
                    ex.listarHorarioClinica();
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
                    ex.listarHorarioClinica();
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
                    case "horariosclinica":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Registar Horario de Clinica";
                                this.dia=0;
                                this.hasta='';
                                this.desde='';
                                this.tipoAccion =1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal =1 ;
                                this.tituloModal ="Actualizar Horario de Clinica";
                                this.tipoAccion =2;
                                this.dia= data['dia'];
                                this.hasta= data['hasta'];
                                this.desde= data['desde'];
                                this.horario_id= data['id'];
                                break;
                            }
                        }
                    }
                }

            }

        },
        mounted() {
            this.listarHorarioClinica();
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

