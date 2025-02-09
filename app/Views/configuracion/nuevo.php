<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?php echo $titulo; ?></h1>
        
        <!-- Imprime los errores de las validaciones del Formulario  -->
        <?php if(isset($validation)){ ?>
            <div class="alert alert-danger">
                <?php echo $validation->listErrors(); ?>
            </div>
        <?php } ?>

        <form action="<?php echo base_url(); ?>/configuracion/insertar" method="post" autocomplete="off">
        <!-- para que devuelva la fila del error de validacion -->

        <div class="form-group">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label>Nombre</label>
                    <input class="form-control" 
                        id="nombre" name="nombre" 
                        type="text" 
                        value="<?php echo set_value('nombre'); ?>"
                        autofocus required/>
                </div>

                <div class="col-12 col-sm-6">
                    <label>Nombre corto</label>
                    <input class="form-control" 
                        id="nombre_corto" name="nombre_corto" 
                        type="text" 
                        value="<?php echo set_value('nombre_corto'); ?>"
                        required/>
                </div>
            </div>
        </div>      

<!-- Acciones de botones -->
<fieldset class="form-group border p-1 col-md-12">
            <legend class="col-md-3 col-form-label pt-0" align="center">Acciones</legend>
                <div class="row"> 
                <div class="col clearfix col-md-12"> 
                    <span class="float-left"><button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button></span>
                    <span class="float-right"><a href="<?php echo base_url(); ?>/configuracion" class="btn btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> Regresar</a>
                </div>         
        <fieldset>
    </form>
</div>
</main>

