<!DOCTYPE html>
<html>
<head>
<title>Upload file</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<style> 
    .sbmit {
        margin-top:20px;
    }
</style>

<form method="post" enctype="multipart/form-data"> 
    <div class="container">
        <h1>Please Upload file</h1>
        <input type="file" class="form-group" name="output" />
        
        <br>
        <button class="btn btn-primary sbmit" type="submit">Submit </button>
    </div>
    
    @csrf()
</form>

</body>
</html>


