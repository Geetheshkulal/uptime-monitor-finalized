<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use App\Jobs\WhatsAppLogin;
use App\Models\WhatsappSession;



class AdminWhatsAppController extends Controller
{
    public function AdminWhatsappLogin()
    {
        return view('pages.admin.Whatsapplogin');
    }

    public function fetchQr()
    {
        $userId = auth()->id();
        $session = WhatsappSession::where('user_id', $userId)->latest()->first();

        if ($session) {
            return response()->json([
                'status' => $session->status,
                'qr' => $session->qr_code,
                'userName' => $session->user_name,
                'profilePhotoPath' => $session->profile_photo_path,
            ]);
        }

        return response()->json(['status' => 'disconnected']);
    }

    public function disconnectWhatsApp()
    {
        try {
            $userId = auth()->id();

            $session = WhatsappSession::where('user_id', $userId)->latest()->first();

            if($session && $session->profile_photo_path) {
                // Delete the profile photo if it exists
                $profilePhotoPath = storage_path('app/' . $session->profile_photo_path);
                if (File::exists($profilePhotoPath)) {
                    File::delete($profilePhotoPath);
                }
            }
            
            // Clear session DB values
            WhatsappSession::updateOrCreate(
                ['user_id' => $userId],
                [
                    'status' => 'pending',
                    'qr_code' => null,
                    'user_name' => null,
                    'profile_photo_path' => null,
                    'error_message' => null,
                ]
            );

            // Clean local WhatsApp session data folder
            File::deleteDirectory(storage_path('whatsapp-session'));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('[WHATSAPP DISCONNECT ERROR] ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function triggerLogin()
    {
        $user = auth()->user();
        try {
            
            WhatsAppLogin::dispatch();

            activity()
                ->causedBy($user)
                ->inLog('Whatsapp Login')
                ->event('whatsapp_login')
                ->withProperties([
                    'user_name' => $user->name,
                    'login_time' => now()->toDateTimeString(),
                ])
                ->log("Logged in to WhatsApp.");

            $output = Artisan::output();
            Log::info('[WHATSAPP LOGIN] Artisan command executed: ' . $output);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function retryWhatsApp()
    {
        try {
            $userId = auth()->id();

            File::deleteDirectory(storage_path('whatsapp-session'));

            // Reset DB status to pending
            WhatsappSession::updateOrCreate(
                ['user_id' => $userId],
                ['status' => 'pending']
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('[WHATSAPP RETRY ERROR] ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function serveProfileImage()
    {
        $userId = auth()->id();
        $session = WhatsappSession::where('user_id', $userId)->latest()->first();

        if ($session && $session->profile_photo_path) {
            $path = storage_path('app/' . $session->profile_photo_path);

            if (File::exists($path)) {
                return response()->file($path);
            }
        }

        abort(404);
    }
}



// class AdminWhatsAppController extends Controller
// {
//     public function AdminWhatsappLogin()
//     {
//         return view('pages.admin.Whatsapplogin');
//     }

//     public function fetchQr()
//     {
//         $qrPath = storage_path('app/whatsapp/qr.txt');
//         $statusPath = storage_path('app/whatsapp/status.txt');
//         $userName = storage_path('app/whatsapp/user_name.txt');


//         $qr = File::exists($qrPath) ? File::get($qrPath) : null;
//         $status = File::exists($statusPath) ? trim(File::get($statusPath)) : 'pending';
//         $userName = File::exists($userName) ? trim(File::get($userName)) : 'N/A';

//         return response()->json([
//             'qr' => $qr,
//             'status' => $status,
//             'userName' =>$userName,
//         ]);
//     }

//     public function disconnectWhatsApp()
//     {
//         try {
            
//             File::deleteDirectory(storage_path('whatsapp-session'));
    
//             File::delete(storage_path('app/whatsapp/qr.txt'));
//             File::delete(storage_path('app/whatsapp/user_name.txt'));
//             File::delete(storage_path('app/whatsapp/profile_photo.png'));
//             File::put(storage_path('app/whatsapp/status.txt'), 'pending');

    
//             return response()->json(['success' => true]);
//         } catch (\Exception $e) {
//             Log::error('[WHATSAPP DISCONNECT ERROR] ' . $e->getMessage());
//             return response()->json(['success' => false, 'error' => $e->getMessage()]);
//         }
//     }

//     public function triggerLogin()
//     {
//         $user = auth()->user();
//         try {
   
//                 WhatsAppLogin::dispatch();
                
//                 activity()
//                 ->causedBy(auth()->user())
//                 ->inLog('Whatsapp Login') 
//                 ->event('whatsapp_login')
//                 ->withProperties([
//                     'user_name' => $user->name,
//                     'login_time'=> now()->toDateTimeString(),
//                 ])
//                 ->log("Logged in to whatsapp.");
                
//                 $output = Artisan::output();
//                 Log::info('[WHATSAPP LOGIN] Artisan command executed: ' . $output);
        
//             return response()->json(['success' => true]);
//             } catch (\Exception $e) {
//                 return response()->json(['success' => false, 'message' => $e->getMessage()]);
//         }
// }

// public function retryWhatsApp()
// {
//     try {
        
//         File::deleteDirectory(storage_path('whatsapp-session'));

//         File::put(storage_path('app/whatsapp/status.txt'), 'pending');

//         return response()->json(['success' => true]);
//     } catch (\Exception $e) {
//         Log::error('[WHATSAPP retry ERROR] ' . $e->getMessage());
//         return response()->json(['success' => false, 'error' => $e->getMessage()]);
//     }
// }

//     public function serveProfileImage()
//     {
//         $path = storage_path('app/whatsapp/profile_photo.png');

//         if (File::exists($path)) {
//             return response()->file($path);
//         }

//         abort(404);
//     }
 
// }

