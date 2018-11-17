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
			<label for="ratecar_car_model_id"><?php echo lang('ratecar_car_model_id')?>:</label>			
			<?php echo form_input(array('id'=>'ratecar_car_model_id', 'name'=>'ratecar_car_model_id', 'value'=>set_value('ratecar_car_model_id', isset($record->ratecar_car_model_id) ? $record->ratecar_car_model_id : ''), 'class'=>'form-control'));?>
			<div id="error-ratecar_car_model_id"></div>			
		</div>

		<div class="form-group">
			<label for="ratecar_rate"><?php echo lang('ratecar_rate')?>:</label>			
			<?php echo form_input(array('id'=>'ratecar_rate', 'name'=>'ratecar_rate', 'value'=>set_value('ratecar_rate', isset($record->ratecar_rate) ? $record->ratecar_rate : ''), 'class'=>'form-control'));?>
			<div id="error-ratecar_rate"></div>			
		</div>

		<div class="form-group">
			<label for="ratecar_rent_hr"><?php echo lang('ratecar_rent_hr')?>:</label>			
			<?php echo form_input(array('id'=>'ratecar_rent_hr', 'name'=>'ratecar_rent_hr', 'value'=>set_value('ratecar_rent_hr', isset($record->ratecar_rent_hr) ? $record->ratecar_rent_hr : ''), 'class'=>'form-control'));?>
			<div id="error-ratecar_rent_hr"></div>			
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