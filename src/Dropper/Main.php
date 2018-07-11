<?php

namespace Dropper;

use pocketmine\plugin\PluginBase;

use pocketmine\scheduler\Task;

use pocketmine\math\Vector3;

use pocketmine\utils\TextFormat as T;
use pocketmine\utils\Config as C;

use pocketmine\item\Item;
use pocketmine\tile\Sign;

class Main extends PluginBase{
	
	public function onEnable(){
	@mkdir($this->getDataFolder());
	$second = [
	  'seconds' => 5,
	];
		$cfg = new C($this->getDataFolder() . "config.yml", C::YAML, $second);
		$cfg->save();
		$this->getScheduler()->scheduleRepeatingTask(new Task($this), $this->getConfig()->get("seconds")*20);
	}
	
	public function drop(){
		$players = $this->getServer()->getOnlinePlayers();
		foreach($players as $p){
			$lvname = $p->getLevel()->getName();
			$level = $this->getServer()->getLevelByName($lvname);
			$tiles = $level->getTiles();
			foreach($tiles as $t){
				if($t instanceof Sign){
					$text = $t->getText();
					if($text[0] == "Dropper"){
						$id = $text[1];
						$count = $text[3];
						$meta = $text[2];
						$level->dropItem(new Vector3($t->x, $t->y + 2, $t->z), Item::get($id, $meta, $count));
					}
				}
			}
		}
	}
}

class dropTask extends Task{
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onRun(int $currentTick){
		$this->plugin->drop();
	}
}
