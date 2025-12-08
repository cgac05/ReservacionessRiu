<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Administrar reservaciones</h1>

                </div>



            </div>

        </div><!-- /.container-fluid -->

    </section>



    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <!-- Default box -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <!-- Filtros: estado, fecha y tipo -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="box box-default">
                                        <label>Estado</label>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="filter-estado" value="Confirmada" checked> Confirmada</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="filter-estado" value="Pendiente" checked> Pendiente</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="filter-estado" value="Cancelada" checked> Cancelada</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <label>Fecha entrada / salida</label>
                                <div class="form-inline">
                                    <input type="date" id="filter-fecha-desde" class="form-control mr-2">
                                    <input type="date" id="filter-fecha-hasta" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Tipo de habitación</label>
                                <select id="filter-tipo" class="form-control">
                                    <option value="">Todos</option>
                                    <?php
                                        $tiposHabitacion = ctrReservaciones::ctrMostrarTiposHabitacion(); 
                                        foreach($tiposHabitacion as $tipo){ ?>
                                    <option value="<?php echo $tipo['TipoHabitacionId']; ?>"><?php echo $tipo['Nombre']; ?></option>
                                    <?php } ?>
                                    
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Número de reservación</label>
                                <input type="text" id="filter-numero" class="form-control" placeholder="Número de reservación">
                            </div>

                            
                        </div>
                    </div><br>
                            <div class="col-md-15">
                                <div class="col-md-3">
                                <button type="button" class="btn btn-success btn-block margin-bottom" id="btn-actualizar-busqueda">
                                    Actualizar busqueda
                                </button><br>
                            </div>
                            <div class="col-md-5">
                                <a href="nuevaReserva" class="btn btn-success btn-block margin-bottom">Crear nueva reservación</a>
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="filter-clear" class="btn btn-success btn-block margin-bottom">Limpiar filtros</button><br>
                            </div>
                            </div>
                        </div><br>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaperfil" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th>Numero de reservación</th>
                                        <th>Nombre del cliente</th>
                                        <th>Fecha de entrada</th>
                                        <th>Fecha de salida</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>


                                    </tr>

                                </thead>

                                <tbody>

                                    <?php  ?>



                                    <?php 
                                     foreach($reservaciones as $key => $value){

                                                                      
                                    ?>

                                        <tr data-tipo="<?php echo isset($value["Tipo de habitación"]) ? $value["Tipo de habitación"] : (isset($value["Tipo de habitacion"]) ? $value["Tipo de habitacion"] : (isset($value["Tipo habitacion"]) ? $value["Tipo habitacion"] : '')) ?>">

                                        <td><?php echo ($key+1)  ?></td>
                                        <td><?php echo $value["Clave de reserva"]  ?></td>
                                        <td><?php echo $value["Nombre cliente"]  ?></td>
                                        <td><?php echo $value["Fecha de entrada"]  ?></td>
                                        <td><?php echo $value["Fecha de salida"]  ?></td>
                                        <td><?php echo $value["Estado"]  ?></td>

                                        <td>

                                            <div class='btn-group'>

                                                <button class="btn btn-warning btn-sm btnEditarRoles"
                                                    data-toggle="modal" idRol="<?php echo $value["Clave de reserva"]  ?>"
                                                    data-target="#modal-editar-rol">
                                                    <i class="fa fa-cube"> Modificar</i>
                                                </button>
                          
                                                <button class="btn btn-danger btn-sm btnCancelarReserva"
                                                    idReserva="<?php echo $value["Clave de reserva"]  ?>">
                                                    <i class="fas fa-times"></i> Cancelar
                                                </button>
                                                <!-- <button class="btn btn-danger btn-sm eliminarRol"
                                                    idRolesE="<?php echo $value["Clave de reserva"]  ?>">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button> -->

                                            </div>

                                        </td>

                                    </tr>





                                    <?php 

                                     }

                                    ?>


                                    <tr>
                    
                    

                                </tbody>

                            </table>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->

                    </div>
                    <!-- /.card -->

                </div>

            </div>

        </div>

    </section>


</div>











