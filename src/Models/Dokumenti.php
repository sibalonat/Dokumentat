<?php

namespace Keysoft\Dokumentat\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumenti extends Model
{
    // i was using Spatie/MediaLibrary so some of the methods for the file saving will be handled by this package
    // use InteractsWithMedia;
    public $guarded = [];

    public function getUppercasedName()
    {
        return strtoupper($this->name);
    }

    /// here you can change the names of the collections and also can add more than one file per model
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('document')
            ->singleFile();
        $this->addMediaCollection('converted')
            ->singleFile();
    }
}
