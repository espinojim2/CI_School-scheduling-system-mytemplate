<?php
$this->load->view("mainpage");
?>
<script type="text/javascript"> $(document).ready(function(){ setMain(); });
function setMain(){   $.post(URL+"index.php/main/locateSchoolYearSetup").done(function(data){  $('#content').html(data); });  }
</script>
