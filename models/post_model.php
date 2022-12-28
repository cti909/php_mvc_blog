<?php
class post_model extends main_model {
	protected $table = 'posts';
	public function getAllPost() {
		$query = "SELECT users.name, posts.id, posts.content, posts.posting_time FROM posts, users where users.id = posts.creator_id";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	public function getDetailPost($post_id) {
		$query = "SELECT users.name, posts.id, posts.content, posts.posting_time FROM posts, users where users.id = posts.creator_id and posts.id=".$post_id;
		$result = mysqli_query($this->con,$query);
		return $result;
	}
}
?>
