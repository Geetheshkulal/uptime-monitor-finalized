<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DRISHTI PULSE')</title>
</head>


<style>
    :root {
        --primary-color:  #52C41A;
        --primary-light-color:  #c6fcab;
        /* --secondary-color:  #f9f9f9; */
        --secondary-color: #0ABFBC;
        --text-color: #000000;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
    }
</style>

<body style="font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f5f7fa; margin: 0; padding: 0; color: #333333; -webkit-font-smoothing: antialiased;">

    {{-- Tracking Pixel (if needed globally) --}}
    @yield('tracking')

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">

                    {{-- HEADER --}}
                    <tr>
                        {{-- <td style="text-align: center; background: #3490dc; padding: 30px 20px; border-radius: 12px 12px 0 0;"> --}}
                            <td style="text-align: center; background: #1e1e2f; padding: 30px 20px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    <a class="d-flex align-items-center" href="{{ config('app.url') }}">
                                                    <img src="{{ asset('frontend/assets/logo/Drishti Pulse-25.png') }}"  alt="Logo" style="height: 70px; display: inline-block;">
                                                    </a>
                                                </td>
                                                {{-- <td style="vertical-align: middle; padding-left: 10px;">
                                                    <span style="color: white; font-size: 24px; font-weight: 600; display: inline-block;">Drishti Pulse</span>
                                                </td> --}}
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h1 style="color: white; margin: 0 0 0 0; font-size: 28px; font-weight: 600;">
                                            @yield('header_title')
                                        </h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- CONTENT --}}
                    <tr>
                        <td style="padding: 40px 30px; font-size: 16px; line-height: 1.6;">
                            @yield('content')
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td colspan="3" style="text-align: center; padding-bottom: 20px;">
                                        <h3 style="margin: 0; color: #333; font-size: 18px;">
                                            What You Can Do With DRISHTI PULSE
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" width="33%" style="padding: 10px;">
                                        <div style="font-size: 24px; margin-bottom: 10px;">🔍</div>
                                        <div style="font-weight: 600; margin-bottom: 5px;">Monitor</div>
                                        <div style="font-size: 14px; color: #666;">Track website uptime 24/7</div>
                                    </td>
                                    <td align="center" width="33%" style="padding: 10px;">
                                        <div style="font-size: 24px; margin-bottom: 10px;">📊</div>
                                        <div style="font-weight: 600; margin-bottom: 5px;">Analyze</div>
                                        <div style="font-size: 14px; color: #666;">Get performance insights</div>
                                    </td>
                                    <td align="center" width="33%" style="padding: 10px;">
                                        <div style="font-size: 24px; margin-bottom: 10px;">⚡</div>
                                        <div style="font-weight: 600; margin-bottom: 5px;">Alert</div>
                                        <div style="font-size: 14px; color: #666;">Instant notifications when down</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px; text-align: center; border-radius: 0 0 12px 12px;">
                            <table cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <a class="d-flex align-items-center" href="{{ config('app.url') }}">
                                        <img src="{{ asset('frontend/assets/logo/Drishti Pulse-14.png') }}" alt="Logo" style="height: 65px; display: inline-block;">
                                        </a>
                                    </td>
                                    {{-- <td style="vertical-align: middle; padding-left: 8px;">
                                        <span style="color: #333; font-size: 18px; font-weight: 600; display: inline-block;">DRISHTI PULSE</span>
                                    </td> --}}
                                </tr>
                            </table>
                            
                            <p style="font-size: 14px; color: #666; margin: 10px 0 15px 0;">
                                Need help? Contact us at <a href="mailto:info@ditsolutions.net" style="color: #0066cc; text-decoration: none;">info@ditsolutions.net</a>
                            </p>

                            <p style="font-size: 13px; color: #999; margin: 0;">
                                &copy; 2025 DRISHTI PULSE. All rights reserved.
                            </p>

                            <p style="font-size: 12px; color: #999; margin-top: 15px;">
                                This email was sent to you because you signed up for a Drishti Pulse account.<br>
                                <a href="{{route('privacy')}}" style="color: #0066cc; text-decoration: none;">Privacy Policy</a> | 
                                <a href="{{route('terms')}}" style="color: #0066cc; text-decoration: none;">Terms of Service</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
