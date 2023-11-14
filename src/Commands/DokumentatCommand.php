<?php

namespace Keysoft\Dokumentat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;


        // "post-autoload-dump": [
        //     // "@composer run prepare",

        // ],
class DokumentatCommand extends Command
{
    public $signature = 'dokumentat';

    public $description = 'My command';

    public function handle(): int
    {
        // $text = config('dokumentat.command_output');

        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        $this->comment(app_path('Http/Controllers'));
        $this->comment(resource_path('js'));

        (new Filesystem)->copy(
            __DIR__.'/../Controllers/DokumentiController.php', app_path('Http/Controllers/DokumentiController.php')
        );
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));
        (new Filesystem)->copy(
            __DIR__.'/../Models/Dokumenti.php', app_path('Models/Dokumenti.php')
        );
        (new Filesystem)->ensureDirectoryExists(app_path('Jobs'));
        (new Filesystem)->copy(
            __DIR__.'/../Jobs/ConvertedDocument.php', app_path('Jobs/ConvertedDocument.php')
        );
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Pages'));
        (new Filesystem)->copy(
            __DIR__.'/../Pages/Dokumenti.vue', resource_path('js/Pages/Dokumenti.vue')
        );
        (new Filesystem)->ensureDirectoryExists(base_path('routes'));
        // (new Filesystem)->copy(
        //     __DIR__.'/../Pages/Dokumenti.vue', resource_path('js/Pages/Dokumenti.vue')
        // );

        $route = __DIR__.'/../routes/web.php';
        $this->comment($route);
        $content = file_get_contents($route);
        $this->comment($content);
        $approute = base_path('routes');

        // file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

        $this->updateNodePackages(function ($packages) {
            return [
                '@onlyoffice/document-editor-vue' => '^1.3.0',
            ] + $packages;
        });

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }

        return self::SUCCESS;
    }

    /**
     * Update the "package.json" file.
     *
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
