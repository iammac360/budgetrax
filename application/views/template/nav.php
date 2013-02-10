<ul class="nav">
	<li><a href="<?php site_url(); ?>" style="font-weight: bold">Budgetrax</a></li>
</ul>
<ul class="nav" >
	<li class=" active"><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo  base_url()?>">Home</a></li>
	<li><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo  base_url()?>">Charts & Graphs</a></li>
	<li><a class="<?php echo isActive($pageName,"home")?>" href="<?php echo  base_url()?>">Balance</a></li>
</ul>

<ul class="nav pull-right">
	<?php if(!empty($user_id)): ?>
	<li style="margin-right: 120px;"><a href="<?php echo $logout_url; ?>">Logout</a></li>
	<?php endif; ?>
</ul>