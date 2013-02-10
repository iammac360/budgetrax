<div class="container">
	<div class="span2">

		<p>Hi, <?php echo $user_name ?></p>
		<p><img src="<?php echo $profile_pic; ?>" alt="<?php echo $user_name ?>"></p>
	</div>
	<div class="span6">
		<h4>Budget Summary:</h4>
		<ul style="list-style: none; margin: 0;">
			<li style="border-bottom: 1px solid grey; margin-bottom: 20px;">
				<span style="display: inline-block;  width: 170px; font-weight: bold;">Date:</span>
				<span style="display: inline-block; width: 155px; font-weight: bold;">Name:</span>
				<span style="display: inline-block;  width: 50px; font-weight: bold;">Expense/Income:</span>
			</li>
		<?php foreach($budgets as $budget): ?>
			<?php $ts = strtotime($budget->date_created); ?>
			<?php 
				if($budget->budget_type_id === 1) $color = "red";
				if($budget->budget_type_id === 2) $color = "green";
			?>
			<li style="border-bottom: 1px solid grey; margin-bottom: 20px;">
				<span style="display: inline-block;  width: 170px; font-size: 10px"><?php echo mdate("%m %D %Y %d - %h:%i %a", $ts);  ?></span>
				<span style="display: inline-block; width: 200px"><?php echo $budget->name; ?></span>
				<span style="display: inline-block;  width: 50px; color: <?php echo $color; ?>" ><?php echo $budget->amount; ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="span3">
		<?php echo form_open(base_url().'process/addbudget', array('id' => 'process_budget')); ?>

			<?php echo form_label('Budget Name:', 'name'); ?>
			<?php echo form_input(array(
				'name'	=> 'name',
				'id'	=> 'budget_name'
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

