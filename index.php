<?php require_once "header.php"?>

<?php




$conn = Container::getBanco();




$crianca1 = new Crianca;


$crud = new CrudCrianca($conn, $crianca1);

echo "</pre>";

 ?>


<div class="ui vertical stripe segment">

<div class="ui grid container">

  
  
<table class="ui celled table" id="dataTableCrianca"  >
					<thead>
						<tr>
						  
						    <th>Data Inscrição</th>
							<th>Código</th>
							<th>Data Nasc</th>
							<th>Turma Desejada</th>
						<!--	<th>Periódo Desejada</th>-->
							<th>Responsavel</th>
							<th>CEIs Desejados</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							
							<th>Data Inscrição</th>
							<th>Código</th>
							<th>Data</th>
							<th>Turma</th>
						<!--	<th>Periódo</th>-->
							<th>Responsavel</th>
							<th>CEIs Desejados</th>
						</tr>
					</tfoot>
					<tbody>
						
					<?php foreach ($crud->listAtivos() as $key => $value){   ?>
						<tr>
						   
						    <td><?php echo $value->getDataCad()  ?></td>
						    <td><?php echo $value->getCodigo()  ?></td>
							<td><?php echo $value->getDataNasc()  ?></td>
							<td><?php echo $value->getTurma()  ?></td>
							<!--<td><?php echo // $value->getAllPeriodo()   ?></td>-->
							<td><?php echo $value->getNomeResponsavelMask()   ?></td>
							<td><?php echo $value->getAllCeis()  ?></td>
						</tr>

						<?php  } ?>
				  
					
					</tbody>
				</table>


	</div>
</div>
			
	
<!-- /.container-fluid -->
 <!-- Bootstrap core JavaScript-->
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
 
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

	var table = $('#dataTableCrianca').DataTable( {
	"language": {
            "lengthMenu": "Número de Registros  _MENU_  Por Páginas",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Vocês está na página  _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro encontrado",
            "infoFiltered": "(registros filtrados _MAX_ no total)",
			"search" : "Pesquisar",
			"Previous": "Voltar",
			"Next" : "Próximo",
        },
		"lengthChange": false,
        "buttons": [ 'copy', 'excel', 'pdf', 'colvis' ],
    	"buttons": [
			'excel',
			'pdf',
            'print',
			'colvis'
    ],
	"pageLength" : 50,
	"order": [[ 0, 'desc' ]]
});
table.buttons().container()
        .appendTo( $('div.eight.column:eq(0)', table.table().container()) );

    var table1 = $('#dataTableCrianca1').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table1.buttons().container()
        .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
} );
</script>


<?php require_once "footer.php"?>