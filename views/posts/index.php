<?php
global $mediaFiles;
array_push($mediaFiles['css'], RootREL.'media/fontawesome/css/all.css');
?>
<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="row row-offcanvas row-offcanvas-right">
  	<div class="col-xs-12 col-sm-9">
	<?php $i=0; ?>
  	<?php if($this->records) { ?>
		<?php while($row = mysqli_fetch_array($this->records)) : ?>
			<div class="d-flex">
				<h4><?php echo $row['name']; ?></h4>
				<?php if(isset($_SESSION['user_id'])) {
					if($_SESSION['username'] == $row['name']) { // xu ly sua xoa?> 
				<a role="button" class="btn btn-warning mx-3" href="<?php echo html_helpers::url(
									array('ctl'=>'posts', 
										'act'=>'edit',
										'params'=>array(
											'id'=>$row['id']
									))); ?>">
					Edit post
				</a>
				<a role="button" class="btn btn-danger" href="<?php echo html_helpers::url(
									array('ctl'=>'posts', 
										'act'=>'delPost',
										'params'=>array(
											'id'=>$row['id']
									))); ?>">
					Delete post
				</a>
				<?php } }// end?>				
			</div>
			<p>Posting time: <?php echo $row['posting_time'];?></p>
			<p><?php echo $row['content']; ?></p>
			<div class="d-flex">
				<a role="button" class="btn btn-primary" href="<?php echo html_helpers::url(
									array('ctl'=>'posts', 
										'act'=>'like',
										'params'=>array(
											'like' => ($this->user_liked[$i])? 'liked' : 'not_liked',
											'id'=>$row['id'], // id post

										)
									)); ?>">
					<?php echo ($this->user_liked[$i])? "Like" : "Not like" ?>
					(<?php echo $this->like[$i]; ?>)
				</a>
				<a role="button" class="btn btn-info mx-3" href="<?php echo html_helpers::url(
									array('ctl'=>'posts', 
										'act'=>'detail',
										'params'=>array(
										'id'=>$row['id'],
										'post_like'=> $this->like[$i],
										'user_like'=> $this->user_liked[$i]
									)
									)); ?>">
					View detail
				</a>				
			</div>
			<hr>
			<?php $i++; ?>
		<?php endwhile; ?>
	<?php } else { ?>
			<p>There are no records</p> 
	<?php }  ?>
</div>
 <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	<?php include_once 'views/widgets/sidebar.php'; ?>
</div>
</div>
<?php array_push($mediaFiles['js'], RootREL."media/js/jquery.min.js"); ?>
<?php array_push($mediaFiles['js'], RootREL."media/js/students.js"); ?>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
