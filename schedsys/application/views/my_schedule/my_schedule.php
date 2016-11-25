<?php
$this->load->view("mainpage");
?>
<script type="text/javascript"> $(document).ready(function(){ setMain(); });
function setMain(){ user_person_id=$('#user_person_id').val();  $.post(URL+"index.php/main/locateMyScheduleMain",{user_person_id:user_person_id}).done(function(data){  $('#content').html(data); });  }
</script>
