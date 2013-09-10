<?php

/*
__Pocketmine Plugin__
name=RageQuit
version=0.2.1
author=ZacHack
class=Rage
apiversion=9, 10
*/

class Rage implements Plugin{
		private $api, $config;
		public function __construct(ServerAPI $api, $server = false){
				$this->api = $api;
		}
		
		public function init(){
				$this->config = new Config($this->api->plugin->configPath($this)."config.yml", CONFIG_YAML, array(
						"RageQuit text" => "<Custom Text Here>",
						"Action Text" => "<Custom Text here>",
				));
				$this->rage = $this->config->get("RageQuit text");
				$this->action = $this->config->get("Action Text");
				$this->api->addHandler("player.quit", array($this, "handle"), 15);
				$this->api->console->register("ragequit", "<reload>", array($this, "reload"));
				$this->api->console->alias("rq", "ragequit");
		}
		
		public function __destruct(){
		
		}
		
		public function handle($data, $event){
				$user = $data->username;
				switch($event){
						case "player.quit";
								$this->api->chat->broadcast(" ".$this->rage." ");
								$this->api->chat->broadcast(" ".$user." ".$this->action." ");
								break;
				}
		}
}
