<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?php echo $titulo; ?></h1>
        <hr color="cyan"></hr>
            <div>
                <p>
                    <a href="<?php echo base_url('roles'); ?>" class="btn btn-warning">Roles</a>
                </p>

            </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Id</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Existencias</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($datos as $dato){ ?>
                            <tr>
                            <td><?php echo $dato['id']; ?></td>
                                <td><?php echo $dato['codigo']; ?></td>
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><?php echo $dato['precio_venta']; ?></td>
                                <td><?php echo $dato['existencias']; ?></td>             
                                <td><a href="#" data-href="<?php echo base_url('roles/reingresar/') . $dato['id']; ?>;" 
                                       data-toggle="modal" data-target="#modal-confirma" data-placement="top" 
                                       title="Reingresar registro"><i class="fa fa-3x fa-arrow-alt-circle-up"></i></a></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                    </table>
                </div>

    </div>
</main>

<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
                            -->
<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog dialog-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reingresar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Confirma reingresar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">NO</button>
        <a class="btn btn-danger btn-ok">Sí</a>
      </div>
    </div>
  </div>
</div>

</div>

