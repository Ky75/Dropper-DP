<?php

namespace KYUMA;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use KYUMA\EventListener;
class Loader extends PluginBase
{
   
   /**Plugin Enabling**/
   public function onEnable()
   {
      /** Create Config File **/
      @mkdir($this->getDataFolder());
      
      /** File Content **/
      $Data = ["seconds" => 3];
      
      /** new Config(Path: $this->getDataFolder() . Name: "config.yml", Type: Config::YAML) **/
      $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, $Data);
      /** Save File **/
      $config->save();
      
      /** End Config **/
      
      /** Link Event PHP with Loader PHP **/
      $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
      
      /** Link Task PHP with Loader PHP **/
      $seconds = $this->getConfig()->get("seconds");
      $this->getScheduler()->scheduleRepeatingTask(new DropperTask($this), 20 * $seconds);
   }
}