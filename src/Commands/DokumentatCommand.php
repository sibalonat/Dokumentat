<?php

namespace Keysoft\Dokumentat\Commands;

use Illuminate\Console\Command;

class DokumentatCommand extends Command
{
    public $signature = 'dokumentat';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
