<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>administrar roles</h1>

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

                            <button type="button" class="btn btn-success crear-perfil" data-toggle="modal"
                                data-target="#modal-crear-usuarios">
                                crear nuevo usuarios
                            </button><br>

                        </div><br>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaperfil" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th>Nombre</th>
                                        <th>usuario</th>
                                        <th>foto</th>
                                        <th>rol</th>
                                        <th>acciones</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <!--  <tr>
                    
                    <td>1</td>
                    <td>Hotel Portobelo</td>
                    <td>portobelo</td>
                    <td>Administrador</td>
                    <td><button class="btn btn-info btn-sm">Activo</button></td>
                    <td>

                      <div class='btn-group'>
                      
                        <button class="btn btn-warning btn-sm">
                          <i class="fas fa-pencil-alt text-white"></i>
                        </button>  

                        <button class="btn btn-danger btn-sm">
                          <i class="fas fa-trash-alt"></i>
                        </button> 

                      </div> 

                    </td>

                  </tr> -->

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
Modal Crear usuarios
======================================-->
<div class="modal modal-default fade" id="modal-crear-usuarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Agregar nuevo usuario</h4>
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
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">cerrar</button>
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