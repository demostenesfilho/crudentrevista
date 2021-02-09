<?php
    $pdo = new PDO('mysql:host=localhost; dbname=crud;', 'root', '');
$smtp = $pdo->prepare("SELECT * FROM atendimentos");
$smtp->execute();

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title>CRUD</title>
  </head>
  <body class="container">
      <div class="titulo">
    <h1>Atendimentos ao cliente:</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Atendimento</button>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Novo atendimento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form1">
                <div class="mb-3">
                  <label for="nome" class="form-label">Nome do cliente:</label>
                  <input type="text" class="form-control" id="nome">
                </div>
                <div class="mb-3">
                  <label for="tel" class="form-label">Telefone</label>
                  <input type="text" class="form-control" id="telefone">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
          <button form="form1" type="submit" class="btn btn-primary">Salvar</button>
        </form>
        </div>
      </div>
    </div>
  </div>


  <table class="table container">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome do cliente</th>
        <th scope="col">Telefone</th>
        <th scope="col">Editar</th>
        <th scope="col">Deletar</th>
      </tr>
    </thead>
    <tbody class="boxtabela">
      
      
      </div>
    </tbody>
  </table>

	<!-- Edit Modal HTML -->
	<div id="modaleditar" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Atendimento</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Nome</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Telefone</label>
							<input type="email" id="email_u" name="email" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Sair">
						<button type="button" class="btn btn-info" id="update">Atualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
$('#form1').submit(function(e){
  e.preventDefault();

    var nome = $('#nome').val();
    var telefone = $('#telefone').val();

    $.ajax({
        url: 'inserir.php',
        method: 'POST',
        data: {nome: nome, telefone: telefone},
        dataType: 'json'
    }).done(function(result){
        $('#nome').val('');
        $('#telefone').val('');
        console.log(result);
        adicionarlinha();
    });
});

function adicionarlinha() {
    $.ajax({
        url: 'selecionar.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);

        for (var i = 0; i <= result.length; i++) {
            $('.boxtabela').prepend('<tr><th scope="row">1</th><td>' + result[i].nome + '</td><td>' + result[i].telefone + '</td><td><button type="button" class="btn btn-warning">Editar</button></td><td><button onclick="deletar()" id="deletar" type="button" class="btn btn-danger">Excluir</button></td></tr>');
        }
    });
}

adicionarlinha();

    </script>
</body>
</html>