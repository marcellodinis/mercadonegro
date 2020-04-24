<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Utilizadores
  </h1>
  <ol class="breadcrumb">
    <li><a href="/mandachuva"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/mandachuva/users">Utilizadores</a></li>
    <li class="active"><a href="/mandachuva/users/create">Registar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Utilizador</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/mandachuva/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Insira o nome">
            </div>
            <div class="form-group">
              <label for="deslogin">Login</label>
              <input type="text" class="form-control" id="deslogin" name="deslogin" placeholder="Insira o nome de utilizador">
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Insira o número de telefone">
            </div>
            <div class="form-group">
              <label for="desemail">E-mail</label>
              <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Insira o e-mail">
            </div>
            <div class="form-group">
              <label for="despassword">Password</label>
              <input type="password" class="form-control" id="despassword" name="despassword" placeholder="Insira a password">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1"> Direitos de Administrador(?) 
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Registar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->