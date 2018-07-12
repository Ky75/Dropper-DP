<?php

namespace KYUMA;

use pocketmine\scheduler\Task;
/** math **/
use pocketmine\math\Vector3;
/** tile **/
use pocketmine\tile\Sign;
/** item **/
use pocketmine\item\Item;

class DropperTask extends Task
{
   public function __construct(Loader $loader)
   {
      $this->loader = $loader;
   }
   /** drop Item **/
   public function onRun(int $currentTick)
   {
      $players = $this->loader->getServer()->getOnlinePlayers();
      /** Get "online" players **/
      foreach($players as $player)
      {
         //** get level to drop item **/
         $levelname = $player->getLevel()->getFolderName();
         /** get Level By Name **/
         $level = $this->loader->getServer()->getLevelByName($levelname);
         /** get Tiles in Level **/
         $tiles = $level->getTiles();
         foreach($tiles as $tile)
         {
            /** check if tile is sign **/
            if($tile instanceof Sign)
            {
               $text = $tile->getText();
               /** check title sign **/
               if($text[0] == "Dropper"){
                  /**
                  Drop Item 
                  
                  $level->dropItem(Position : new Vector3(int: x, int: y, int: z), Item: Item::get(int: id, int: damage, int: amount));
                  **/
                  $id = (int) $text[1];
                  $damage = (int) $text[2];
                  $amount = (int) $text[3];
                  $level->dropItem(new Vector3($tile->x, $tile->y + 2, $tile->z), Item::get($id, $damage, $amount));
               }
            }
         }
      }
   }
}