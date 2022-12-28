<?php
class like_model extends main_model {
	protected $table = 'likes';
	public function getAllLike($object,$id) {
		$query = "SELECT COUNT($object) as soluong FROM $this->table WHERE $object = $id and isnull(comment_id)";
		$result = mysqli_query($this->con,$query);
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
	public function getAllLikeCmt($object,$id) {
		$query = "SELECT COUNT($object) as soluong FROM $this->table WHERE $object = $id;";
		$result = mysqli_query($this->con,$query);
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
	//
	public function userLike($user_id, $post_id,$comment_id) { // check da like chua
		$query = "SELECT user_id FROM $this->table WHERE post_id = $post_id and isnull(comment_id)";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	public function userLikeCmt($user_id, $post_id,$comment_id) { // check da like chua
		$query = "SELECT user_id FROM $this->table WHERE post_id = $post_id and comment_id = $comment_id";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	//
	public function userDelLike($user_id, $post_id, $comment_id=null) {
		$query = "DELETE FROM $this->table WHERE user_id = $user_id and post_id = $post_id and isnull(comment_id)";
		$result = mysqli_query($this->con,$query);
	}
	public function userDelLikeCmt($user_id, $post_id, $comment_id) {
		$query = "DELETE FROM $this->table WHERE user_id = $user_id and post_id = $post_id and comment_id = $comment_id";
		$result = mysqli_query($this->con,$query);
	}
	public function userAddLike($user_id, $post_id, $comment_id) {
		$query = "INSERT INTO $this->table (user_id,post_id,comment_id) VALUES ($user_id, $post_id, $comment_id);";
		$result = mysqli_query($this->con,$query);
	}
	//
	public function delLike($post_id) { // xoa like co post_id=...
		$query = "DELETE FROM $this->table WHERE post_id = $post_id";
		$result = mysqli_query($this->con,$query);
	}
	public function delLikeCmt($post_id, $comment_id) {
		$query = "DELETE FROM $this->table WHERE post_id = $post_id and comment_id = $comment_id";
		$result = mysqli_query($this->con,$query);
	}
}	
?>
