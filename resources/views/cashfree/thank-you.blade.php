


<style>
    /* Main Container */
    .payment-success-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    
    /* Card Styling */
    .payment-success-card {
        width: 100%;
        max-width: 600px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    /* Header Section */
    .payment-header {
        background: linear-gradient(90deg,rgba(9, 9, 121, 0.73) 38%, rgba(0, 43, 255, 0.84) 100%);
        color: white;
        padding: 2.5rem;
        text-align: center;
        position: relative;
    }
    
    .payment-header h1 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 2rem;
    }
    
    .payment-header .subheader {
        opacity: 0.9;
        font-size: 1.1rem;
    }
    
    .success-icon {
        margin-bottom: 1.5rem;
    }
    
    .success-icon svg {
        stroke: white;
        stroke-width: 2.5;
    }
    
    /* Body Section */
    .payment-body {
        padding: 2rem;
    }
    
    .receipt-card {
        background: #f9fbfd;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid #e1e8ed;
    }
    
    .receipt-card h3 {
        color: #4facfe;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.25rem;
    }
    
    /* Details Grid */
    .receipt-details {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding-bottom: 0.75rem;
        border-bottom: 1px dashed #e1e8ed;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #6c757d;
    }
    
    .detail-value {
        font-weight: 500;
        color: #343a40;
    }
    
    /* Confirmation Message */
    .confirmation-message {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #f0f8ff;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
    
    .confirmation-icon {
        font-size: 1.5rem;
        color: #4facfe;
    }
    
    .confirmation-message p {
        margin: 0;
        color: #495057;
    }
    
    /* Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-dashboard {
        background: linear-gradient(90deg,rgba(9, 9, 121, 0.73) 38%, rgba(0, 43, 255, 0.84) 100%);
        color: white;
        border: none;
    }
    
    .btn-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
    }
    
    .btn-home {
        background: white;
        color: #4facfe;
        border: 2px solid #4facfe;
    }
    
    .btn-home:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .payment-header {
            padding: 1.5rem;
        }
        
        .payment-body {
            padding: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    </style>
    
    
    <div class="payment-success-container">
        <div class="payment-success-card">
            <div class="payment-header">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h1>Payment Successful!</h1>
                <p class="subheader">Thank you for your subscription</p>
            </div>
    
            <div class="payment-body">
                <div class="receipt-card">
                    <h3><i class="fas fa-receipt"></i> Order Receipt</h3>
                    
                    <div class="receipt-details">
                        <div class="detail-row">
                            <span class="detail-label">Subscription ID</span>
                            <span class="detail-value">{{ $details['subscription_id'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Plan Name</span>
                            <span class="detail-value">{{ $details['plan_name'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Amount Paid</span>
                            <span class="detail-value">₹{{ number_format($details['amount'], 2) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Billing Cycle</span>
                            <span class="detail-value">{{ ucfirst($details['billing_cycle']) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Customer Name</span>
                            <span class="detail-value">{{ $details['customer_name'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Customer Email</span>
                            <span class="detail-value">{{ $details['customer_email'] }}</span>
                        </div>
                    </div>
                </div>
    
                <div class="confirmation-message">
                    <div class="confirmation-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <p>A confirmation email has been sent to <strong>{{ $details['customer_email'] }}</strong> with your subscription details.</p>
                </div>
    
                <div class="action-buttons">
                    <a href="{{ route('planSubscription') }}" class="btn btn-dashboard">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    