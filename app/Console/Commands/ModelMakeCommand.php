<?php
namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;

class ModelMakeCommand extends Command
{
	protected function getDefaultNamespace($rootNamespace)
	{
		return "{$rootNamespace}\Models";
	}
}
