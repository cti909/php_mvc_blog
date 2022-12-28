<?php

use function PHPSTORM_META\type;

class posts_controller extends main_controller
{
	// lay ten tac gia + noi dung + thong ke comment va like bai viet do
	// co nut xem chi tiet -> hien thi bai viet va chi tiet cac cac comment
	// xoa post thi xoa het toan bo post like comment
	// sua post -> sua content
	// them post mac dinh like=0 comment.count=0
	
	public function index()
	{
		$posts = post_model::getInstance();
		// $this->records = $posts->getAllRecords();
		$this->records = $posts->getAllPost();
		$this->setProperty('records',$this->records); //dang k=>v
		
		$likes = like_model::getInstance();
		$item = $posts->getAllPost();
		$this->like = array();
		$this->user_liked = array();
		$this->count = 0;
		while($roww = mysqli_fetch_array($item)){
			$id = $roww['id'];
			$soluong = $likes->getAllLike('post_id', $id);
			// $re1 = mysqli_fetch_array($soluong);
			$this->like[$this->count] = $soluong; // so tung cmt

			if(isset($_SESSION['user_id'])) {
			$nd = $likes->userLike($_SESSION['user_id'],$id,'NULL');
			$this->user_liked[$this->count] = false;
			while($re2 = mysqli_fetch_array($nd)) { // ktra chu post like
				if($_SESSION['user_id']==$re2['user_id']) {
					$this->user_liked[$this->count] = true;
					break;
				}
			}
			}
			$this->count++;
		}
		$this->display();
	} 
	public function like($params) {
		// object: post_id? comment_id?
		//id cua post, comment
		$likes = like_model::getInstance();
		$object = $params['like'];
		// $object1 = $params['id'];
		// echo $object1;
		if($object == "liked") {
			$likes->userDelLike($_SESSION['user_id'], $params['id'], 'NULL');
		} else if($object == "not_liked"){
			$likes->userAddLike($_SESSION['user_id'], $params['id'], 'NULL');
		}
		header( "Location: ".html_helpers::url(array('ctl'=>'posts',)));
		// header( "Location: ".html_helpers::url(array('ctl'=>'posts',
		// 										'act'=>'detail',
		// 										'params' => array(
		// 											'id'=> $params['id'],
		// 											// 'user_like'=> $params['user_like'],
		// 											// 'post_like' => $params['post_like']
		// 											// 'user_like'=> $this->user_liked
		// 										)
		// 										)));
	}
	public function processViewCmt($path) {
		if($path==null) {

		}
	} 
	public function detail($params) //detail
	{ 
		// id: post_id
		$pos = post_model::getInstance();
		$com = comment_model::getInstance();
		$likes = like_model::getInstance();

		// $item = $posts->getAllPost();
		// $this->like = array();
		// $this->user_liked = array();
		// $this->count = 0;
		// while($roww = mysqli_fetch_array($item)){
			// $id = $roww['id'];
			$id = $params['id'];
			$this->post_count_like = $likes->getAllLike('post_id', $id);
			// $re1 = mysqli_fetch_array($soluong);
			// $this->like[$this->count] = $soluong; // so tung cmt

			if(isset($_SESSION['user_id'])) {
				$nd = $likes->userLike($_SESSION['user_id'],$id,'NULL');
				$this->user_like = false;
				while($re2 = mysqli_fetch_array($nd)) { // ktra chu post like
					if($_SESSION['user_id']==$re2['user_id']) {
						$this->user_like = true;
						break;
					}
				}
			}
			// $this->count++;
		// }


		// $this->post_count_like = $params['post_like'];
		// $this->user_like = $params['user_like'];
		$this->postDetail = $pos->getDetailPost($params['id']);
		$this->records = $com->getAllComment($params['id']);
		$item = $com->getAllComment($params['id']); // lay cmt cua post co id
		$this->comment_count=0; // tong so luong cmt cua post thu id
		$this->mar_len = array(); // so luong ptu trong moi path
		$this->comment_liked = array();
		
		$this->like = array(); // so luong like moi cmt
		$this->user_liked = array();
		$max_arr = 0; // max cua path
		$str = array(); // mang cac path - kieu string // echo gettype($str[2]);
		while($roww = mysqli_fetch_array($item)){

			$id = $roww['id'];
			$soluong = $likes->getAllLikeCmt('comment_id', $id);
			// $re1 = mysqli_fetch_array($soluong);
			$this->like[$this->comment_count] = $soluong; // so tung cmt
			$nd = $likes->userLikeCmt($_SESSION['user_id'],$params['id'],$id); // list user da like

			$this->user_liked[$this->comment_count] = false;
			while($re2 = mysqli_fetch_array($nd)) { // ktra chu post like
				if($_SESSION['user_id']==$re2['user_id']) {
					$this->user_liked[$this->comment_count] = true;
					break;
				}
			}
			//xu ly path
			$str[$this->comment_count] = $roww['path']; // bat dau tu 0
			// echo $str[$this->comment_count]."--";
			if($str[$this->comment_count]!=null) {
				$arr = explode(".",$str[$this->comment_count]);
				$this->mar_len[$this->comment_count] = sizeof($arr);
			} else $this->mar_len[$this->comment_count] = 0;
			if($max_arr < $this->mar_len[$this->comment_count]) $max_arr = $this->mar_len[$this->comment_count];
			$this->comment_count++;
			
		}
		// xu ly hien thi cmt
		// $arr_pt = array();
		// $arr_sort = array();
		// for($index=0; $index<$max_arr; $index++) {
		// 	for($ii=0; $ii<$this->comment_count; $ii++) {
		// 		$arr = explode(".",$str[$ii]);
		// 		// $arr_pt[$ii] = $arr[$index];
		// 		// echo $arr[$index];
		// 		print_r($arr);
		// 	}
		// }
		// sort($str);
		// print_r($str);
		// $this->stt = $str;
		// print_r($this->stt);
		$this->display();
	}

	public function add() 
	{
		if(isset($_POST['btn_submit'])) {
			$postData = $_POST['data'][$this->controller];
			// echo $_SESSION['user_id'];
			$postData['creator_id'] = $_SESSION['user_id'];
			// foreach($postData as $k=>$v) {
			// 	echo $k."  ".$v;
			// }
			if(!empty($postData['content']))  {
				$posts = post_model::getInstance();
				if($posts->addRecord($postData))
					header( "Location: ".html_helpers::url(array('ctl'=>'posts')));
			}
		}
		$this->display();
	}

	public function edit($post_id) {
		$post = post_model::getInstance();
		$record = $post->getRecord($post_id);
		$this->setProperty('record',$record);
		if(isset($_POST['btn_submit'])) {
			$postData = $_POST['data'][$this->controller];
			// echo $post_id;
			if(!empty($postData['content']))  {
				if($post->editRecord($post_id, $postData))
					header( "Location: ".html_helpers::url(array('ctl'=>'posts')));
			}
		}
		$this->display();
	}
	
	public function delPost($params) // chua xu ly
	{
		$post_id = $params['id'];
		$like = like_model::getInstance();
        $comment = comment_model::getInstance();
        $post = post_model::getInstance();
        // $like->delLikeCmt($params['post_id'], $params['comment_id']);
		$like->delLike($post_id);
		$comment->delComment($post_id);
		$post->delRecord($post_id);
		header( "Location: ".html_helpers::url(array('ctl'=>'posts')));
		$this->display();
	}
}
?>
