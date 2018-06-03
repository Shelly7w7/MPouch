<?php

namespace MPouch;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat as TF;

use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener {
	
	public function onEnable() {
		
		$this->getLogger()->info("MoneyPouch by Shelly enabled");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
	}
	
		public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		
		if(strtolower($command->getName()) === "mp") {
			
			if(count($args) < 2) {
			
				$sender->sendMessage(TF::GRAY . "[" . TF::BLUE . "OPE" . TF::GRAY . "]" . TF::GRAY . " /mp <player> <tier>");
				return true;
			 
			}
			if($sender->hasPermission("moneypouch.command.give") || $sender->isOp()){
				
				if(isset($args[0])) {
				
					$player = $sender->getServer()->getPlayer($args[0]);
					
					if(isset($args[1])) {
						
						switch($args[1]) {
						
						case "tier1":
						
					
						
						$t1 = Item::get(379, 101, 1);
						$t1->setCustomName(TF::GREEN . "Money Pouch " . TF::GRAY . "(Right Click)");
						$t1->setLore([
						"",
						TF::GRAY . "Right Click " . TF::GREEN . "to obtain money from your ",
						TF::GRAY . "tier 1" . TF::GREEN . " money pouch",
						"",
						TF::GREEN . "Get " . TF::GRAY . "Money Pouches " . TF::GREEN . "by",
						TF::GREEN . "mining " . TF::GRAY . "Relics" . TF::GREEN . " and buying",
						TF::GREEN . "it from our Buycraft store",
						""
						]);
						
						$player->getInventory()->addItem($t1);
						
						break;
						
						case "tier2":
						
					
						
						$t2 = Item::get(379, 102, 1);
						$t2->setCustomName(TF::GREEN . "Money Pouch " . TF::GRAY . "(Right Click)");
						$t2->setLore([
						"",
						TF::GRAY . "Right Click " . TF::GREEN . "to obtain money from your ",
						TF::GRAY . "tier 2" . TF::GREEN . " money pouch",
						"",
						TF::GREEN . "Get " . TF::GRAY . "Money Pouches " . TF::GREEN . "by",
						TF::GREEN . "mining " . TF::GRAY . "Relics" . TF::GREEN . " and buying",
						TF::GREEN . "it from our Buycraft store",
						""
						]);
						
						$player->getInventory()->addItem($t2);
						
						break;
						
						}
					}
				}
			}
			if(!$sender->hasPermission("moneypouch.command.give")) {
				
				$sender->sendMessage(TF::GRAY . "[" . TF::BLUE . "OPE" . TF::GRAY . "]" . TF::GRAY . " You dont have permission");
				
			}
			
			else {
				
				$sender->sendMessage(TF::GRAY . "[" . TF::BLUE . "OPE" . TF::GRAY . "]" . TF::GRAY . " You have received your money pouch!");
				
			}
		}
		
		return true;
	}
		
		public function onInteract(PlayerInteractEvent $event) {
		
		$player = $event->getPlayer();
		
		if($event->getItem()->getId() === 379) {
		
			$damage = $event->getItem()->getDamage();
			
			switch($damage) {
				
				case 101:
				
				$t1 = Item::get(379, 101, 1);
				$tier1win = rand(10000, 25000);
				
				EconomyAPI::getInstance()->addMoney($player, $tier1win);
				
				$player->sendMessage(TF::GRAY . "[" . TF::BLUE . "OPE" . TF::GRAY . "]" . TF::GRAY .  TF::GRAY . " You have won:" . TF::BOLD . TF::LIGHT_PURPLE . " $" . $tier1win);
				$player->getInventory()->removeItem($t1);
				
				break;
				
				case 102:
				
				$t2 = Item::get(379, 102, 1);
				$tier2win = rand(15000, 45000);
				
				EconomyAPI::getInstance()->addMoney($player, $tier2win);
				
				$player->sendMessage(TF::GRAY . "[" . TF::BLUE . "OPE" . TF::GRAY . "]" . TF::GRAY .  TF::RESET . TF::GRAY . " You have won:" . TF::BOLD . TF::LIGHT_PURPLE . " $" . $tier2win);
				$player->getInventory()->removeItem($t2);
				
				break;
				}
			}
		}
				
				
				public function onPlace(BlockPlaceEvent $event) {
		
		if($event->getItem()->getId() == 379) {
			
			$damage = $event->getItem()->getDamage();
			
			if($damage === 101 && $damage === 102) {
				
				$event->setCancelled();
				
			
			}
		}
	}
}
	


					
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						