<div class="adminBar">
	<div class="<?=$cont?>">
		<ul class="adminBar_menu">
			<li><a href="<?=base_url('admin')?>" target="_blank"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
			<li>
				<a><i class="glyphicon glyphicon-plus"></i> New</a>
				<ul>
					<li><a href="<?=base_url('admin/posts/add')?>" target="_blank">Post</a></li>
					<li><a href="<?=base_url('admin/categories/add')?>" target="_blank">Category</a></li>
					<li><a href="<?=base_url('admin/pages/add')?>" target="_blank">Page</a></li>
					<li><a href="<?=base_url('admin/add')?>" target="_blank">User</a></li>
					<li><a href="<?=base_url('admin/slider/add')?>" target="_blank">Slide</a></li>
				</ul>
			</li>
			<li><a href="<?=base_url('admin/settings/general')?>" target="_blank"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
			<li>
				<a target="_blank"><i class="glyphicon glyphicon-user"></i> <?=$CI->session->userdata('username')?></a>
				<ul>
					<li><a href="<?=base_url('admin/edit/'.$CI->session->userdata('id'))?>" target="_blank">Edit profile</a></li>				
					<li><a href="<?=base_url('admin/logout')?>">Logout</a></li>				
				</ul>			
			</li>
		</ul>
	</div>
</div>