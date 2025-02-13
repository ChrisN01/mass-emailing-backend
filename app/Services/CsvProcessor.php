<?php

namespace App\Services;

use App\Exceptions\CsvDelimiterException;
use App\Exceptions\CsvFormatException;
use App\Exceptions\CsvOpenException;
use App\Services\Contracts\CsvProcessorInterface;
use App\Validators\Contracts\CsvValidatorInterface;
use Exception;
use Illuminate\Http\UploadedFile;

class CsvProcessor implements CsvProcessorInterface
{
    protected $validator;

    public function __construct(CsvValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function process(UploadedFile $file, ?string $message): array
    {
        $handle = fopen($file->getPathname(), "r");

        if ($handle === false) {
            throw new CsvOpenException();
        }

        $headers = fgetcsv($handle);

        if ($headers === false) {
            throw new CsvFormatException();
        }

        if (strpos(implode(',', $headers), ";")) {
            throw new CsvDelimiterException();
        }

        if(!$this->validator->validatesFileHasSameColumns($headers))
        {
            throw new Exception("CSV headers do not match the expected columns.");
        }

        $csvData = [];
        $rowsNotProcessed = [];

        while (($row = fgetcsv($handle)) !== FALSE) {
            if (count($row) !== count($headers) || array_filter($row) !== $row) {
                $rowsNotProcessed[] = $row;
                continue;
            }

            $row = array_combine($headers, $row);
            if ($row === FALSE) {
                continue;
            }

            $csvData[] = $row;
        }

        fclose($handle);
       // echo "Row not processed: " . json_encode($rowsNotProcessed) . "\n";
       // echo "Row has correct number of columns and values: " . json_encode($csvData) . "\n";

       return $csvData;
    }
}
