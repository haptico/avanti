</head>
  <body>
      <form method="post" enctype="multipart/form-data" id="form" action="index.php">
          <input type="hidden" name="id_acesso" id="id_acesso" value="<?=$_POST['id_acesso'];?>">
          <input type="hidden" name="target" id="target" value="">
          <input type="hidden" name="acao" id="acao" value="">
      <div id="all">
          <div id="header">
              <h1>Painel Administrativo</h1>
          </div>
          <hr />
          <div id="content">
              <div class="menu">
                  <fieldset>
                      <legend></legend>
                      <?=  AcessoAction::exibeMenu();?>
                      <ul>
                          <li><a href="logoff.php">Sair</a></li>
                      </ul>
                  </fieldset>
              </div>