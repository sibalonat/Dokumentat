<?php

// config for Keysoft/Dokumentat
return [
    /*
    / here you can make a shortcut for the connection to onlyoffice api for converting a document
    / an example of this would be to use the env variables: for the domain and then concatinate it to the conversion
    / ONLYOFFICE_DOCUMENT_SERVER_URL=http://192.168.0.3:8001 this is not restricted to an api,
    / but for development you would use Docker
    / and then in the this configuration 'convert':  config('dokumentat.developer')/ConvertService.ashx
    */
    'developer' => '',
    'convert' => config('dokumentat.developer').'/ConvertService.ashx',
];
