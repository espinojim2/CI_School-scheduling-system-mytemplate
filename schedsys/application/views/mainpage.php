<?php   
if(!isset($_SESSION['id'])){ echo '<meta http-equiv="refresh" content="0;url='.base_url().'">'; }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <?php echo $extraHeadContent; ?>
</head>
<body>
<?php $this->load->view("header/header"); ?>
<div id="wrapper">      
<!-- Sidebar -->
<div id="sidebar-wrapper">
<?php $this->load->view("sidebar/sidebar"); ?>   
</div>
 <!-- /#sidebar-wrapper -->
  <div id='pagetitle'><?= $pagetitle; ?></div>
        <!-- Page Content -->
     
<div style='width:100%; margin-top:10px; ' >
 <?php $str="This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
";
 ?>   
 <p style='visibility:hidden; '><?= $str; ?></p>
<div id='content' style='padding:1%;'></div>
</div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Menu Toggle Script -->
  

</body>

</html>
<?php
}
?>