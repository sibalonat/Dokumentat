<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertedDocument;
use App\Models\Dokumenti;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DokumentiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function generatePdf(Dokumenti $dokumenti)
    {
        $media = $dokumenti->getFirstMediaUrl('document');

        $string = Str::ulid();

        $jsonConverter = [
            'async' => true,
            'filetype' => 'docxf',
            'key' => (string) $string,
            'outputtype' => 'pdf',
            'url' => $media,
        ];

        $converter = env('ONLYOFFICE_CONVERTER');
        Http::acceptJson()
            ->retry(3, 100)
            ->timeout(120)
            ->post($converter, $jsonConverter)->json();

        ConvertedDocument::dispatch(
            $string,
            $media,
            $dokumenti,
        )->delay(now()->addSeconds(10));
    }
}
