<ul class="nav" >
	<li class=" active"><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo  base_url()?>">Home</a></li>
</ul>

<ul class="nav pull-right">
	<?php if(!empty($user_id)): ?>
	<li ><a href="<?php echo $logout_url; ?>">Logout</a></li>
	<?php endif; ?>
</ul>