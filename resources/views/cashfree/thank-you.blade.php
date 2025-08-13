<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom, #2a6cf4, #6ea8fe);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .success-container {
        background: white;
        border-radius: 12px;
        max-width: 400px;
        width: 100%;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .success-icon {
        background: #2a6cf4;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 15px auto;
    }

    .success-icon svg {
        color: white;
        width: 32px;
        height: 32px;
    }

    h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #333;
    }

    p {
        color: #666;
        margin-bottom: 20px;
    }

    .receipt {
        background: #f9fbfd;
        border-radius: 8px;
        padding: 15px;
        text-align: left;
        font-size: 14px;
    }

    .receipt div {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }

    .receipt div:last-child {
        border-bottom: none;
    }

    .email-note {
        background: #eef6ff;
        padding: 10px;
        border-radius: 8px;
        margin-top: 15px;
        font-size: 13px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="success-container">
  <div style="display: flex; align-items: center; gap: 10px;">
<!--     <img src="{{ asset('images/company-logo.png') }}" 
         alt="Company Logo" 
         style="width: 40px; height: 40px; object-fit: contain;"> -->
     <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="Icon" width="50" height="50">
    <span style="font-weight: bold; font-size: 18px;">Drishti Pulse</span>
</div>

    <div class="success-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <h2>Payment Successful!</h2>
    <p>Thank you for your subscription</p>

    <div class="receipt">
        <div><strong>Subscription ID</strong> <span>{{ $details['subscription_id'] }}</span></div>
        <div><strong>Plan Name</strong> <span>{{ $details['plan_name'] }}</span></div>
        <div><strong>Amount Paid</strong> <span>₹{{ number_format($details['amount'], 2) }}</span></div>
        <div><strong>Billing Cycle</strong> <span>{{ ucfirst($details['billing_cycle']) }}</span></div>
        <div><strong>Customer Name</strong> <span>{{ $details['customer_name'] }}</span></div>
        <div><strong>Customer Email</strong> <span>{{ $details['customer_email'] }}</span></div>
    </div>

    <div class="email-note">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20">
        </svg>
        A confirmation email has been sent to <strong>{{ $details['customer_email'] }}</strong>
    </div>
  
  <div style="text-align: center; margin-top: 30px;">
    <a href="{{ route('planSubscription') }}" 
       style="display: inline-block; background-color: #33A1E0; color: white; padding: 10px 20px; 
              text-decoration: none; border-radius: 5px; font-weight: bold;">
         Back to Dashboard
    </a>
</div>

</div>
