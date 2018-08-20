<form action="" id="formAdd" method="POST">

	<div>
		<label>Título</label>
		<input class="form-control" type="text" name="titulo" id="titulo">
	</div>

	<div>
		<label>Data Início</label>
		<input class="form-control" type="date" name="inicio" id="inicio">
	</div>

	<div>
		<label>Prazo</label>
		<input class="form-control" type="date" name="prazo" id="prazo">
	</div>

	<div>
		<label>Descrição</label>
		<textarea class="form-control" id="editor1" name='descricao' id="descricao"></textarea>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-primary bt-pri" name="name" value="Gravar">
    </div>

</form
