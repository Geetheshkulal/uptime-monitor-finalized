<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class WhatsAppLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public  $tries = 1; 
    // public $timeout = 200; 
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            
            Log::info('[WHATSAPP LOGIN] Starting WhatsAppLoginTest via shell script.');

            // Path to the shell script
            $scriptPath = base_path('scripts/run-dusk.sh');
            // Log::info('[WHATSAPP LOGIN] Running: bash ' . $scriptPath);

            // Run the shell script using bash
            $bashPath = env('BASH_PATH');
            $phpPath = env('PHP_BIN_PATH');
            // Log::info('[WHATSAPP LOGIN] Using BASH_PATH: ' . $bashPath);
            // $process = new Process(['bash', $scriptPath, $phpPath]);
            $process = new Process([$bashPath, $scriptPath, $phpPath]);
            $process->setTimeout(300);
            $process->run(); 

            // Log::info('[WHATSAPP LOGIN] Exit Code: ' . $process->getExitCode());
            // Log::info('[WHATSAPP LOGIN] STDOUT: ' . $process->getOutput());

            if (!$process->isSuccessful()) {
                // Log::error('[WHATSAPP LOGIN] STDERR: ' . $process->getErrorOutput());
                // Log::error('[WHATSAPP LOGIN] Process failed.');
            } else {
                // Log::info('[WHATSAPP LOGIN] WhatsAppLoginTest completed successfully.');
            }
        } catch (\Exception $e) {
            // Log::error('[WHATSAPP LOGIN] Exception: ' . $e->getMessage());
        }
    }
}
