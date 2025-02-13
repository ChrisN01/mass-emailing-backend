<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCsvRequest;
use App\Services\ClientService;
use App\Services\Contracts\CsvProcessorInterface;
use App\Services\SendEmailService;
use Exception;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    protected $csvProcessor;
    protected $clientService;
    protected $sendEmailService;

    public function __construct(CsvProcessorInterface $csvProcessor, ClientService $clientService, SendEmailService $sendEmailService)
    {
        $this->csvProcessor=$csvProcessor;
        $this->clientService=$clientService;
        $this->sendEmailService=$sendEmailService;
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
    public function store(StoreCsvRequest  $request)
    {
        $file = $request->file('file');
        $message= $request->input('message');
        $data = [];
        $sendEmails = [];
        $data = $this->csvProcessor->process($file);
        $sendEmails = $this->clientService->getSendEmails($data);

        $this->sendEmailService->sendEmail($sendEmails, $message);

        //Se envian los correos

        //TODO: return clients that were not processed

        return response()->json(['message' => 'CSV procesado correctamente', 'data' => $sendEmails], 200);   
       
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
