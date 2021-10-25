<?php

$error = '';
$make = '';
$model = '';
$colour = '';
$capacity =  '';
$network = '';
$grade = '';
$condition =  '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{



 
  $make = clean_text($_POST["make"]);
  $model = clean_text($_POST["model"]);
  $colour = clean_text($_POST["colour"]);
  $capacity = clean_text($_POST["capacity"]);
  $network = clean_text($_POST["network"]);
  $grade = clean_text($_POST["grade"]);
  $condition = clean_text($_POST["condition"]);
 
  
 

if ($error == '') {
    $file_open = fopen("contact_data.csv", "a");
    $no_rows = count(file("contact_data.csv"));
    if ($no_rows > 1) {
        $no_rows = ($no_rows -1) +1;
    }
    $form_data = array(
          
      'sr_no' => $no_rows,
        'make' =>  $make ,     
        'model' =>  $model,
        'colour' =>   $colour ,
        'capacity' =>  $capacity,
        'network' =>   $network ,
        'grade' =>   $grade ,
        'condition' =>    $condition );

        fputcsv($file_open,$form_data);
        $error = '<label class="text-success">Data Stored</label>';
       
       

        $make = '';
        $model = '';
        $colour = '';
        $capacity =  '';
        $network = '';
        $grade = '';
        $condition =  '';
    }

}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>CSV Project</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center"> CSV Project</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <br />
     <?php if(!empty($error)) {
       
       echo '<div class="alert alert-success" role="alert">
       
       '.$error.'</div>';

     }
     ?>
     <div class="form-group">
      <label>Enter Brand Name</label>
      <input type="text" name="make" required placeholder="Brand Name" class="form-control" value="<?php echo $make; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Model Name</label>
      <input type="text" name="model" required class="form-control" placeholder="Model Name" value="<?php echo $model; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Colour Name</label>
      <input type="text" name="colour" class="form-control" placeholder="Colour Name" value="<?php echo $colour; ?>" />
     </div>
     <div class="form-group">
      <label>Enter GB Spec Name</label>
      <input type="text" name="capacity" class="form-control" placeholder="GB Spec Name" value="<?php echo $capacity; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Network Name</label>
      <input type="text" name="network" class="form-control" placeholder="Network Name" value="<?php echo $network; ?>" />
     </div>

     <div class="form-group">
      <label>Enter Grade Name</label>
      <input type="text" name="grade" class="form-control" placeholder="Grade Name" value="<?php echo $grade; ?>" />
     </div>

     <div class="form-group">
      <label>Enter Condition Name</label>
      <input type="text" name="condition" class="form-control" placeholder="Condition Name" value="<?php echo $condition; ?>" />
     </div>

     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>

    <br>

    <div align="center">
     <button type="button" name="load_data" id="load_data" class="btn btn-info">Load Data</button>
    </div>
    <br />
    <div id="employee_table">
    </div>

   </div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){
 $('#load_data').click(function(){
  $.ajax({
   url:"contact_data.csv",
   dataType:"text",
   success:function(data)
   {
    var employee_data = data.split(/\r?\n|\r/);
    var table_data = '<table class="table table-bordered table-striped">';
    for(var count = 0; count<employee_data.length; count++)
    {
     var cell_data = employee_data[count].split(",");
     table_data += '<tr>';
     for(var cell_count=0; cell_count<cell_data.length; cell_count++)
     {
      if(count === 0)
      {
       table_data += '<th>'+cell_data[cell_count]+'</th>';
      }
      else
      {
       table_data += '<td>'+cell_data[cell_count]+'</td>';
      }
     }
     table_data += '</tr>';
    }
    table_data += '</table>';
    $('#employee_table').html(table_data);
   }
  });
 });
 
});
</script>