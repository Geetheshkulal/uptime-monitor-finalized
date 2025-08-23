<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrafficLog;
use App\Models\BlockedIP;


class TrafficLogController extends Controller
{
  public function TrafficLogView(Request $request)
{
    $query = TrafficLog::query();

    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->where('ip', 'like', "%{$search}%")
              ->orWhere('browser', 'like', "%{$search}%")
              ->orWhere('platform', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%")
              ->orWhere('url', 'like', "%{$search}%");
        });
    }
    
    if ($request->date_range) {
        [$from, $to] = explode(' to ', $request->date_range);
        $from_date = $from;
        $to_date = $to;
        $query->whereBetween('created_at', [$from, $to]);
    }

    $blocked_ips = BlockedIP::all()->pluck('ip_address')->toArray();

    $trafficLogs = $query->latest()->paginate(10);

    // Preserve all filters in pagination
    $trafficLogs->appends($request->only('search', 'from_date', 'to_date'));

    return view('pages.admin.ViewTrafficLog', compact('trafficLogs', 'blocked_ips'));
}

}
