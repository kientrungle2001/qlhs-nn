<?php
class PzkGameRainword extends PzkObject
{
	public function getGames()
	{
		$games=_db()->useCB()->select("*")->from("game_rainword")->where(array('parent','0'))->result();
		return($games);
	}
		
}

?>