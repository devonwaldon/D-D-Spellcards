<!-- Add Source Modal -->
<div id="modal--add-source" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal"><span class="icon-close"></span></button>
				<div class="modal-title">Add Spell Source File</div>
			</div>

			<div class="modal-body">
				<p>Select your custom spell card data file, and click 'Upload File'. For formatting instructions, see our <a href="" target="_blank">GitHub documentation</a>.</p>

				<form action="" id="custom-source__settings">

					<label for="custom-source__name">Spell File <span class="required">*</span></label>
					<div class="file-wrapper">
						<input type="file" name="custom-source__name" id="custom-source__name" required>
						<label for="custom-source__name" class="btn ghost">Choose File</label>
					</div>

				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="custom-source__settings" value="Upload File" class="btn">Upload File</button>
			</div>

		</div>
	</div>
</div>