<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function DisplayMaintenance(Request $request){

        return view('maintenance.DisplayMaintenance');
    }
}
