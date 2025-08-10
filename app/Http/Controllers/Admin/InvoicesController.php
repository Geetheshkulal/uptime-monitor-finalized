<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class InvoicesController extends Controller
{
    public function DisplayUserInvoices()
    {
        $invoices = Invoice::with('user')->latest()->get();
    
        return view('pages.admin.DisplayUserInvoices',compact('invoices'));
    }
   
}