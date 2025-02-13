<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface CsvProcessorInterface
{
    public function process(UploadedFile $file, ?string $message):array;
}