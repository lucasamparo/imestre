<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
?>
<html>
<head>
<title>iMestre :: Documentação de Usuário</title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body>
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns">
			<h3 class="text-center">Documentação de uso iMestre</h3>
			<p>Em construção</p>
		</div>
	</div>
	<div class="large-12 columns">
		<?php include('footer.php')?>
	</div>	
</body>
<script>
  $(document).foundation();
</script>
</html>
