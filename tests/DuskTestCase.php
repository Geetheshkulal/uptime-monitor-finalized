<?php


namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    #[BeforeClass]
    public static function prepare(): void
    {
        if (! static::runningInSail()) {
            static::startChromeDriver(['--port=9515']);
        }
    }

    protected function driver(): RemoteWebDriver
    {
        $userDataDir = base_path('storage/whatsapp-session');

        $options = (new ChromeOptions)
            ->setBinary(env('CHROMIUM_BINARY'))
            ->addArguments([
                '--headless=new',
                '--disable-gpu',
                '--window-size=1920,1080',
                '--no-sandbox',
                '--disable-dev-shm-usage',
                '--user-data-dir=' . $userDataDir,
                '--use-gl=angle',
                '--enable-webgl',
                '--use-angle=swiftshader',
                '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            ]);

        return RemoteWebDriver::create(
            env('DUSK_DRIVER_URL', 'http://localhost:9515'),
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }

    protected function tearDown(): void
    {
        // Do not close the browser
        // parent::tearDown(); ← COMMENT or REMOVE this
    }
}





// namespace Tests;

// use Facebook\WebDriver\Chrome\ChromeOptions;
// use Facebook\WebDriver\Remote\DesiredCapabilities;
// use Facebook\WebDriver\Remote\RemoteWebDriver;
// use Illuminate\Support\Collection;
// use Laravel\Dusk\TestCase as BaseTestCase;
// use PHPUnit\Framework\Attributes\BeforeClass;

// abstract class DuskTestCase extends BaseTestCase
// {
//     use CreatesApplication;

//     /**
//      * Prepare for Dusk test execution.
//      */
//     #[BeforeClass]
//     public static function prepare(): void
//     {
//         if (! static::runningInSail()) {
//             static::startChromeDriver(['--port=9515']);
//         }
//     }

//     protected function baseUrl(): string
//     {
//         return env('APP_URL', 'http://localhost:8000');
//     }

  
//     protected function driver(): RemoteWebDriver
//     {
//         $userDataDir = base_path('storage/whatsapp-session');

//         $options = (new ChromeOptions)->addArguments(collect([
//             $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
//                 '--no-sandbox',
//                 '--disable-dev-shm-usage',
//                 '--window-size=1920,1080',
//                 '--user-data-dir=' . $userDataDir,
//                 // 'user-data-dir=' . storage_path('whatsapp-session'),
//         ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
//             return $items->merge([
//                 '--disable-gpu',
//             //    '--headless=new',
//             ]);
//         })->all());

//         return RemoteWebDriver::create(
//             $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL') ?? 'http://localhost:9515',
//             DesiredCapabilities::chrome()->setCapability(
//                 ChromeOptions::CAPABILITY, $options
//             )
//         );
//     }
// }
