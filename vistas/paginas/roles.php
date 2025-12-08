<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Administrar roles</h1>

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

                            <button type="button" class="btn btn-success crear-rol" data-toggle="modal"
                                data-target="#modal-crear-rol">
                                Crear nuevo rol
                            </button><br>

                        </div><br>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tabla-roles" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th>Nombre del rol</th>
                                        <th>Acciones</th>

                                    </tr>

                                </thead>

                                <tbody>
                                <?php
                                    $roles = ctrRoles::ctrMostrarRoles();
                                    foreach($roles as $key => $value){
                                        echo '<tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$value["nombre"].'</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-warning btn-sm btnEditarRol" idRol="'.$value["id"].'" data-toggle="modal" data-target="#modal-editar-rol"><i class="fas fa-pencil-alt text-white"></i></button>
                                                        <!-- <button class="btn btn-danger btn-sm btnEliminarRol" idRol="'.$value["id"].'"><i class="fas fa-trash-alt"></i></button> -->
                                                    </div>
                                                </td>
                                            </tr>';
                                    }
                                ?>
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
Modal Crear rol
======================================-->
<div class="modal modal-default fade" id="modal-crear-rol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Agregar nuevo rol</h4>
            </div>
            <form method="post">

                <div class="form-group has-feedback" bis_skin_checked="1">
                    <input type="text" class="form-control" name="nuevo_rol" placeholder="Nombre del rol">
                    <span class="glyphicon glyphicon-king form-control-feedback"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php 
                    $crearRol = new ctrRoles();
                    $crearRol->ctrCrearRol();
                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>