<!--=====================================
Modal Crear reservacion 
======================================-->
<div class="modal modal-default fade" id="modal-crear-usuarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Agregar nueva reservacion</h4>
            </div>
            <form method="post" enctype="multipart/form-data">

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="text" class="form-control" name="nom_perfil" placeholder="nombre">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="text" class="form-control" name="nom_user" placeholder="usuario">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="password" class="form-control" name="pass_user" placeholder="password">
                    <span class="glyphicon glyphicon-eye-close form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <div class="btn btn-default btn-file" bis_skin_checked="1">
                        <i class="fas fa-paperclip"></i> Adjuntar Imagen de perfil
                        <input type="file" name="subirImgPerfil">
                    </div>
                    <img class="previsualizarImgPerfil img-fluid py-2" width='200' height='200'>
                    <p class="help-block small"> Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>
                </div>


                <div class="form-group has-feedback">


                    <label>rol</label>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-times"></i> cerrar</button>
                    <button type="submit" class="btn btn-primary">guardar</button>
                </div>

                <?php 

              /*  $guardarPerfil = new ctrPerfiles();
                $guardarPerfil->ctrGuardarPerfil();*/
                
                
                ?>


            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


    <!--=====================================
    Modal Editar reservación
    ======================================-->
    <div class="modal modal-default fade" id="modal-editar-rol">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="alert alert-warning alert-dismissible ">Editar reservación</h4>
                </div>
                <form method="post" id="form-editar-reservacion">

                    <input type="hidden" name="clave_reserva" value="">

                    <div class="form-group has-feedback">
                        <label>Nombre cliente</label>
                        <input type="text" class="form-control" name="nombre_cliente" placeholder="Nombre cliente">
                    </div>

                    <div class="form-group has-feedback">
                        <label>Fecha de entrada</label>
                        <input type="date" class="form-control" name="fecha_entrada">
                    </div>

                    <div class="form-group has-feedback">
                        <label>Fecha de salida</label>
                        <input type="date" class="form-control" name="fecha_salida">
                    </div>

                    <div class="form-group has-feedback">
                        <label>Estado</label>
                        <select class="form-control" name="estado">
                            <option value="Confirmada">Confirmada</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!--=====================================
    Modal Eliminar reservación
    ======================================-->
    <div class="modal modal-default fade" id="modal-eliminar-rol">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="alert alert-danger alert-dismissible ">Eliminar reservación</h4>
                </div>
                <form method="post" id="form-eliminar-reservacion">
                    <input type="hidden" name="clave_reserva_eliminar" value="">
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar esta reservación?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!--=====================================
    Modal Cancelar reservación
    ======================================-->
    <div class="modal modal-default fade" id="modal-cancelar-reserva">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="alert alert-warning alert-dismissible ">Cancelar reservación</h4>
                </div>
                <form method="post" id="form-cancelar-reservacion">
                    <input type="hidden" name="clave_reserva_cancelar" value="">
                    <div class="modal-body">
                        <p>¿Está seguro que desea cancelar esta reservación?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-danger">Confirmar cancelación</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- Script para abrir y rellenar modales -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave_reserva_eliminar'])){
            $resultado = ctrReservaciones::ctrEliminarReservacion();

            if ($resultado === false){
                echo "<script>alert('Ocurrió un error al eliminar la reservación.');</script>";
            } else {
                // Si se eliminó (resultado puede ser 0 si no se encontró), recargar la página para actualizar la tabla
                echo "<script>alert('Reservación procesada (eliminada si existía).'); window.location = 'reservaciones';</script>";
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave_reserva'])){
            ctrReservaciones::ctrActualizarReservacion();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave_reserva_cancelar'])){
            ctrReservaciones::ctrCancelarReservacion();
        }
    ?>
    <script>
        (function waitForjQuery(){
            if (window.jQuery) {
                (function($){
                    $(function(){
                        
                        // AJAX para la búsqueda dinámica
                        $('#btn-actualizar-busqueda').on('click', function() {
                            var fecha_desde = $('#filter-fecha-desde').val();
                            var fecha_hasta = $('#filter-fecha-hasta').val();
                            var tipo_habitacion = $('#filter-tipo').val();
                            var numero_reserva = $('#filter-numero').val();
                            var estados = [];
                            $('.filter-estado:checked').each(function() {
                                estados.push($(this).val());
                            });

                            $.ajax({
                                url: 'vistas/paginas/ajax/reservaciones.ajax.php',
                                type: 'POST',
                                data: {
                                    accion: 'buscar',
                                    fecha_desde: fecha_desde,
                                    fecha_hasta: fecha_hasta,
                                    tipo_habitacion: tipo_habitacion,
                                    numero_reserva: numero_reserva,
                                    estados: estados
                                },
                                dataType: 'json',
                                success: function(response) {
                                    var tbody = $('.tablaperfil tbody');
                                    tbody.empty(); // Limpiar la tabla

                                    if (response.length > 0) {
                                        $.each(response, function(index, reservacion) {
                                            var fila = '<tr>' +
                                                '<td>' + (index + 1) + '</td>' +
                                                '<td>' + reservacion['Clave de reserva'] + '</td>' +
                                                '<td>' + reservacion['Nombre cliente'] + '</td>' +
                                                '<td>' + reservacion['Fecha de entrada'] + '</td>' +
                                                '<td>' + reservacion['Fecha de salida'] + '</td>' +
                                                '<td>' + reservacion['Estado'] + '</td>' +
                                                '<td>' +
                                                    '<div class="btn-group">' +
                                                        '<button class="btn btn-warning btn-sm btnEditarRoles" data-toggle="modal" idRol="' + reservacion['Clave de reserva'] + '" data-target="#modal-editar-rol">' +
                                                            '<i class="fa fa-cube"> Modificar</i>' +
                                                        '</button>' +
                                                        '<button class="btn btn-danger btn-sm btnCancelarReserva" idReserva="' + reservacion['Clave de reserva'] + '">' +
                                                            '<i class="fas fa-times"></i> Cancelar' +
                                                        '</button>' +
                                                    '</div>' +
                                                '</td>' +
                                            '</tr>';
                                            tbody.append(fila);
                                        });
                                    } else {
                                        tbody.append('<tr><td colspan="7">No se encontraron reservaciones con los filtros seleccionados.</td></tr>');
                                    }
                                },
                                error: function() {
                                    var tbody = $('.tablaperfil tbody');
                                    tbody.empty();
                                    tbody.append('<tr><td colspan="7">Error al realizar la búsqueda.</td></tr>');
                                }
                            });
                        });

                        // Editar modal: abre y rellena campos básicos
                        $(document).on('click', '.btnEditarRoles', function(e){
                            e.preventDefault();
                            var $row = $(this).closest('tr');
                            var clave = $(this).attr('idRol') || '';
                            var nombre = $row.find('td').eq(2).text().trim();
                            var fechaEntrada = $row.find('td').eq(3).text().trim();
                            var fechaSalida = $row.find('td').eq(4).text().trim();
                            var estado = $row.find('td').eq(5).text().trim();

                            var $modal = $('#modal-editar-rol');
                            $modal.find('input[name="clave_reserva"]').val(clave);
                            $modal.find('input[name="nombre_cliente"]').val(nombre);
                            // rellenar fechas en formato YYYY-MM-DD si vienen así
                            if (/^\d{4}-\d{2}-\d{2}$/.test(fechaEntrada)) $modal.find('input[name="fecha_entrada"]').val(fechaEntrada);
                            if (/^\d{4}-\d{2}-\d{2}$/.test(fechaSalida)) $modal.find('input[name="fecha_salida"]').val(fechaSalida);
                            $modal.find('select[name="estado"]').val(estado);
                            $modal.modal('show');
                        });

                        // Cancelar modal: coloca la clave en el formulario
                        $(document).on('click', '.btnCancelarReserva', function(e){
                            e.preventDefault();
                            var clave = $(this).attr('idReserva') || '';
                            var $modal = $('#modal-cancelar-reserva');
                            $modal.find('input[name="clave_reserva_cancelar"]').val(clave);
                            $modal.modal('show');
                        });

                        // Eliminar modal: coloca la clave en el formulario
                        $(document).on('click', '.eliminarRol', function(e){
                            e.preventDefault();
                            var clave = $(this).attr('idRolesE') || '';
                            var $modal = $('#modal-eliminar-rol');
                            $modal.find('input[name="clave_reserva_eliminar"]').val(clave);
                            $modal.modal('show');
                        });

                        // Limpiar campos: solo limpia inputs; NO aplica filtros en cliente
                        $('#filter-clear').on('click', function(e){
                            e.preventDefault();
                            // Dejar los checkboxes de estado marcados por defecto
                            $('.filter-estado').prop('checked', true);
                            $('#filter-fecha-desde').val('');
                            $('#filter-fecha-hasta').val('');
                            $('#filter-tipo').val('');
                            var $numero = $('#filter-numero');
                            if ($numero.length){
                                $numero.val('');
                                $numero.val($numero.val().replace(/\u00A0/g, '').trim());
                            }
                            $('#btn-actualizar-busqueda').trigger('click');
                        });

                    });
                })(jQuery);
            } else {
                setTimeout(waitForjQuery, 50);
            }
        })();
    </script>