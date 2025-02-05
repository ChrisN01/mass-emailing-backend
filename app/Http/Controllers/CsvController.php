<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCsvRequest;
use App\Services\Contracts\CsvProcessorInterface;
use Exception;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    protected $csvProcessor;

    public function __construct(CsvProcessorInterface $csvProcessor)
    {
        $this->csvProcessor=$csvProcessor;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     //TODO: Validar que solo se admita un archivo
    public function store(StoreCsvRequest  $request)
    {
        $file = $request->file('file');
        $message= $request->input('message');

        $data = $this->csvProcessor->process($file, $message);

        return response()->json(['message' => 'CSV procesado correctamente', 'data' => $data], 200);   
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
