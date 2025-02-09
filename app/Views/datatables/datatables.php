<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatables Server Side User_table</title>
     <!-- uery  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     Bootstraps  
     CSS only 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

     Datatables
    <link rel="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
-->
	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


</head>
<body>
    <div class="container">
        <h2>Codeigniter 4.0.4</h2>
        <hr color="cyan">
        <div class="row">
            <label class="control-label col-xs-2">&nbsp;&nbsp; Hombres:&nbsp;&nbsp; </label>
                <input  id="cantHombres" type="text" class="col-xs-2"  size=7 readonly disabled/>
                &nbsp;

                <label for="mujeres col-xs-2">&nbsp;&nbsp; Mujeres:&nbsp;&nbsp; </label>
                <input  id="cantMujeres" type="text" class="col-xs-2"  size=7 readonly disabled/>
                &nbsp;
                
                <label for="activos col-xs-2">&nbsp;&nbsp; Activos:&nbsp;&nbsp; </label>
                <input  id="cantActivos" type="text" class="col-xs-2"  size=7 readonly disabled/>
                &nbsp;
                <label for="inactivos col-xs-2">&nbsp;&nbsp;  Inactivos:&nbsp;&nbsp; </label>
                <input  id="cantInactivos" type="text" class="col-xs-2"  size=7 readonly disabled/>
        </div> 
        <hr color="cyan" size="2">
        <table class="table table-bordered table-striped table-hover" id="user_table" class="col-lg-1 col-md-1 col-xs-1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Usuario</th>
                    <th>Nombre</th>            
                    <th>Apellido</th>  
                    <th>Sexo</th>  
                    <th>Password</th>  
                    <th>Status</th>  
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table> 
    </div>
    <script type="text/javascript">
    
    function cantidadHombres(){
          console.log('por Sexo');
		  console.log('Hombres')
          $.ajax({ 
                url : "<?php echo base_url('datatables/totalHombres'); ?>",
                type : "POST",
                dataType: "text",
                success:function(result){
                        $("#cantHombres").val(result);
						console.log("Cantidad de Hombres: ", result);
                }
         });
		};     
    function cantidadMujeres(){
          console.log('Mujeres');
          $.ajax({ 
                url : "<?php echo base_url('datatables/totalMujeres'); ?>",
                type : "POST",
                dataType: "text",
                success:function(result){
                        $("#cantMujeres").val(result);
                        console.log("Cantidad de Mujeres: ", result);
                }
         });
    };     
    function cantidadActivos(){
          console.log('Activos');
          $.ajax({ 
                url : "<?php echo base_url('datatables/totalActivos'); ?>",
                type : "POST",
                dataType: "text",
                success:function(result){
                        $("#cantActivos").val(result);
                        console.log("Cantidad de Activos: ", result);
                }
         });
    };         
    function cantidadInactivos(){
          console.log('Inactivos');
          $.ajax({ 
                url : "<?php echo base_url('datatables/totalInactivos'); ?>",
                type : "POST",
                dataType: "text",
                success:function(result){
                        $("#cantInactivos").val(result);
                        console.log("Cantidad de Inactivos: ", result);
                }
         });
    };             
     $(document).ready(function (){
        cantidadHombres();
        cantidadMujeres();
        cantidadActivos();
        cantidadInactivos();
     });
        table = $('#user_table').DataTable({
            "lengthMenu":[[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
            "pageLength": 10, 
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "order" : [],
            "proccessing": true,
            "serverSide": true,
            "ajax" : {
                "url" : "<?php echo base_url('datatables/table_data'); ?>",
                "type" : "POST"
            },
            "columnDefs" : [{
                "targets" : [0],
                "orderable" : false
            }]
        });
    
      
    </script>
</body>
</html>