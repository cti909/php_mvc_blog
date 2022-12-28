<?php
class comments_controller extends main_controller
{

	public function addcmt($params)
	{
		$comment = comment_model::getInstance();
		if(isset($_POST['btn_submit'])) {

			$commentData = $params;
			// phai xet truoc id neu ko thi ko the cap nhat path
			$commentData['id'] = $comment->getMaxId()+1;
			$commentData['content'] = $_POST['content'];

			if($commentData['path'] == "__") $commentData['path'] = $commentData['id'];
			else $commentData['path'] = $commentData['path'].".".$commentData['id'];
			
			$user_like = $commentData['user_like'];
			$post_count_like = $commentData['post_like'];
			unset($commentData['user_like']);
			unset($commentData['post_like']);
			if(!empty($commentData['content']))  {
				$comment = comment_model::getInstance();
				if($comment->addRecord($commentData))
					header( "Location: ".html_helpers::url(array('ctl'=>'posts',
															'act'=>'detail',
															'params' => array(
																'id'=> $commentData['post_id'],
															)
															)));
			}
		}
	}
	public function like($params) {
		$likes = like_model::getInstance();
		$object = $params['like'];
		if($object == "liked") {
			$likes->userDelLikeCmt($_SESSION['user_id'], $params['post_id'], $params['comment_id']);
		} else if($object == "not_liked"){
			$likes->userAddLike($_SESSION['user_id'], $params['post_id'], $params['comment_id']);
		}
		header( "Location: ".html_helpers::url(array('ctl'=>'posts',
											'act'=>'detail',
											'params' => array(
												'id'=> $params['post_id'],
												'user_like'=> $params['user_like'],
												'post_like' => $params['post_like']
												// 'user_like'=> $this->user_liked
											)
											)));
	}
	public function editComment($params) {
		// print_r($params);
		$comment = comment_model::getInstance();
		// $user_like= $params['user_like'];
		// $post_like = $params['post_like'];
		if(isset($_POST['btn_submit'])) {
			echo "vao";
			$commentData = $_POST['data'][$this->controller];
			// $commentData['content'] = $_GET['post_id'];
			// $commentData['creator_id'] = $_GET['creator_id'];
			// $commentData['path'] = $_GET['path'];
			if($comment->editRecord($params['comment_id'], $commentData)) {
				echo "hahaha";
				// header( "Location: ".html_helpers::url(array('ctl'=>'posts')));
				header( "Location: ".html_helpers::url(array('ctl'=>'posts',
											'act'=>'detail',
											'params' => array(
												'id'=> $params['post_id'],
												'user_like'=> $params['user_like'],
												'post_like' => $params['post_like']
												// 'user_like'=> $this->user_liked
											)
											)));
				}
		}
		$this->record = $comment->getRecord($params['comment_id']);
		include_once "views/posts/edit_cmt.php";
		
	}
	public function edit($comment_id) {
		echo $comment_id;
		$comment = comment_model::getInstance();
		$record = $comment->getRecord($comment_id);
		$this->setProperty('record',$record);
		if(isset($_POST['btn_submit'])) {
			$postData = $_POST['data'][$this->controller];
			// echo $post_id;
			if(!empty($postData['content']))  {
				if($comment->editRecord($comment_id, $postData))
					header( "Location: ".html_helpers::url(array('ctl'=>'posts',
															'act'=>'detail',
															'params' => array(
																'id'=> $comment->getPostId($comment_id)
															)
															)));
			}
		}
		// $this->display();
		include_once "views/posts/edit_cmt.php";
	}
	public function delcmt($params) 
	{
		$like = like_model::getInstance();
        $comment = comment_model::getInstance();
        $like->delLikeCmt($params['post_id'], $params['comment_id']);
		$comment->delRecord($params['comment_id']);
		header( "Location: ".html_helpers::url(array('ctl'=>'posts',
											'act'=>'detail',
											'params' => array(
												'id'=> $params['post_id'],
											)
											)));
	}
}
?>
