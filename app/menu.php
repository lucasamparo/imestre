<?php
	echo '<ul class="button-group radius" style="background-color: #008CBA">
			<button href="#" data-dropdown="professor" aria-controls="professor" aria-expanded="false" class="button dropdown">Professor</button>
			<ul id="professor" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="perfilProfessor.php" id="perfil">Perfil</a></li>
				<li><a href="cadCurriculo.php" id="curriculo">Currículo</a></li>
				<li><a href="areaAtuacao.php" id="areas">Áreas de Atuação</a></li>
			</ul>
			<button href="#" data-dropdown="instituicao" aria-controls="instituicao" aria-expanded="false" class="button dropdown">Instituição</button>
			<ul id="instituicao" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="cadInstituicao.php" id="cadInstituicao">Cadastro</a></li>
				<li><a href="listaInstituto.php" id="listaInstituicao">Listagem</a></li>
			</ul>
			<button href="#" data-dropdown="disciplinas" aria-controls="disciplinas" aria-expanded="false" class="button dropdown">Disciplinas</button>
			<ul id="disciplinas" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="disciplinas.php" id="cadDisciplina">Controle</a></li>
			</ul>
			<button href="#" data-dropdown="turmas" aria-controls="turmas" aria-expanded="false" class="button dropdown">Turmas</button>
			<ul id="turmas" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="turmas.php" id="cadTurma">Cadastro</a></li>
				<li><a href="listaTurmas.php" id="listaTurma">Listagem</a></li>
			</ul>
			<button href="#" data-dropdown="alunos" aria-controls="alunos" aria-expanded="false" class="button dropdown">Alunos</button>
			<ul id="alunos" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="cadAluno.php" id="cadAluno">Cadastro</a></li>
				<li><a href="listaAlunos.php" id="listaAluno">Listagem</a></li>
			</ul>
			<button href="#" data-dropdown="comunicacao" aria-controls="comunicacao" aria-expanded="false" class="button dropdown">Comunicação</button>
			<ul id="comunicacao" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="#" id="blog">Blog</a></li>
				<li><a href="#" id="disco">Disco Virtual</a></li>
				<li><a href="#" id="email">e-Mail</a></li>
			</ul>
			<button href="#" data-dropdown="questoes" aria-controls="questoes" aria-expanded="false" class="button dropdown">Questões</button>
			<ul id="questoes" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
				<li><a href="#" id="publico">Banco Público</a></li>
				<li><a href="#" id="privado">Banco Privado</a></li>
			</ul>
		</ul>';
?>