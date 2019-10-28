<div class="hbox">
	<h4>Edit Language</h4>
</div>
<div class="hbox">
	<?php echo form_open();?>
		  <div class="form-group row">
		    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
		    <div class="col-sm-10">
		      <input type="text" name="name" class="form-control" value="<?php echo @$data->name;?>" id="inputEmail3" placeholder="Language Name">
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="inputEmail3" class="col-sm-2 col-form-label">Flag</label>
		    <div class="col-sm-10">
		      <input type="text" name="flag" class="form-control"  value="<?php echo @$data->flag;?>" id="inputEmail3" placeholder="Icoins">
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="inputEmail3" class="col-sm-2 col-form-label">Ky Hieu</label>
		    <div class="col-sm-10">
		      <input type="text" name="tags" class="form-control" value="<?php echo @$data->tags;?>" id="inputEmail3" placeholder="Ky Hieu">
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
		    <div class="col-sm-10">
		      <input type="checkbox" name="status" class="checkbox" <?php echo @$data->status == 1 ? "checked" : "";?> id="inputEmail3" value="1"> On / Off
		    </div>
		  </div>

		  <div class="form-group row">
		  	<label for="inputEmail3" class="col-sm-2 col-form-label">&nbsp;</label>
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-primary">Save</button>
		    </div>
		  </div>
	</form>
</div>