<?php
  class Task {
		private $id;
		private $name;
		private $parentId;
		
		public function __construct($id, $name, $parentId) {
			$this->id = $id;
			$this->name = $name;
			$this->parentId = $parentId;
		}
		
		
		public function getId() {
			return $this->id;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getParent() {
			return $this->parentId;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function setName($name) {
			$this->name = $name;
		}
			
		public function setParent($parent) {
			$this->parentId = $parentId;
		}
		
		public function getSubtasks() {
			$return = array();
			$result = mysql_query("SELECT * FROM wbt_task WHERE task_parent = ".$this->getId());
			while ($row = mysql_fetch_assoc($result)) {
				$task = new Task($row["task_id"], $row["task_name"], $row["task_parent"]);
				$return[] = $task;
			}	
			return $return;			
		}		
	}
?>
