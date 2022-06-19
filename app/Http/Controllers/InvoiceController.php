<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function show($id)
    {
        // Demo only - always "shows" the invoice with the file:
        // storage/app/doc00001.jpeg
        $path = storage_path('app/invoices/doc00001.jpeg');
        return response()->file($path);
    }
}
