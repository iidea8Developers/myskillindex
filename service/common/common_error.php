<?php 

function custom_error($errHeader,$errMsg){
echo "
<script type='text/javascript'>

$('#button1').click();

</script>

<button type='button' id='button1' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal' >Open Modal</button>

<!-- Modal -->
<div id='myModal' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header' style='background:transparent;border:solid 1px #2196F3;box-shadow: 0px 0px 20px #2196F3;'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
       <center> <h4 class='modal-title' id='modal_header'></h4> </center>
      </div>
      <div class='modal-body'>
        <p id='main_text'>Some text in the modal.</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>";
}

?>