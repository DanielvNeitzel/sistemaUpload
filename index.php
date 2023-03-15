<?php

function formatSizeUnits($bytes) {

    if ($bytes > 0)
    {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}

date_default_timezone_set('America/Sao_Paulo');

error_reporting(0);
ini_set('display_errors', 0);

session_start();

?>

<html>

<head>
  <meta charset="utf-8">
  <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>[Sistema Neitzel] - Gerenciador</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link rel="stylesheet" href="assets/css/layout.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <script type="text/javascript" src="assets/js/scripts.js"></script>
  <style>
    .full-size-cont {
      width: 80% !important;
    }

    .modal-content {
      height: auto;
      max-height: 500px;
    }

    .frameMulti {
      width: 100%;
      height: 300px;
      border: 0;
    }

    .imgPopSize {
      width: 100%;
      max-width: 200px;
      max-height: 200px;
    }

    .nomeArquivo {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 200px;
      max-width: 250px;
    }

    .tamanhoArquivo {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 150px;
      max-width: 200px;
      text-align: center;
    }

    @media (max-width: 458px) {
      .full-size-cont {
        width: 100% !important;
      }
    }
  </style>
</head>

<body style="display: table;">

  <div class="wrapper">
    <!-- Sidebar Constructor -->
    <div class="constructor">

      <nav class="navbar navbar-expand-sm justify-content-center bg-dark navbar-dark">
        <ul class="navbar-nav">
          <li class="nav-item mr-sm-2">
            <a class="btn btn-success form-control text-white" data-toggle="modal" data-target="#frameSingleUp"><i class="fa fa-upload" aria-hidden="true"></i> </a>
          </li>
          <li class="nav-item mr-sm-2">
            <a class="btn btn-warning form-control text-white" data-toggle="modal" data-target="#frameMultiUp"><i class="fa fa-upload" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item mr-sm-2">
            <a class="btn btn-danger form-control text-white" onclick="limparPasta()"><i class="fas fa-trash-alt"></i></a>
          </li>
          <li class="nav-item mr-sm-2">
            <a class="btn btn-info form-control text-white" href="ziparArquivo.php"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item mr-sm-2">
            <a class="btn btn-secondary form-control text-white" onClick="window.location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></a>
          </li>
        </ul>
      </nav>

      <br><br><br><br>

      <div class="container full-size-cont">

        <section class="cmp-post">

          <?php include 'configStorage.php'; ?>

          <div class="panel panel-default">

            <?php

            $dir = 'uploads/';

            $files = array_diff(scandir($dir), array('.', '..'));

            ?>

            <div class="panel-header text-center">
              <?php echo '<span>Total de arquivos na sua pasta: ' . count($files) . ' Arquivo(s)</span><hr>'; ?>
            </div>
            <div class="panel-body">

              <?php

              if ($files) {

                echo '
                        <div class="row">
                        <div class="form-group col-md-12">
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #343a40;color: #ffffff;">
                        <span class="nomeArquivo">NOME</span>
                        <span class="tamanhoArquivo">EXTENSÃO</span>
                        <span class="tamanhoArquivo">DATA DE ALTERAÇÃO</span>
                        <span class="tamanhoArquivo">TAMANHO</span>
                        <span class="tamanhoArquivo">COMANDOS</span>
                        </li>
                        </ul>
                        </div>
                        </div>
                        ';

                foreach ($files as $arquivo) {

                  $arquivoTamanho = filesize($dir . $arquivo);
                  $ultimaData = date("d/m/Y H:i:s", filemtime($dir . $arquivo));
                  $imagemArquivo = '<img class="responsive-img full-size" alt="" src="' . $dir . $arquivo . '" />';
                  $ext = pathinfo($arquivo, PATHINFO_EXTENSION);


                  if ($ext === "zip" || 
                    $ext === "doc"  || 
                    $ext === "txt" || 
                    $ext === "pdf" || 
                    $ext === "xlsx" || 
                    $ext === "ocx" || 
                    $ext === "psd" || 
                    $ext === "zip" || 
                    $ext === "sql" || 
                    $ext === "apk" ||  
                    $ext === "exe") {
                    echo '
                            <div class="row">
                            <div class="form-group col-md-12">
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="nomeArquivo">' . $arquivo . '</span>
                            <span class="tamanhoArquivo">' . $ext . ' </span>
                            <span class="tamanhoArquivo">' . $ultimaData . '</span>
                            <span class="tamanhoArquivo">' . formatSizeUnits($arquivoTamanho) . '</span>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a style="width: 64px;" type="button" href="javascript:void(0);" onclick="deletaArquivo(\'' . $arquivo . '\')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            <a style="width: 64px;" type="button" href="' . $dir . $arquivo . '" target="_blank" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i></a>
                            </div>
                            </li>
                            </ul>
                            </div>
                            </div>
                            ';
                  } else {
                    echo '
                            <div class="row">
                            <div class="form-group col-md-12">
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="nomeArquivo">' . $arquivo . '</span>
                            <span class="tamanhoArquivo">' . $ext . ' </span>
                            <span class="tamanhoArquivo">' . $ultimaData . '</span>
                            <span class="tamanhoArquivo">' . formatSizeUnits($arquivoTamanho) . '</span>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a type="button" rel="popover" data-img="' . $dir . $arquivo . '" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            <a type="button" href="javascript:void(0);" onclick="deletaArquivo(\'' . $arquivo . '\')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            <a type="button" href="' . $dir . $arquivo . '" target="_blank" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i></a>
                            </div>
                            </li>
                            </ul>
                            </div>
                            </div>
                            ';
                  }
                }
              } else {
                echo "<center>Nenhum arquivo localizado</center>";
              }
              ?>
            </div>
            <div class="panel-footer text-center">
              <?php echo '<hr><span>Total de arquivos na sua pasta: ' . count($files) . ' Arquivo(s)</span>'; ?>
            </div>
          </div>

          <div class="modal fade" id="frameMultiUp" onClick="window.location.reload();" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" onClick="window.location.reload();" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <iframe class="frameMulti" src="./multiple"></iframe>
                </div>
              </div>

            </div>
          </div>

          <div class="modal fade" id="frameSingleUp" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" onClick="window.location.reload();" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" style="overflow-y: scroll;">
                  <form class="formUpload" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group cmparquivo">
                      <center>Carregamento unico de Arquivos:</center>
                    </div>
                    <div class="form-group cmparquivo">
                      <button type="submit" class="btn btn-primary btn-block btn-alt-full">Carregar Arquivos</button>
                    </div>
                    <div class="form-group cmparquivo">
                      <a class="btn btn-success btn-block adcUP">Adicionar campo de Upload</a>
                    </div>
                    <div class="form-group cmparquivo">
                      <a class="btn btn-danger btn-block rmvUP">Remover campos de Uploads</a>
                    </div>
                    <div class="form-group cmparquivo selArquivo">
                      <input type="file" class="form-control" name="arquivo[]" />
                    </div>
                    <div class="hide form-group">
                      <input type="file" class="form-control" name="arquivo[]" />
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>

        </section>

      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js"></script>

      <script>
        $(document).ready(function() {
          $(".adcUP").click(function() {
            $(".hide").clone().attr("class", "form-group cmparquivo adicional").appendTo(".formUpload");
          });
          $(".rmvUP").click(function() {
            $(".form-group").remove(".adicional");
          });
        });
      </script>

      <script>
        $nomePop = '<?php echo ($arquivo); ?>';
        $('a[rel=popover]').popover({
          html: true,
          trigger: 'hover',
          placement: 'left',
          content: function() {
            return '<img class="imgPopSize" src="' + $(this).data('img') + '" />';
          }
        });
      </script>

      <script>
        function limparPasta(arquivos) {
          var pergunta = 'Gostaria de excluir TODOS OS ARQUIVOS?';

          swal({
              title: "Confirmação de Exclusão",
              text: pergunta,
              icon: "warning",
              dangerMode: true,
              buttons: {
                cancel: "Não",
                catch: {
                  text: "Sim",
                  value: true,
                },
              },
            })
            .then((willDelete) => {
              if (willDelete) {

                var retornaAjax = false;

                $.ajax({
                  url: 'deletarTudo.php',
                  method: 'GET',
                  data: {
                    arquivos: arquivos
                  },
                  dataType: 'json',
                  async: false,
                  success: function(retorno) {
                    retornaAjax = retorno;
                  },
                  error: function(retorno) {
                    console.log('Erro!');
                    console.log(retorno);
                  },
                });

                console.log(retornaAjax);

                if (retornaAjax == true) {
                  swal("Todos os arquivos não foram deletados!", {
                    icon: "error",
                  });
                } else {
                  swal("Todos os arquivos foram deletados!", {
                    icon: "success",
                  });
                  setTimeout(function() {
                    location.reload();
                  }, 1500);
                }
              } else {}
            });
        }

        function deletaArquivo(arquivo) {

          var pergunta = 'Gostaria de excluir ' + arquivo + '?';

          swal({
              title: "Confirmação de Exclusão",
              text: pergunta,
              icon: "warning",
              dangerMode: true,
              buttons: {
                cancel: "Não",
                catch: {
                  text: "Sim",
                  value: true,
                },
              },
            })
            .then((willDelete) => {
              if (willDelete) {

                var retornaAjax = false;

                $.ajax({
                  url: 'deletarimg.php',
                  method: 'GET',
                  data: {
                    arquivo: arquivo
                  },
                  dataType: 'json',
                  async: false,
                  success: function(retorno) {
                    retornaAjax = retorno;
                  },
                  error: function(retorno) {
                    console.log('Erro!');
                    console.log(retorno);
                  },
                });

                console.log(retornaAjax);

                if (retornaAjax == true) {
                  swal("Arquivo deletado!", {
                    icon: "success",
                  });
                  setTimeout(function() {
                    location.reload();
                  }, 1500);
                } else {
                  swal("Arquivo não foi deletado!", {
                    icon: "error",
                  });
                }
              } else {}
            });
        }

        $("#editar").click(function() {
          $(".no-editable").hide();
          $(".editable").show();
        });

        $("#salvar").click(function() {
          $(".no-editable").show();
          $(".editable").hide();
        });
      </script>
    </div>
  </div>

  </div>
  </div>
</body>

</html>