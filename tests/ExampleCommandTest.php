<?php

use Keysoft\Dokumentat\Commands\DokumentatCommand;

use function Pest\Laravel\artisan;

it('can output configured value', function () {
    // expect(true)->toBeTrue();
    artisan(DokumentatCommand::class)
        ->expectsOutput(config('dokumentat.command_output'))
        ->assertExitCode(0);
});
