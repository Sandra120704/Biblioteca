<?= $header; ?>

<style>
  .form-control:focus{background-color: beige;}
</style>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de personas</h4>
    <a href="<?= base_url("personas"); ?>" >Listar</a>
    <button id="toast" type="button">Mostrar</button>
  </div>


  <form action="<?= base_url('personas/guardar') ?>" id="form-persona" method="POST" autocomplete="off">
    <div class="card">
      <div class="card-body">
        <div class="mb-2">
          <label for="">Buscador por DNI </label><small class="d-none" id="searching">Por favor espere</small>
          <div class="input-group">
            <input type="text" class="form-control" id="dni" name="dni" maxlength="8" minlength="8" required autofocus>
            <button class="btn btn-outline-success" type="button" id="buscar-dni">Buscar</button>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
          </div>
          <div class="col-md-6 mb-2">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" name="nombres" id="nombres" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="9" pattern="[0-9]*"
              title="Solo se permiten números" required>
          </div>
          <div class="col-md-8 mb-2">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="departamentos">Departamentos</label>
            <select name="departamentos" id="departamentos" class="form-select">
              <option value="">Seleccione</option>
              <?php foreach($departamentos as $departamento): ?>
                <option value="<?=$departamento['iddepartamento']?>"><?=$departamento['departamento']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="provincias">Provincias</label>
            <select name="provincias" id="provincias" class="form-select">
              <option value=""></option>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="distritos">Distritos</label>
            <select name="distritos" id="distritos" class="form-select" required>
              <option value=""></option>
            </select>
          </div>
        </div>

      </div>
      <div class="card-footer text-end">
        <button class="btn btn-sm btn-outline-secondary" type="reset">Cancelar</button>
        <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
      </div>
    </div>
  </form>

</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector("area#form-persona")
    const botonBusqueda = document.querySelector("#buscar-dni")
    const dni = document.querySelector("#dni")
    const apellidos = document.querySelector("#apellidos")
    const nombres = document.querySelector("#nombres")
    const buscando = document.querySelector("#searching")
    const telefono = document.querySelector("#telefono")
      const departamentos = document.querySelector("#departamentos");
      const provincias = document.querySelector("#provincias");
      const distritos = document.querySelector("#distritos");

  /*       async function showToast(message = ``) {
          Codigo se iba a utlizar para renderizar un poco mas 
        }
  */
      document.querySelector("#toast").addEventListener('click', ()=>{
        swal.fire({
          text: 'No Encontrado',
          showConfirmButton: false,
          icon: 'info',
          toast: true,
          position: 'top-end',
          timer:3000,
          timerProgressBar: true,
          background: '#2ecc71',
          iconColor: '#ecf0f1',
          color: '#fff'

        })
      })

      departamentos.addEventListener('change', async () => {
        const iddepartamento = departamentos.value;

        provincias.innerHTML = `<option value=''>Seleccione</option>`;
        distritos.innerHTML = `<option value=''>Seleccione</option>`;

        if (!iddepartamento);

        try {
          const response = await fetch(`<?= base_url() ?>api/ubigeo/provincias/${iddepartamento}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
          });

          if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`Error al obtener provincias: ${errorText}`);
          }

          const data = await response.json();

          data.forEach(element => {
            provincias.innerHTML += `<option value='${element.idprovincia}'>${element.provincia}</option>`;
          });

        } catch (error) {
          console.error("Error al cargar provincias:", error);
        }
      });

      provincias.addEventListener('change', async () => {
        const idprovincia = provincias.value;

        distritos.innerHTML = `<option value=''>Seleccione</option>`;

        if (!idprovincia);

        try {
          const response = await fetch(`<?= base_url() ?>api/ubigeo/distritos/${idprovincia}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
          });

          if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`Error al obtener distritos: ${errorText}`);
          }
          const data = await response.json();
          console.log(data)

          data.forEach(element => {
            distritos.innerHTML += `<option value='${element.iddistrito}'>${element.distrito}</option>`;
          });

        } catch (error) {
          console.error("Error al cargar distritos:", error);
        }
      });

      /* function  BuscarDni(){

      }

      /* dni.addEventListener('keydown',(event) =>{
        event.preventDefault()
        if(event.key == 'Enter'){ */
/* 
        }
      }) */ 
    botonBusqueda.addEventListener('click', async () => {
      
      if (!dni.value){
        alert('Escriba el DNI')
        return
      }

      try{
        buscando.classList.remove("d-none")
        const response = await fetch(`<?= base_url() ?>api/personas/buscardni/${dni.value}`, {
          method: 'GET',
          headers: {'Content-type': 'application/json'}
        })

        if (!response.ok){
          throw new Error('Error en la solicitud')
        }
        const data = await response.json()
        buscando.classList.add("d-none")

        if(data.success){
          apellidos.value =`${data.apepaterno} ${data.apematerno}`
          nombres.value = `${data.nombres}`
        }else{
          apellidos.value =''
          nombres.value = ''
          telefono.focus()
        }
      }
      catch (error){
        console.log(error)
      }

    })
  })
  formulario.addEventListener('submit',(event)=>{
    event.preventDefault()

    swal.fire({
      title: 'Persona',
      text: '¿Desea Guardar?',
      icon: 'question',
      footer : 'App de biblioteca',
      timer:5000,
      timerProgressBar: true,
      showCancelButton: true,
      cancelButtonText:'Cancelar',
      confirmButtonText:'Aceptar'
    }).then((result) =>{
      if(result.isConfirmend)
       formulario
    })
  })
</script>

<?= $footer; ?>