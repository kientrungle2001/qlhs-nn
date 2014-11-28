<?php
	class PzkHomeQuestion extends PzkObject
	{
		public function listQuestion()
		{
			$listQuestion = _db()->select('*')->from($this->table)->result();
			return $listQuestion;
		}
		/**
		 * [listAnswer description]
		 * @author :JosT
		 * @date   :2014-11-28
		 * @return [type]      [description]
		 */
		
		public function listAnswer()
		{
			$listAnswer = _db()->select('*')->from('answers')->result();
			return $listAnswer;
		}		
	}
 ?>