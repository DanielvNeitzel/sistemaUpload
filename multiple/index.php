<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- DROPZONE -->
  <link rel="stylesheet" href="css/dropzone.css" />
  <script src="js/dropzone.js"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2" ></div>
      <div class="col-sm-8">
        <form action="upload.php" class="dropzone" id="meuPrimeiroDropzone">  
          <div class="fallback"> 
            <input name="fileToUpload" type="file" multiple /> 
          </div> 
        </form>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>
  <script>
    Dropzone.options.meuPrimeiroDropzone = {
      paramName: "fileToUpload", 
      dictDefaultMessage: "[ Arraste seus arquivos para fazer o Upload ]<br><br><br><br><br> <strong>[ Limite: 300 arquivos ]</strong>",
      maxFilesize: 300, 
      accept: function(file, done) {
        if (file.name == "olamundo.png") {
          done("Arquivo não aceito.");
        } else {
          done();
        }
      }
    }
  </script>
</body>
</html>