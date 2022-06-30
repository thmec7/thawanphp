<?php 
 include('config.php'); 

require_once('repository/OtakuRepository.php');
$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
?>
<!doctype html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulário Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
  <?php include('navbar.php'); ?>
    <div class="col-6 offset-3">
       <table class="table table-stripped">
           <thead>
              <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Animepreferido</th>
                  <th>Idade</th>
                  <th>Email</th>
                  <th>Data cadastro</th>
                  <th colspan="2">Gerenciar</th>
               </tr>
            </thead>
             <tbody>
                 <?php foreach(fnLocalizaOtakuPorNome($nome) as $usuario): ?>
                <tr>
                <td><?= $usuario->id ?></td>
                <td><?= $usuario->nome ?></td>
                <td><?= $usuario->animepreferido ?></td>
                <td><?= $usuario->idade ?></td>
                <td><?= $usuario->email ?></td> 
                <td><?= $usuario->created_at ?></td>               
                <td><a href= "#" onclick="gerirUsuario(<?= $usuario->id ?>, 'edit');">Editar</a></td>
                <td><a onclick="return confirm('Deseja realmente Excluir') ? gerirUsuario(<?= $usuario->id ?>, 'del') : '';" href="#">Excluir</a></td>
                </tr>
                <?php endforeach; ?>
             </tbody>
             <?php if(isset($notificacao)) : ?>
            <tfoot>
              <tr>
                <td colspan="8"><?= $_COOKIE['notify'] ?></td>
              </tr>
            </tfoot>
            <?php endif; ?>
       </table>
    </div>
    <?php include("rodape.php"); ?>
    <script>
window.post = (data) => {
  return fetch(
    'set-session.php', 
    {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    }
  )
.then(response => {
 console.log(`Requisição completa! Resposta:`,response);
});
}





function gerirUsuario(id, action) {

post({data : id});
  url = 'excluirOtaku.php';
  if(action === 'edit')
  url = 'formulario-edita-otaku.php';

window.location.href = url;
 }

    </script>
  </body>
</html>