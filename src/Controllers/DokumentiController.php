<?php

namespace Keysoft\Dokumentat\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Jobs\ConvertedDocument;
use App\Models\ProjectDocument;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Keysoft\Dokumentat\Models\Dokumenti;

class DokumentiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function generatePdf(Dokumenti $projectDocument)
    {
        $media = $projectDocument->getFirstMediaUrl('document');

        $mediacollection = $projectDocument->getFirstMedia('document');

        if ($projectDocument->status === 'Chiuso') {
            $projectDocument->structurefolders()->detach();
        }

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
            $projectDocument,
            $mediacollection,
            $project
        )->delay(now()->addSeconds(10));
    }

}
