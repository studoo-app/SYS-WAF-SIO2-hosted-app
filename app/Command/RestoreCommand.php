<?php

namespace Command;

use Services\RestoreDbService;
use Studoo\EduFramework\Commands\Extends\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'restore', description: 'Renseigner la description de la commande restore')]
class RestoreCommand extends \Studoo\EduFramework\Commands\Extends\CommandManage
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		self::$stdOutput->writeln([
		        CommandBanner::getBanner(),
		        'Lancement de la restauration de la base de données',
		        '',
		    ]);
        // Ajouter votre code ici

        RestoreDbService::restore();
        self::$stdOutput->success('Restauration de la base de données terminée');

        return Command::SUCCESS;
	}


}
