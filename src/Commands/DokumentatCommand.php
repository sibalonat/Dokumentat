<?php

namespace Keysoft\Dokumentat\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

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

        // resource_path
        // return 0;

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
        // (new Filesystem)->ensureDirectoryExists(app_path('Jobs'));
        // (new Filesystem)->copy(__DIR__.'../Jobs/ConvertedDocument.php', app_path('Jobs/ConvertedDocument.php'));
        // (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/inertia-vue/resources/js/Pages', resource_path('js/Pages'));

        $this->updateNodePackages(function ($packages) {
            return [
                'vue' => '^3.2.41',
                '@onlyoffice/document-editor-vue' => '^1.3.0',
            ] + $packages;
        });

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
}
