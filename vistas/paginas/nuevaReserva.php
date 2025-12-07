<?php
    /*if(isset($_SESSION["idBackend"])){
        $admin=ctrUsuarios::ctrMostrarUsuarios1("id", $_SESSION["idBackend"]);
        $admin2=ctrRoles::ctrMostrarRoles("id_roles",$admin ["rol"]);
    }
    $YActual = date("Y");*/
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nueva reservación
        <small>Reservaciones Riu</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="reservaciones"><i class="fa fa-dashboard"></i> Riu</a></li>
        <li class="active">Editor de reservaciones</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="idElemento" id="idElemento" value="">
      <div class="row">
        <div class="col-md-3">
          <a href="reservaciones" class="btn btn-success btn-block margin-bottom">Volver a las reservaciones</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Estado de la reservación</h3><h2></h2>
              
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <center>
            </center>
            <div class="form-group has-feedback">
                    <label>Estado actual de la reserva</label>
                    <select class="form-control" name="menuM" id="menu" required>   
                      <option value="0">Seleccione una opción</option>
                      <option value="Pendiente">Pendiente</option>
                      <option value="Confirmada">Confirmada</option>
                      <option value="Cancelada">Cancelada</option>
                      <option value="Finalizada">Finalizada</option>
                    </select>
              </div>
          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Cliente</h3>
              <div class="form-group has-feedback">
                    <label for="">Correo electronico</label>
                    <input type="text" class="form-control" name="cliente_reserva" placeholder="Dirección de correo electronico del cliente" value="<?php echo htmlspecialchars($_POST['cliente_reserva'] ?? ''); ?>">
                    <br>
                    <center>
                      <button type="submit" name="accion" value="buscar_cliente" class="btn btn-info">Confirmar cliente</button>
                    </center>
                    <?php
                        /*$consultar = new ctrReservaciones();
                        $emailCliente = trim($_POST['cliente_reserva'] ?? '');

                        if (!empty($emailCliente)) {
                            $resultadoCliente = $consultar->ctrVerificarCliente($emailCliente);

                            if (is_array($resultadoCliente) && !empty($resultadoCliente)) {
                                $nombre = $resultadoCliente['Nombre'] ?? $resultadoCliente['nombre'] ?? '';
                                $apellido = $resultadoCliente['Apellido'] ?? $resultadoCliente['apellido'] ?? '';
                                $displayName = trim("$nombre $apellido");
                                if (empty($displayName)) {
                                    $displayName = strstr($emailCliente, '@', true);
                                }
                                echo '<p class="text-success" id="cliente-status">Bienvenido ' . htmlspecialchars($displayName) . '</p>';
                            } else {
                                echo '<p class="text-danger" id="cliente-status">Usuario no encontrado</p>';
                            }
                        }*/
                    ?>
              </div>
            </div>
          </div>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Servicios</h3>
              <p>Agregar servicios a la reservación</p>
            </div>
            <table class="table table-bordered table-striped dt-responsive tablaperfil" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Costo</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php
                                        $servicios = ctrReservaciones::ctrMostrarServicios();
                                        $posted_servicios = $_POST['servicios'] ?? [];
                                        foreach($servicios as $key => $value){
                                            $cantidad = $posted_servicios[$value['ServicioId']] ?? 0;
                                      ?>
                                        <tr>
                                        <td><?php echo  $value["Nombre"]  ?></td>
                                        <td><?php echo $value["Precio"]  ?></td>
                                        <td>
                                            <input type="number" class="form-control servicio-cantidad" name="servicios[<?php echo $value['ServicioId']; ?>]" min="0" value="<?php echo $cantidad; ?>" data-precio="<?php echo $value["Precio"] ?>">
                                        </td>
                                    </tr>
                                    <?php 
                                     }
                                    ?>
                                </tbody>
                            </table>
            <center>
            <div class="box-body no-padding">
            <div class="form-group has-feedback" bis_skin_checked="1">
            </div></center>
          </div>
          <div class="box box-solid">
              <div class="box-header with-border">
                  <h3 class="box-title">Total de la Reservación</h3>
              </div>
              <div class="box-body">
                  <p><strong>Noches:</strong> <span id="total-noches">0</span></p>
                  <hr>
                  <p><strong>Total Servicios:</strong> $<span id="total-servicios">0.00</span></p>
                  <p><strong>Total Habitaciones:</strong> $<span id="total-habitaciones">0.00</span></p>
                  <hr>
                  <h4><strong>Total:</strong> $<span id="total-reserva">0.00</span></h4>
              </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresa los datos de la nueva reserva</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="">Fecha de reservación</label>
                      <div class="form-inline ">
                        <input type="date" id="filter-fecha-desde" name="fecha_desde" class="form-control mr-2" value="<?php echo isset($_POST['fecha_desde']) ? htmlspecialchars($_POST['fecha_desde']) : ''; ?>">
                        <input type="date" id="filter-fecha-hasta" name="fecha_hasta" class="form-control mr-2" value="<?php echo isset($_POST['fecha_hasta']) ? htmlspecialchars($_POST['fecha_hasta']) : ''; ?>">
                        <button type="submit" name="accion" value="buscar_fechas" class="btn btn-info">Actualizar búsqueda</button>
                      </div>
                </div>
              </div>
          </div>
              <?php 
              $fechaInicio = isset($_POST['fecha_desde']) && trim($_POST['fecha_desde']) !== '' ? trim($_POST['fecha_desde']) : '';
              $fechaFin = isset($_POST['fecha_hasta']) && trim($_POST['fecha_hasta']) !== '' ? trim($_POST['fecha_hasta']) : '';
              $habitaciones = ctrReservaciones::mdlMostrarHabitacionesDisponibles($fechaInicio, $fechaFin);
              $totalHabitaciones = is_array($habitaciones) ? count($habitaciones) : 0;
            ?>
          <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">Habitaciones <small class="text-muted"><?php echo $totalHabitaciones; ?> disponibles</small></h3>
            </div>
            <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaperfil" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Piso</th>
                                        <th>Tipo de habitación</th>
                                        <th>Precio por noche</th>
                                        <th>Capacidad</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php
                                        foreach($habitaciones as $key => $value){
                                      ?>
                                        <tr data-tipo="<?php echo isset($value["Tipo de habitación"]) ? $value["Tipo de habitación"] : (isset($value["Tipo de habitacion"]) ? $value["Tipo de habitacion"] : (isset($value["Tipo habitacion"]) ? $value["Tipo habitacion"] : '')) ?>">
                                        <td><?php echo  $value["Numero"]  ?></td>
                                        <td><?php echo $value["Piso"]  ?></td>
                                        <td><?php echo $value["Tipo"]  ?></td>
                                        <td><?php echo $value["PrecioPorNoche"]  ?></td>
                                        <td><?php echo $value["Capacidad"]  ?></td>
                                        <td>
                                            <div class='btn-group'>
                                                <input type="checkbox" class="habitacion-check" name="habitaciones_seleccionadas[]" value="<?php echo $value["HabitacionID"] ?>" data-precio="<?php echo $value["PrecioPorNoche"] ?>" <?php echo in_array($value['HabitacionID'], $_POST['habitaciones_seleccionadas'] ?? []) ? 'checked' : ''; ?>>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                     }
                                    ?>
                                </tbody>
                            </table>
                        </div>
              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" name="accion" value="guardar_reserva" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Guardar</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              </div><br><br>
                          
              <?php 
                /*
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'guardar_reserva'){
                    $guardar = new ctrReservaciones();
                    $resultado = $guardar->ctrGuardarReservacionDividido();
                    if ($resultado !== false && $resultado !== 0){
                        echo "<script>
                                alert('Reservación guardada correctamente (ID: " . addslashes($resultado) . ")'); 
                                window.location.href = 'reservaciones';
                              </script>";
                    } else {
                        echo "<script>alert('Ocurrió un error al guardar la reservación. Verifique que el cliente exista o que las fechas sean válidas.');</script>";
                    }
                }
                */
              ?>
          </div>                
        </div>
      </div>
      </form>
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Referencias a los elementos del DOM
    const fechaDesdeInput = document.getElementById('filter-fecha-desde');
    const fechaHastaInput = document.getElementById('filter-fecha-hasta');
    const servicioCantidadInputs = document.querySelectorAll('.servicio-cantidad');
    const habitacionCheckboxes = document.querySelectorAll('.habitacion-check');

    const totalNochesEl = document.getElementById('total-noches');
    const totalServiciosEl = document.getElementById('total-servicios');
    const totalHabitacionesEl = document.getElementById('total-habitaciones');
    const totalReservaEl = document.getElementById('total-reserva');

    function calcularTotal() {
        // 1. Calcular número de noches
        let noches = 0;
        const fechaDesde = new Date(fechaDesdeInput.value);
        const fechaHasta = new Date(fechaHastaInput.value);

        if (fechaDesdeInput.value && fechaHastaInput.value && fechaHasta > fechaDesde) {
            const diffTime = Math.abs(fechaHasta - fechaDesde);
            noches = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        }
        totalNochesEl.textContent = noches;

        // 2. Calcular total de servicios
        let totalServicios = 0;
        servicioCantidadInputs.forEach(function (input) {
            const cantidad = parseInt(input.value, 10) || 0;
            if (cantidad > 0) {
                const precio = parseFloat(input.getAttribute('data-precio')) || 0;
                totalServicios += cantidad * precio;
            }
        });
        totalServiciosEl.textContent = totalServicios.toFixed(2);

        // 3. Calcular total de habitaciones
        let subtotalHabitaciones = 0;
        habitacionCheckboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                subtotalHabitaciones += parseFloat(checkbox.getAttribute('data-precio')) || 0;
            }
        });
        const totalHabitaciones = subtotalHabitaciones * noches;
        totalHabitacionesEl.textContent = totalHabitaciones.toFixed(2);
        
        // 4. Calcular gran total
        const granTotal = totalServicios + totalHabitaciones;
        totalReservaEl.textContent = granTotal.toFixed(2);
    }

    // --- EVENT LISTENERS ---
    // Escuchar cambios en las fechas
    fechaDesdeInput.addEventListener('change', calcularTotal);
    fechaHastaInput.addEventListener('change', calcularTotal);

    // Escuchar cambios en los inputs de cantidad de servicios
    servicioCantidadInputs.forEach(function (input) {
        input.addEventListener('input', calcularTotal);
    });

    // Escuchar cambios en los checkboxes de habitaciones
    habitacionCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', calcularTotal);
    });

    // Calcular total al cargar la página por si hay valores pre-cargados
    calcularTotal();
});
</script>
<!--=====================================
Modal Crear roles
======================================-->
<div class="modal modal-default fade" id="modal-crear-grupo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Agregar nuevo grupo</h4>
            </div>
            <form method="post" enctype="multipart/form-data">

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="text" class="form-control" name="nom_rol" placeholder="nombre de rol">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <div class="btn btn-default btn-file" bis_skin_checked="1">
                        <i class="fas fa-paperclip"></i> Adjuntar Imagen de usuarios
                        <input type="file" name="subirImgusuarios">
                    </div>
                    <img class="previsualizarImgusuarios img-fluid py-2" width='200' height='200'>
                    <p class="help-block small"> Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>
                </div>

                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control" name="estadoG" id="estadoG" required>
                        <option value="1">Activo</option>
                        <option value="0">Fuera de servicio</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-primary">guardar</button>
                </div>

                <?php 

                //$guardarRol = new ctrLibro();
                //$guardarRol->ctrGuardarGrupo();
                
                
                ?>


            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--=====================================
Modal editar roles
======================================-->
<div class="modal modal-default fade" id="modal-editar-rol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">editar rol</h4>
            </div>
            <form method="post" enctype="multipart/form-data">

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="hidden" name="id_rolE">
                    <input type="text" class="form-control" name="nom_rolE" placeholder="nombre de rol">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-primary">guardar</button>
                </div>

                <?php 

                //$editarRol = new ctrRoles();
                //$editarRol->ctrEditarRol();
                
                
                ?>


            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>