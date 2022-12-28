<?php
class comment_model extends main_model {
	protected $table = 'comments';
	public function getMaxId() {
		$query = "SELECT MAX(id) FROM comments;";
		$result = mysqli_query($this->con,$query);
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
	public function getAllComment($post_id) {
		$query = "SELECT users.name, comments.id, comments.content, comments.posting_time, comments.post_id ,comments.path FROM comments, users, posts 
					where users.id = comments.creator_id and comments.post_id = posts.id and comments.post_id =".$post_id." ORDER BY comments.path ASC;";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	public function delComment($post_id) {
		$query = "DELETE FROM $this->table WHERE post_id=".$post_id; // "" co the "$post_id"
		return mysqli_query($this->con,$query);
	}
	public function getPostId($comment_id) {
		$query = "SELECT post_id FROM comments where id=$comment_id";
		$result = mysqli_query($this->con,$query);
		$row = mysqli_fetch_array($result);
		return $row[0];
	}
}
?>
