<?php
require(dirname(__FILE__).'/../vendor/autoload.php');
include_once '../postgres/query.php';
class notification{
	/*
	 * $from -> uid of sender
	 * $to -> uid of receiver
	 */
	var $pusher;
	public function __construct(){
		$this->pusher=new Pusher('39709b3d935be0f19bb0', '529cd3e432b46d42848a', '270627');
	}
	public function commented($from,$to){
		$o=new query();
		$data['message']=$o->getUnameForUidFromUser($from)[0]." commented on your post.";
		($this->pusher)->trigger('notification-'.$to, 'comment', $data);
		$o->putNotification($to, $data['message']);
	}
	public function messaged($from,$to,$message){
		$o=new query();
		$data['name']=$o->getUnameForUidFromUser($from)[0];
		$data['message']=$message;
		($this->pusher)->trigger('notification-'.$to, 'message', $data);
	}
	public function followed($from,$to){
		$o=new query();
		$data['message']=$o->getUnameForUidFromUser($from)[0]." followed you.";
		($this->pusher)->trigger('notification-'.$to, 'follow', $data);
		$o->putNotification($to, $data['message']);
	}
}