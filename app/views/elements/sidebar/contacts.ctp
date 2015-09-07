<div id="filter" class="sidebar-filters" class="col-md-12">
	<form>
	<h4>Filters</h4>
	<div class="row">
		<div class="input select">
    	<div class="col-md-12">
          <div class="form-group">
            <label for="basic" class="control-label">Search Contact</label>
                <select id="basic" name="contact" class="selectpicker show-tick form-control" data-live-search="true">
                
                  <!-- <option class="get-class" disabled>ox</option> -->
                  <!-- <optgroup label="PRueba" data-subtext="another test"> -->
                  <?php foreach ($contact_list as $key => $contact) {?>
                   <option <?php (!empty($_GET['contact']) && $_GET['contact']==$key) ? "selected" : '';  ?>value="<?php echo $key;?>"><?php echo $contact; ?></option>
                  <?php } ?>
                  <!-- </optgroup> -->
                </select>
          </div>
        </div>
      </div>
	</div>
	<div class="row">
		<div class="input select">
    	<div class="col-md-12">
          <div class="form-group">
            <label for="basic" class="control-label">Country</label>
                <select id="basic" name="country" class="selectpicker show-tick form-control" data-live-search="true">
                
                  <!-- <option class="get-class" disabled>ox</option> -->
                  <!-- <optgroup label="PRueba" data-subtext="another test"> -->
                  <?php foreach ($countries as $key => $country) {?>
                   <option <?php (!empty($_GET['country']) && $_GET['country']==$key) ? "selected" : '';  ?>value="<?php echo $key;?>"><?php echo $country; ?></option>
                  <?php } ?>
                  <!-- </optgroup> -->
                </select>
          </div>
        </div>
      </div>
	</div>
	<div class="row">
		<div class="input select">
    	<div class="col-md-12">
          <div class="form-group">
            <label for="basic" class="control-label">City</label>
                <select id="basic" name="city" class="selectpicker show-tick form-control" data-live-search="true">
                
                  <!-- <option class="get-class" disabled>ox</option> -->
                  <!-- <optgroup label="PRueba" data-subtext="another test"> -->
                  <?php foreach ($cities as $key => $city) {?>
                   <option <?php (!empty($_GET['city']) && $_GET['city']==$key) ? "selected" : '';  ?>value="<?php echo $key;?>"><?php echo $city; ?></option>
                  <?php } ?>
                  <!-- </optgroup> -->
                </select>
          </div>
        </div>
      </div>
	</div>
	<div class="row">
		<!-- <div class="input select"> -->
    	<div class="col-md-12">
          <button type="submit" class="btn btn-primary col-md-12">Filter</button>
        </div>
      <!-- </div> -->
	</div>
	</form>	
</div>

<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('List',array('controller'=>'contacts', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'contacts', 'action'=>'add'), array('icon'=>'plus'));?></li>
</ul>
	