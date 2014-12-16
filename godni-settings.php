<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Ajustes GoDNI</h2>

<form method="post" action="">
<table class="form-table">
	<tbody>
	<tr valign="top">
		<th scope="row">Mostrar en el formulario de registro</th>
		<td>
		<fieldset><legend class="screen-reader-text"><span>Mostrar en el formulario de registro</span></legend>
			<label title="godni_register"><input type="radio" name="godni_register" value="1" <?php echo ($godni_register==1?'CHECKED':''); ?> /> <span>Si</span></label><br />
			<label title="godni_register"><input type="radio" name="godni_register" value="0" <?php echo ($godni_register==0?'CHECKED':''); ?> /> <span>No</span></label><br />
		</fieldset>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">Mostrar en el Perfil de cada usuario</th>
		<td>
		<fieldset><legend class="screen-reader-text"><span>Mostrar en el Perfil de cada usuario</span></legend>
			<label title="godni_profile"><input type="radio" name="godni_profile" value="1" <?php echo ($godni_profile==1?'CHECKED':''); ?> /> <span>Si</span></label><br />
			<label title="godni_profile"><input type="radio" name="godni_profile" value="0" <?php echo ($godni_profile==0?'CHECKED':''); ?> /> <span>No</span></label><br />
		</fieldset>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">Agregar una columna de DNI en la lista de usuarios</th>
		<td>
		<fieldset><legend class="screen-reader-text"><span>Agregar una columna de DNI en la lista de usuarios</span></legend>
			<label title="godni_column"><input type="radio" name="godni_column" value="1" <?php echo ($godni_column==1?'CHECKED':''); ?> /> <span>Si</span></label><br />
			<label title="godni_column"><input type="radio" name="godni_column" value="0" <?php echo ($godni_column==0?'CHECKED':''); ?> /> <span>No</span></label><br />
		</fieldset>
		</td>
	</tr>
	</tbody>
</table>
<p class="submit"><input type="submit" name="godni-submit" id="godni-submit" class="button button-primary" value="Guardar cambios"></p>
</form>

<!--form method="post" action="">
	<p><input type="checkbox" name="godni-checkreset" value="1" />Reinicar todos los datos<br /><input type="submit" name="godni-reset" id="godni-reset" class="button button-primary" value="Reiniciar todo"></p>
</form-->

</div>