<?php 

require __DIR__ . '/../vendor/autoload.php';

use \MyProject\Exceptions\CliException;
use \MyProject\Cli\AbstractCommand;

try {
	unset($argv[0]);
	
	$className = '\\MyProject\\Cli\\' . array_shift($argv);
	if (!class_exists($className)) {
		throw new CliException('Class: ' .$className. ' not found.');
	}

	$params = [];
	foreach ($argv as $argument) {
		preg_match('/^-(.+)=(.+)$/', $argument, $matches);
		if (!empty($matches)) {
			$paramName = $matches[1];
			$paramValue = $matches[2];

			$params[$paramName] = $paramValue;
		}
	}

    $classReflection = new ReflectionClass($className);
    if (!$classReflection->isSubclassOf(AbstractCommand::class)) {
        throw new CliException('Class: ' . $classReflection . ' not a subclass of AbstractCommand!');
    }

	$class = new $className($params);
	$class->execute();
} catch (CliException $e) {
	echo 'Error: ' .$e->getMessage();
}