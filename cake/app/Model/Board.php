<?php
    class Board extends Model{
        public $name = 'Board';
        public $useTable = 'boards';
        public $belongsTo = array('User');
        

		public function del($data){
			$this->delete($data["Board"]["id"]);
		}
    }
?>