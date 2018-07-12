<?php

namespace KYUMA;

use pocketmine\event\Listener;
use pocketmine\event\block\SignChangeEvent;

class EventListener implements Listener
{
   /** when player write in sign **/
   public function onSign(SignChangeEvent $event)
   {
      $player = $event->getPlayer();
      /** check sign title **/
      if($event->getLine(0) == "Dropper")
      {
         /** Check player permission **/
         if($player->isOp())
         {
            if($event->getLine(2) == null)
            {
               $event->setLine(2, 0);
            }
            $player->sendMessage("Create Sign Successfly");
         }
         else
         {
            $player->sendMessage("§cYou have not permissions to use this plugin!");
         }
      }
   }
}