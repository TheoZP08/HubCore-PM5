<?php

namespace MyPlugin;

use pocketmine\plugin\PluginBase; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;

class Main extends PluginBase {

  private $testCommand;

  public function onEnable(){

    $this->testCommand = new TestCommand($this);
    $this->getServer()->getCommandMap()->register("test", $this->testCommand);

  }

  public function onDisable(){

    $this->getServer()->getCommandMap()->unregister($this->testCommand);

  }

}

class TestCommand extends Command {

  private $plugin;

  public function __construct(Main $plugin) {

    parent::__construct("test");
    $this->plugin = $plugin;

  }

  public function execute(CommandSender $sender, string $commandLabel, array $args) {

    if(!$sender instanceof Player) {
      $sender->sendMessage("This command can only be used in-game");
      return;
    }

    if(count($args) < 1) {
      $sender->sendMessage("Usage: /test <message>");
      return;
    }

    $message = implode(" ", $args);

    foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
      $player->sendMessage("§c<$sender->getName()> $message");
    }

    return true;

  }

}
