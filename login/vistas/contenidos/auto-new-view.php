<?php 
if ($_SESSION['privilegio_spm']!=1) {
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
 ?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO AUTO
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>auto-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO AUTO</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>auto-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE AUTOS</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>auto-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR AUTO</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<form  class="form-neon FormularioAjax"action="<?php echo SERVERURL; ?>ajax/autoAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_placa" class="bmd-label-floating">Placa</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{6,20}" class="form-control" name="auto_placa_reg" id="auto_placa" maxlength="20" required="">
						</div>
					</div>
				
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_chasis" class="bmd-label-floating">Chasis</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,100}" class="form-control" name="auto_chasis_reg" id="auto_chasis" maxlength="100" >
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="auto_color" class="bmd-label-floating">Color</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,35}" class="form-control" name="auto_color_reg" id="auto_color" maxlength="35">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="auto_modelo" class="bmd-label-floating">Modelo</label>
							<input type="text" pattern="[0-9()+]{4,20}" class="form-control" name="auto_modelo_reg" id="auto_modelo" maxlength="20">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="auto_marca" class="bmd-label-floating">Marca</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,190}" class="form-control" name="auto_marca_reg" id="auto_marca" maxlength="190">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>