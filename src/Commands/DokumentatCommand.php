<?php

namespace Keysoft\Dokumentat\Commands;

use Illuminate\Console\Command;

class DokumentatCommand extends Command
{
    public $signature = 'dokumentat';

    public $description = 'My command';

    public function handle(): int
    {
        $text = config('dokumentat.command_output');

        $this->comment($text);

        return self::SUCCESS;
    }
}
