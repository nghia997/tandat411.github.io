<div class="row">
  <div class="col-lg-6">
    <h2>Import CSV file to Database</h2>
    <form action=<?= $this->request->here ?> method="post" enctype="multipart/form-data">
      <div class="input-group">
        <input name="fileImport" type="file" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-secondary" name="btnImport" type="submit">Import</button>
        </span>
      </div>
		<?php 
		// Check validate extension of file upload
		if (isset($fileImport)) {
			// Run loop to print every error of input file to Import
			foreach ($fileImport as $error){
				echo "<p class='alert-danger'>{$error}</p>";
			}
		}
		// Check validate of single record in CSV file
		if (isset($valid) && $valid != null) {
			// Run loop to get num of line and errors in that line
			foreach ($valid as $item) {
				echo "<p class='alert-danger'> --> Line ".$item['line'].": ";
				// Run loop to print every list error
				foreach ($item[0] as $listError){
					// Run loop to get single error in list error
					foreach ($listError as $error){
						echo $error;
						echo '<br>';
					}
				}
				echo '<br>';
			}
		}
		?>
    </form>
  </div>
  <div class="col-lg-6">
    <h2>Export data from table 'tbl_staff'</h2>
    <form action=<?= $this->request->here ?> method="post" enctype="multipart/form-data">
      <div class="input-group">
        <span class="input-group-btn">
          <button class="btn btn-secondary" name="btnExport" type="submit">Export</button>
        </span>
      </div>
    </form>
  </div>
</div>