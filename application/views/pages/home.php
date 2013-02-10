<div class="container">
	<div class="span3">
		<h1>Budgetrax</h1>
		<p>Hi <?php echo $user_name ?></p>
		<p><img src="<?php echo $profile_pic; ?>" alt="<?php echo $user_name ?>"></p>
	</div>
	<div class="span5">test</div>
	<div class="span3">
		<?php echo form_open(base_url().'process/addbudget', array('id' => 'process_budget')); ?>

			<?php echo form_label('Budget Name:', 'name'); ?>
			<?php echo form_input(array(
				'name'	=> 'name',
				'id'	=> 'budget_name',
			));?>

			<?php echo form_label('Budget Description:', 'description'); ?>
			<?php echo form_textarea(array(
				'name'	=> 'description',
				'id'	=> 'budget_description'
			)); ?>

			<?php echo form_label('Category:', 'category_id'); ?>
			<?php echo form_dropdown('category_id', $categories) ?>

			<?php echo form_label('Budget Type:', 'budget_type_id');?>
			<?php echo form_dropdown('budget_type_id', $budget_types) ?>

			<?php echo form_label('Amount', 'amount'); ?>
			<?php echo form_input(array(
				'name'  => 'amount',
				'id'	=> 'budget_amount'
			)); ?>

			<br />
			<?php echo form_submit('budget_add', 'Add Budget'); ?>
		<?php echo form_close(); ?>
	</div>
	<div class="clearfix"></div>
</div>

