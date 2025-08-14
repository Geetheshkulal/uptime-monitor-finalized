<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .success-container {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 0 auto;
        }

        .logo-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .logo-header img {
            width: 40px;
            height: 40px;
        }

        .logo-header span {
            font-weight: bold;
            font-size: 18px;
        }

        .success-icon {
            background: #2a6cf4;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px auto;
        }

        .success-icon svg {
            color: white;
            width: 28px;
            height: 28px;
        }

        h2 {
            margin: 10px 0;
            font-size: 1.4rem;
            color: #333;
        }

        p.subheader {
            color: #666;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .receipt {
            background: #f9fbfd;
            border-radius: 8px;
            padding: 15px;
            text-align: left;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .receipt-row:last-child {
            border-bottom: none;
        }

        .receipt-row strong {
            color: #555;
        }

        .email-note {
            background: #eef6ff;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            background-color: #33A1E0;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .redirect-note {
            font-size: 13px;
            color: #777;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 480px) {
            .success-container {
                padding: 15px;
                border-radius: 10px;
            }
            
            .logo-header {
                flex-direction: column;
                gap: 5px;
            }
            
            .logo-header span {
                font-size: 16px;
            }
            
            h2 {
                font-size: 1.3rem;
            }
            
            .receipt-row {
                flex-direction: column;
                gap: 3px;
                padding: 6px 0;
            }
            
            .back-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="logo-header">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="Icon">
            <span>Drishti Pulse</span>
        </div>

        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        
        <h2>Payment Successful!</h2>
        <p class="subheader">Thank you for your subscription</p>

        <div class="receipt">
            <div class="receipt-row">
                <strong>Subscription ID</strong>
                <span>{{ $details['subscription_id'] }}</span>
            </div>
            <div class="receipt-row">
                <strong>Plan Name</strong>
                <span>{{ $details['plan_name'] }}</span>
            </div>
            <div class="receipt-row">
                <strong>Amount Paid</strong>
                <span>₹{{ number_format($details['amount'], 2) }}</span>
            </div>
            <div class="receipt-row">
                <strong>Billing Cycle</strong>
                <span>{{ ucfirst($details['billing_cycle']) }}</span>
            </div>
            <div class="receipt-row">
                <strong>Customer Name</strong>
                <span>{{ $details['customer_name'] }}</span>
            </div>
            <div class="receipt-row">
                <strong>Customer Email</strong>
                <span>{{ $details['customer_email'] }}</span>
            </div>
        </div>

        <div class="email-note">
            A confirmation email has been sent to <strong>{{ $details['customer_email'] }}</strong>
        </div>
        
        <div>
            <a href="{{ route('planSubscription') }}" class="back-button">Back to Dashboard</a>
            <p class="redirect-note">Redirecting in <span id="countdown">8</span> seconds...</p>
        </div>
    </div>

    <script>
        // Countdown timer
        let seconds = 8;
        const countdownEl = document.getElementById('countdown');
        
        const countdown = setInterval(() => {
            seconds--;
            countdownEl.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdown);
                window.location.href = document.querySelector('.back-button').href;
            }
        }, 1000);
    </script>
</body>
</html>