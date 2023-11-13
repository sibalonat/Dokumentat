<?php

namespace Keysoft\Dokumentat\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ConvertedDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $string, protected $media, protected $dokumenti)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $converter = config('ONLYOFFICE_CONVERTER');

        $jsonConverter = [
            'async' => false,
            'filetype' => 'docxf',
            'key' => (string) $this->string,
            'outputtype' => 'pdf',
            'url' => $this->media,
        ];

        $response = Http::acceptJson()
            ->retry(3, 100)
            ->timeout(120)
            ->post($converter, $jsonConverter)->json();

        $name = str($this->dokumenti->title)
            ->append('.pdf');

        if ($response['fileUrl']) {
            $url = $response['fileUrl'];
            $this->dokumenti->addMediaFromUrl($url)
                ->usingFileName((string) $name)
                ->toMediaCollection('converted');
        }
    }
}
