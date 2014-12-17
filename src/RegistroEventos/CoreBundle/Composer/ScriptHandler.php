<?php

namespace RegistroEventos\CoreBundle\Composer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;
use Composer\Script\CommandEvent;

class ScriptHandler
{
    public static function crearAdminInicial(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];
        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir (' . $appDir
            . ') specified in composer.json was not found in '
            . getcwd() . ', can not clear the cache.' . PHP_EOL;
            return;
        }
            static::executeCommand($event, $appDir, 'registro_eventos_core:crear:admin_inicial', $options['process-timeout']);
    }

    public static function prepararBaseDeDatos(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];
        if (!is_dir($appDir)) {
            echo 'The symfony-app-dir (' . $appDir
            . ') specified in composer.json was not found in '
            . getcwd() . ', can not clear the cache.' . PHP_EOL;
            return;
        }
            static::executeCommand($event, $appDir, 'doctrine:schema:drop --force', $options['process-timeout']);
            static::executeCommand($event, $appDir, 'doctrine:schema:update --force', $options['process-timeout']);
    }
    
    protected static function executeCommand(CommandEvent $event, $appDir, $cmd, $timeout = 300)
    {
        $php = escapeshellarg(self::getPhp());
        $console = escapeshellarg($appDir . '/console');
        if ($event->getIO()->isDecorated()) {
            $console .= ' --ansi';
        }
        $process = new Process($php . ' ' . $console . ' ' . $cmd, null, null, null, $timeout);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
        if (!$process->isSuccessful()) {
            throw new \RuntimeException(
            sprintf(
                    'Ocurrio un error mientras se ejecutaba el comando "%s".', escapeshellarg($cmd)));
        }
    }

    protected static function getOptions(CommandEvent $event)
    {
        $options = array_merge(
                array('symfony-app-dir' => 'app', 'symfony-web-dir' => 'web',
            'symfony-assets-install' => 'hard'), $event->getComposer()->getPackage()->getExtra());
        $options['process-timeout'] = $event->getComposer()->getConfig()
                ->get('process-timeout');
        return $options;
    }

    protected static function getPhp()
    {
        $phpFinder = new PhpExecutableFinder;
        if (!$phpPath = $phpFinder->find()) {
            throw new \RuntimeException(
            'No se encontro el ejecutable de PHP');
        }
        return $phpPath;
    }

}





