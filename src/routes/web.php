Route::post('document/{dokumenti}', [
    DokumentiController::class, 'onlydocument'
])->name('only.document');

Route::get('document/{dokumenti}', [
    DokumentiController::class, 'show'
])->name('document.show');

Route::get('document-pdf/{dokumenti}', [
    DokumentiController::class, 'generatePdf'
])->name('document.pdf');
