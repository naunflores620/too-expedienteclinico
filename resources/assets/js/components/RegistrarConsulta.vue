<template>
  <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item">
        <a href="#">Admin</a>
      </li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container">
  <h1>Registro de consulta</h1>

      <div class="row">
        <div class="col-md-6 offset-md-5">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Seleccione la especialidad</label>
    <select v-model="especialidad_id" class="form-control" id="exampleFormControlSelect1">
      <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id"  v-text="especialidad.especialidad"></option>
      
    </select>
  </div>

   <div class="form-group">
    <label for="exampleFormControlSelect1">Seleccione el medico</label>
    <select v-model="medico_id" class="form-control" id="exampleFormControlSelect1">
      <option>Dr. Marcelo Quintanilla</option>
      
    </select>
  </div>
        </div>
      </div>
     
  <button @click="registrarConsulta()"  type="button" class="btn btn-primary">Registrar Consulta</button>
         

        </div>
        </div>
    
       
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      id="modalNuevo"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar categoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                <div class="col-md-9">
                  <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control"
                    placeholder="Nombre de categoría"
                  >
                  <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                <div class="col-md-9">
                  <input
                    type="email"
                    id="descripcion"
                    name="descripcion"
                    class="form-control"
                    placeholder="Enter Email"
                  >
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div
      class="modal fade"
      id="modalEliminar"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
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
</template>

<script>
export default {
  data() {
    return {
      medico_id : '',
      paciente_id : '',
      especialidad_id : '',
      arrayEspecialidad : []
    };
  },
  methods: {
    listarEspecialidades() {
      let me=this;
      //Usando axios
      axios
        .get("/especialidad").then(function(response) {
          // handle success
          me.arrayEspecialidad = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });

    },
    buscarMedico(){
       axios.get("/especialidad").then(function(response) {
          // handle success
          me.arrayEspecialidad = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });

    
    },
    registrarConsulta(){
      axios
        .post('/consulta/registrar',{'medico_id':this.medico_id,'paciente_id': paciente_id}).then(function(response) {
          // handle success
        
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });


    }
  },
  mounted() {
   this.listarEspecialidades();
  }
};
</script>
