<div class="modal-header">
	<h5 class="modal-title" id="modalLabel"><?php echo $page_heading?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">

	<div class="form">

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<div class="form-group">
			<label for="carownerslist_carowner_id"><?php echo lang('carownerslist_carowner_id')?>:</label>			
			<?php echo form_input(array('id'=>'carownerslist_carowner_id', 'name'=>'carownerslist_carowner_id', 'value'=>set_value('carownerslist_carowner_id', isset($record->carownerslist_carowner_id) ? $record->carownerslist_carowner_id :$this->session->userdata('user_id')), 'class'=>'form-control', 'readonly'=>'readonly'));?>
			<div id="error-carownerslist_carowner_id"></div>			
		</div>
		<div class="form-group">
			<label for="car_brands"><?php echo lang('car_brands')?>:</label> <!--Mitsubishi","Toyota","Ford","Chevrolet", "Nissan","Mazda","Volkswagen"-->
			<?php $options = create_dropdown('array', ',Mitsubishi,Toyota,Ford,Chevrolet,Nissan,Mazda,Volkswagen'); ?>
			<?php echo form_dropdown('car_brands', $options, set_value('car_brands', (isset($record->car_brands)) ? $record->car_brands : '', FALSE), 'id="car_brands" class="form-control"'); ?>
			<div id="error-car_brands"></div>
		</div>
		<div class="form-group">
			<label for="carownerslist_car_id"><?php echo lang('carownerslist_car_id')?>:</label>			
			
			<select id="carownerslist_car_id" class="custom-select">
				<?php foreach ($cars_model_list as $group):?>
					<option data-type="<?php echo $group->car_model_type; ?>" value="<?php echo $group->car_id?>"<?php echo (($group->car_id == $current_groups)) ? ' selected': ''; ?>><?php echo $group->car_model?></option>
				<?php endforeach; ?>
			</select>

			<div id="error-carownerslist_car_id"></div>			
		</div>

		<div class="form-group">
			<label for="carownerslist_plate_number"><?php echo lang('carownerslist_plate_number')?>:</label>			
			<?php echo form_input(array('id'=>'carownerslist_plate_number', 'name'=>'carownerslist_plate_number', 'value'=>set_value('carownerslist_plate_number', isset($record->carownerslist_plate_number) ? $record->carownerslist_plate_number : ''), 'class'=>'form-control', 'maxlength' => 7));?>
			<div id="error-carownerslist_plate_number"></div>			
		</div>
		<div class="form-group">
			<label for="car_idb"><?php echo lang('car_idb')?>:</label>			
			<?php echo form_input(array('id'=>'car_idb', 'name'=>'car_idb', 'value'=>set_value('car_idb', isset($record->car_idb) ? $record->car_idb : '', FALSE), 'class'=>'form-control', 'maxlength'=>25));?>
			<div id="error-car_idb"></div>			
		</div>
		<div class="form-group " >
			<label for="car_mileage"><?php echo lang('car_mileage')?>:</label>			
			<?php echo form_input(array('id'=>'car_mileage', 'name'=>'car_mileage', 'value'=>set_value('car_mileage', isset($record->car_mileage) ? $record->car_mileage : '', FALSE), 'class'=>'form-control', 'maxlength'=>15));?>
			<div id="error-car_mileage"></div>			
		</div>
		
		
		<div class="form-group " >
			<label for="car_mileage_discount"><?php echo lang('car_mileage_discount')?>:</label>			
			<?php echo form_input(array('id'=>'car_mileage_discount', 'name'=>'car_mileage_discount', 'value'=>set_value('car_mileage_discount', isset($record->car_mileage_discount) ? $record->car_mileage_discount : '', FALSE), 'class'=>'form-control', 'maxlength'=>15, 'readonly'=>'readonly'));?>
			<div id="error-car_mileage_discount"></div>			
		</div>


		<div class="form-group">
			<label for="carownerslist_rent_price"><?php echo lang('carownerslist_rent_price')?>:</label>			
			<?php echo form_input(array('id'=>'carownerslist_rent_price', 'name'=>'carownerslist_rent_price', 'value'=>set_value('carownerslist_rent_price', isset($record->carownerslist_rent_price) ? $record->carownerslist_rent_price : ''), 'class'=>'form-control', 'maxlength' => 15, 'readonly'=>'readonly'));?>
			<div id="error-carownerslist_rent_price"></div>			
		</div>


		<div class="form-group">
			<label for="rent_milediscount"><?php echo lang('rent_milediscount')?>:</label>			
			<?php echo form_input(array('id'=>'rent_milediscount', 'name'=>'rent_milediscount', 'value'=>set_value('rent_milediscount', isset($record->rent_milediscount) ? $record->rent_milediscount : ''), 'class'=>'form-control', 'maxlength' => 15, 'readonly'=>'readonly'));?>
			<div id="error-rent_milediscount"></div>			
		</div>


		<div class="form-group">
			<label for="carownerslist_status"><?php echo lang('carownerslist_status')?>:</label>
			<?php $options = create_dropdown('array', ',Active,Disabled'); ?>
			<?php echo form_dropdown('carownerslist_status', $options, set_value('carownerslist_status', (isset($record->carownerslist_status)) ? $record->carownerslist_status : ''), 'id="carownerslist_status" class="form-control"'); ?>
			<div id="error-carownerslist_status"></div>
		</div>



	</div>

</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close')?>
	</button>
	<?php if ($action == 'add'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_add')?>
		</button>
	<?php elseif ($action == 'edit'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_update')?>
		</button>
	<?php else: ?>
		<script>$(".modal-body :input").attr("disabled", true);</script>
	<?php endif; ?>
</div>	