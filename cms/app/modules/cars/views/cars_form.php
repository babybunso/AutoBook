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
			<label for="car_model"><?php echo lang('car_model')?>:</label>			
			<?php echo form_input(array('id'=>'car_model', 'name'=>'car_model', 'value'=>set_value('car_model', isset($record->car_model) ? $record->car_model : '', FALSE), 'class'=>'form-control'));?>
			<div id="error-car_model"></div>			
		</div>

		<div class="form-group">
			<label for="car_model_type"><?php echo lang('car_model_type')?>:</label>
			<?php $options = create_dropdown('array', ',Hatchback,Sedan,MPV,SUV,Crossover,Coupe,Convertible'); ?>
			<?php echo form_dropdown('car_model_type', $options, set_value('car_model_type', (isset($record->car_model_type)) ? $record->car_model_type : '', FALSE), 'id="car_model_type" class="form-control"'); ?>
			<div id="error-car_model_type"></div>
		</div>

		<div class="form-group">
			<label for="car_brands"><?php echo lang('car_brands')?>:</label> <!--Mitsubishi","Toyota","Ford","Chevrolet", "Nissan","Mazda","Volkswagen"-->
			<?php $options = create_dropdown('array', 'Mitsubishi,Toyota,Ford,Chevrolet,Nissan,Mazda,Volkswagen'); ?>
			<?php echo form_dropdown('car_brands', $options, set_value('car_brands', (isset($record->car_brands)) ? $record->car_brands : '', FALSE), 'id="car_brands" class="form-control"'); ?>
			<div id="error-car_brands"></div>
		</div>

		<div class="form-group">
			<label for="car_year"><?php echo lang('car_year')?>:</label>			
			<?php echo form_input(array('id'=>'car_year', 'name'=>'car_year', 'value'=>set_value('car_year', isset($record->car_year) ? $record->car_year : ''), 'class'=>'form-control', 'maxlength'=>4));?>
			<div id="error-car_year"></div>			
		</div>
		
		<div class="form-group hide" style="display:none;">
			<label for="car_idb"><?php echo lang('car_idb')?>:</label>			
			<?php echo form_input(array('id'=>'car_idb', 'name'=>'car_idb', 'value'=>set_value('car_idb', isset($record->car_idb) ? $record->car_idb : '', FALSE), 'class'=>'form-control', 'maxlength'=>15));?>
			<div id="error-car_idb"></div>			
		</div>

		<div class="form-group">
			<label for="car_description"><?php echo lang('car_description')?>:</label>			
			<?php echo form_textarea(array('id'=>'car_description', 'name'=>'car_description', 'rows'=>'3', 'value'=>set_value('car_description', isset($record->car_description) ? $record->car_description : '', FALSE), 'class'=>'form-control')); ?>
			<div id="error-car_description"></div>			
		</div>

		<div class="form-group">
			<label for="car_image"><?php echo lang('car_image')?>:</label>			
			<?php echo form_input(array('id'=>'car_image', 'name'=>'car_image', 'value'=>set_value('car_image', isset($record->car_image) ? $record->car_image : ''), 'class'=>'form-control'));?>
			<div id="error-car_image"></div>			
		</div>

		<div class="form-group">
			<label for="car_status"><?php echo lang('car_status')?>:</label>
			<?php $options = create_dropdown('array', ',Active,Disabled'); ?>
			<?php echo form_dropdown('car_status', $options, set_value('car_status', (isset($record->car_status)) ? $record->car_status : ''), 'id="car_status" class="form-control"'); ?>
			<div id="error-car_status"></div>
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