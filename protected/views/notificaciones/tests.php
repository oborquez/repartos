
<table id="required-tab">
	<tr>
		<td>Titulo</td>
		<td><input type="text" class="required" cond="not-empty"></td>
	</tr>
	<tr>
		<td>Edad</td>
		<td>
			<select class="required" cond=">0">
				<option val="0">0</option>
				<option val="1">1</option>
				<option val="2">2</option>
				<option val="3">3</option>
				<option val="4">4</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Comments</td>
		<td><textarea class="required" cond="not-empty"></textarea></td>
	</tr>
</table>

<a id="sendButton" class="optionButton"><i class="icon-save"></i> Guardar</a>


<script type="text/javascript">
	$("#sendButton").click(function(){

		console.log( validate("#required-tab") )

	})
</script>