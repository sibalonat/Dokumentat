<?php

namespace Keysoft\Dokumentat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

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
        $ctrl = __DIR__.'/../Controllers/WriteInController.stub';
        $appCtrlFile = app_path('Http/Controllers/DokumentiController.php');
        $contentCtrl = file_get_contents($ctrl);

        // Append the content to 'DokumentiController.php'
        file_put_contents($appCtrlFile, $contentCtrl.PHP_EOL, FILE_APPEND | LOCK_EX);

        (new Filesystem)->ensureDirectoryExists(app_path('Models'));
        (new Filesystem)->copy(
            __DIR__.'/../Models/Dokumenti.php', app_path('Models/Dokumenti.php')
        );

        $model = __DIR__.'/../Models/WriteInModel.stub';
        $appModelFile = app_path('Models/Dokumenti.php');
        $contentModel = file_get_contents($model);

        // Append the content to 'Dokumenti.php'
        file_put_contents($appModelFile, $contentModel.PHP_EOL, FILE_APPEND | LOCK_EX);

        (new Filesystem)->ensureDirectoryExists(app_path('Jobs'));
        (new Filesystem)->copy(
            __DIR__.'/../Jobs/ConvertedDocument.php', app_path('Jobs/ConvertedDocument.php')
        );

        $job = __DIR__.'/../Jobs/WriteInJob.stub';
        $appJobFile = app_path('Jobs/ConvertedDocument.php');
        $contentJob = file_get_contents($job);

        // Append the content to 'ConvertedDocument.php'
        file_put_contents($appJobFile, $contentJob.PHP_EOL, FILE_APPEND | LOCK_EX);

        (new Filesystem)->ensureDirectoryExists(resource_path('js/Pages'));
        (new Filesystem)->copy(
            __DIR__.'/../Pages/Dokumenti.vue', resource_path('js/Pages/Dokumenti.vue')
        );
        (new Filesystem)->ensureDirectoryExists(base_path('routes'));

        $route = __DIR__.'/../routes/WriteInWeb.stub';
        $content = file_get_contents($route);

        // Specify the full path to the 'web.php' file in the application's 'routes' directory
        $appRouteFile = base_path('routes/web.php');

        // Append the content to 'web.php'
        file_put_contents($appRouteFile, $content.PHP_EOL, FILE_APPEND | LOCK_EX);

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
