@extends('dashboard')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    :root {
        /* Colors */
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --secondary: #8b5cf6;
        --accent: #ec4899;
        --text-dark: #1f2937;
        --text-light: #4b5563;
        --bg-light: #f8f9fa;
        --white: #ffffff;
        --black: #000000;
        
        /* Shadows */
        --shadow-sm: 0 2px 5px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 5px 15px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.1);
        --shadow-glow: 0 0 20px rgba(99, 102, 241, 0.3);
        
        /* Transitions */
        --transition: all 0.3s ease;
        --transition-slow: all 0.5s ease;
        
        /* Border Radius */
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        
        /* Spacing */
        --spacing-xs: 0.5rem;
        --spacing-sm: 1rem;
        --spacing-md: 1.5rem;
        --spacing-lg: 2rem;
        --spacing-xl: 3rem;
    }

    .upgrade-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: var(--spacing-lg) var(--spacing-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        box-sizing: border-box;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: var(--spacing-lg);
        width: 100%;
    }
    
    .page-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: var(--spacing-sm);
        position: relative;
        display: inline-block;
    }
    
    .page-header h2 .crown-icon {
        position: absolute;
        top: -15px;
        right: -25px;
        color: gold;
        font-size: 1.5rem;
        transform: rotate(15deg);
        animation: pulse 2s infinite;
    }
    
    .page-header p {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: var(--spacing-sm);
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: var(--spacing-lg);
    }

    /* Pricing Toggle */
    .pricing-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--spacing-md);
        margin: var(--spacing-lg) 0;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: var(--transition);
        border-radius: 34px !important;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: var(--transition);
        border-radius: 50% !important;
    }

    input:checked + .slider {
        background: linear-gradient(45deg, var(--primary), var(--secondary));
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .discount {
        background: var(--accent);
        color: var(--white);
        padding: 2px 8px;
        border-radius: 20px !important;
        font-size: 0.8rem;
        margin-left: var(--spacing-xs);
    }

    /* Pricing Cards */
    .pricing-cards {
        display: flex;
        flex-wrap: wrap;
        gap: var(--spacing-lg);
        justify-content: center;
        width: 100%;
        margin-bottom: var(--spacing-xl);
    }

    .card {
        flex: 1 1 300px;
        max-width: 350px;
        min-width: 300px;
        position: relative;
        transition: var(--transition);
        border-radius: var(--radius-lg) !important;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-glow);
    }

    .card-inner {
        width: 100%;
        height: 100%;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .card-front, .card-back {
        width: 100%;
        border-radius: var(--radius-lg) !important;
        background: var(--white);
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
        flex: 1;
    }

    .card-content {
        padding: var(--spacing-lg);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-back {
        display: none;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
    }

    .card-back .card-content {
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .card-back h3 {
        font-size: 2rem;
        margin-bottom: var(--spacing-md);
    }

    .card-back p {
        margin-bottom: var(--spacing-lg);
        opacity: 0.9;
    }

    .popular-badge {
        position: absolute;
        top: -12px;
        right: 20px;
        background: var(--accent);
        color: var(--white);
        padding: 5px 15px;
        border-radius: 20px !important;
        font-size: 0.9rem;
        font-weight: 500;
        z-index: 1;
        box-shadow: var(--shadow-sm);
    }

    .card-header-premium {
        text-align: center;
    }

    .card-header-premium h2 {
        font-size: 2rem;
        margin-bottom: var(--spacing-sm);
    }

    .price {
        font-size: 34px;
        font-weight: 700;
        color: var(--primary);
    }

    .currency {
        font-size: 1.5rem;
        /* vertical-align: super; */
    }

    .period {
        font-size: 1rem;
        color: var(--text-light);
    }

    .features {
        list-style: none;
        margin: var(--spacing-lg) 0;
        flex-grow: 1;
    }

    .features li {
        display: flex;
        align-items: flex-start;
        margin-bottom: var(--spacing-md);
        border-radius: var(--radius-sm);
        transition: var(--transition);
    }

    .features li:hover {
        transform: translateX(5px);
    }

    .feature-content {
        display: flex;
        flex-direction: column;
        margin-left: var(--spacing-sm);
    }

    .feature-title {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .feature-description {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .feature-icon {
        color: var(--primary);
        font-size: 1.2rem;
        margin-top: 2px;
    }

    .features li.featured .feature-icon {
        color: var(--accent);
    }

    .select-plan {
        width: 100%;
        padding: var(--spacing-md);
        border: none;
        border-radius: var(--radius-md) !important;
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        color: var(--white);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-top: auto;
    }

    .select-plan:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
    }

    .toggle-icon {
        font-size: 1.5rem;
        transition: var(--transition);
    }

    .select-plan.basic-price {
        cursor: not-allowed;
        pointer-events: none;
    }

    .dark-mode .card-front {
        background-color: #1a1a27 !important;
    }

    .dark-mode .feature-title {
        color: #e0e0e0;
    }

    .plan_type{
        text-align: center;
    }
    /* Responsive Design */
    @media (max-width: 768px) {
        .upgrade-container {
            padding: var(--spacing-md);
        }

        .title {
            font-size: 2rem;
        }

        .card {
            flex: 1 1 100%;
            max-width: 100%;
            min-width: 0;
        }

        .popular-badge {
            top: 10px;
            right: 10px;
        }

        .card-header-premium .price {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px; /* space between prices */
  }

  .card-header-premium .price del {
    font-size: 20px;
  }

    }
</style>
@endpush

<div class="upgrade-container">
    <!-- Page Header -->
    <div class="page-header">
        <h2>Upgrade to Premium</h2>
        <p>Unlock advanced monitoring features and take full control of your website's uptime.</p>

        <div class="pricing-toggle">
            <span>Monthly</span>
            <label class="switch">
                <input type="checkbox" id="pricing-toggle">
                <span class="slider"></span>
            </label>
            <span>Yearly</span>
        </div>
    </div>
    
    <div class="pricing-cards" id="plans-container">
        <!-- Pro Plan -->
        @foreach($plans as $plan)
            @if($plan->plan_id === 'plan_basic' || $plan->billing_cycle === 'monthly')
                
                <div class="card pricing-card" data-subscription-id="{{ $plan->id }}">
                    <div class="popular-badge">Most Popular</div>
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-content">
                                <div class="card-header-premium">
                                    <h2 class="white-color">{{ $plan->name }}</h2>
                                    <div class="price" data-original="{{ $plan->amount }}" data-id="{{ $plan->id }}">
                                        @if($plan->percentage_discount > 0)
                                            <del>₹{{ round($plan->amount) }}</del>
                                            
                                            <p>
                                                ₹{{ round($plan->sale_price) }}
                                                @if($plan->plan_id !=='plan_basic')
                                                    <span class="currency">/</span>
                                                    <span class="period">mo</span>
                                                @endif
                                            </p>
                                        @else
                                            ₹{{ round($plan->amount) }}
                                        @endif

                                      
                                    </div>
                                </div>
                                 @if($plan->plan_id !=='plan_basic')
                                    <p class="plan_type">Recurring Plan</p>
                                @endif
                                <ul class="features">
                                    @foreach ($plan->features ?? [] as $feature)
                                        <li class="{{ !$feature['available'] ? 'featured' : '' }}">
                                            <span class="feature-icon">
                                                @if ($feature['available'])
                                                    ✓
                                                @else
                                                    ✗
                                                @endif
                                            </span>
                                            <div class="feature-content">
                                                <span class="feature-title">{{ $feature['name']}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @if($plan->plan_id === 'plan_basic')
                                    <button class="select-plan basic-price">Current Plan</button>
                                @else
                                    <form id="paymentForm_{{ $plan->id }}" action="{{ route('store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                        <input type="hidden" name="mobile" value="{{ auth()->user()->phone }}">
                                        <input type="hidden" name="subscription_id" value="{{ $plan->id }}">
                                        <input type="hidden" name="billing_cycle" id="billing_cycle" value="{{ $plan->billing_cycle }}">
                                        <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">
                                        <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                                        <input type="hidden" name="plan_type" value="{{ $plan->plan_type }}">
                                        <input type="hidden" name="plan_currency" value="INR">
                                        <input type="hidden" name="plan_recurring_amount" value="{{ $plan->plan_recurring_amount }}">
                                        <input type="hidden" name="amount" value="{{ $plan->sale_price }}">
                                        <button class="select-plan">Choose Plan</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        
                        @if($plan->plan_id === 'plan_basic')
                            <div class="card-back">
                                <div class="card-content">
                                    <h3>Basic Plan</h3>
                                    <p>Ideal for small businesses and startup projects</p>
                                    <button class="select-plan">Get Started</button>
                                </div>
                            </div>
                        @else
                            <div class="card-back">
                                <div class="card-content">
                                    <h3>Pro Plan</h3>
                                    <p>Professional solutions for growing businesses</p>
                                    <button class="select-plan">Get Started</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include Cashfree SDK -->
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>

<script>
    $(document).on('submit', 'form[id^="paymentForm_"]', function(e) {
    e.preventDefault();

    const form = this;
    const user = @json($user);

    if (!user.address_1 || !user.place || !user.state || !user.pincode || !user.country) {
        toastr.warning('You must fill the billing details in your profile section first');
        setTimeout(() => {
            window.location.href = "{{ route('profile.update') }}?tab=billing";
        }, 2000);
        return;
    }

    const formDataObj = Object.fromEntries(new FormData(form));

    fetch(form.action, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(formDataObj),
    })
    .then(response => response.json())
    .then(data => {
        if (data.subscription_session_id) {
            const cashfree = Cashfree({ mode: "sandbox" });

            cashfree.subscriptionsCheckout({
                subsSessionId: data.subscription_session_id,
                redirectTarget: "_self"
            }).then(function (result) {
                if (result.error) {
                    console.error("Modal Error:", result.error.message);
                    alert("Payment error: " + result.error.message);
                }
            });
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error initiating payment. Please try again.');
    });
});

</script>

<script>
    $(document).ready(function() {
        const plans = @json($plans);

        $('.switch input').change(function(){
            const billing_cycle = this.checked ? 'yearly' : 'monthly';
            $('#plans-container').empty();
            plans.forEach(plan => {
                if((billing_cycle === plan.billing_cycle) || plan.plan_id === 'plan_basic'){
                    let features = plan.features?? [];
                    $('#plans-container').append(`
                        <div class="card pricing-card" data-subscription-id="${plan.id}">
                            <div class="popular-badge">Most Popular</div>
                            <div class="card-inner">
                                <div class="card-front">
                                    <div class="card-content">
                                        <div class="card-header-premium">
                                        <h2 class="white-color">${plan.name}</h2>
                                        <div class="price" data-original="${plan.amount}" data-id="${plan.id}">
                                            ${
                                                plan.percentage_discount > 0
                                                    ? `
                                                        <del>₹${Math.round(plan.amount)}</del>
                                                        <p>
                                                            ₹${Math.round(plan.sale_price)}
                                                            ${plan.plan_id !== 'plan_basic'
                                                                ? `<span class="currency">/</span>
                                                                <span class="period">${billing_cycle === 'yearly' ? 'yr' : 'mo'}</span>`
                                                                : ''
                                                            }
                                                        </p>
                                                    `
                                                    : `₹${Math.round(plan.amount)}`
                                            }
                                        </div>
                                    </div>

                                        <p class="plan_type">
                                           ${plan.plan_id !== 'plan_basic' ? (billing_cycle === 'yearly' ? 'One Time Payment' : 'Recurring Payment') : ''}
                                        </p>
                                        <ul class="features">
                                            ${features.map(feature => `
                                                <li class="${!feature.available ? 'featured' : ''}">
                                                    <span class="feature-icon">
                                                        ${feature.available ? '✓' : '✗'}
                                                    </span>
                                                    <div class="feature-content">
                                                        <span class="feature-title">${feature.name}</span>
                                                    </div>
                                                </li>
                                            `).join('')}
                                        </ul>
                                        ${plan.plan_id === 'plan_basic' ? `
                                            <button class="select-plan basic-price">Current Plan</button>
                                        ` : `
                                            <form id="paymentForm_${plan.id}" action="{{ route('store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                                <input type="hidden" name="mobile" value="{{ auth()->user()->phone }}">
                                                <input type="hidden" name="subscription_id" value="${plan.id}">
                                                <input type="hidden" name="billing_cycle" id="billing_cycle" value="${billing_cycle}">
                                                <input type="hidden" name="plan_id" value="${plan.plan_id}">
                                                <input type="hidden" name="plan_name" value="${plan.name}">
                                                <input type="hidden" name="plan_type" value="${plan.plan_type}">
                                                <input type="hidden" name="plan_currency" value="INR">
                                                <input type="hidden" name="plan_recurring_amount" value="${plan.plan_recurring_amount}">
                                                <input type="hidden" name="amount" value="${plan.sale_price}">
                                                <button class="select-plan">Choose Plan</button>
                                            </form>
                                        `}
                                    </div>
                                </div>
                                ${plan.plan_id === 'plan_basic' ? `
                                    <div class="card-back">
                                        <div class="card-content">
                                            <h3>Basic Plan</h3>
                                            <p>Ideal for small businesses and startup projects</p>
                                            <button class="select-plan">Get Started</button>
                                        </div>
                                    </div>
                                ` : `
                                    <div class="card-back">
                                        <div class="card-content">
                                            <h3>Pro Plan</h3>
                                            <p>Professional solutions for growing businesses</p>
                                            <button class="select-plan">Get Started</button>
                                        </div>
                                    </div>
                                `}
                            </div>
                        </div>
                    `);
                }
            });
        })
    });
</script>
@endpush

@endsection