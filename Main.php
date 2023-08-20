<?php

namespace HUBCORE;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent; // Import the PlayerJoinEvent
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class YourPlugin extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        
        // Give the player the special item when they join
        $this->giveSpecialItem($player);
    }

    public function onPlayerInteract(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();

        // Check if the player is holding an item and right-clicked
        if ($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR || $event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK) {
            if ($item instanceof Item && $item->getCustomName() === "§l§9[Navigator]") {
                // Replace "your_command_here" with the actual command you want to run
                $this->getServer()->dispatchCommand($player, "/warpgui");
                
                // Alternatively, you can open a menu here
                // $this->openMenu($player);
            }
        }
    }
    
    private function giveSpecialItem(Player $player) {
        $specialItem = Item::get(Item::COMPASS); // Customize the item type if needed
        $specialItem->setCustomName("§l§9[Navigator]");
        
        $player->getInventory()->addItem($specialItem);
    }
    
    // You can define the menu opening logic here
    // private function openMenu(Player $player) {
    //     // Implement your menu opening logic
    // }

}
