@extends('dashboard')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


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
        margin: -3rem auto;
        padding: 2rem 1rem;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 1rem;
        position: relative;
    }
    
    .page-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 1rem;
        display: inline-block;
        position: relative;
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
    .coupon-section {
        text-align: right;
        margin-bottom: 2rem;
        margin-top: 1rem;

    }
    
    .coupon-btn {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
        font-weight: 600;
    }
    
    .coupon-btn:hover {
        background: var(--primary);
        color: white;
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
    margin-bottom: var(--spacing-xl);
    margin-top:  var(--spacing-lg);
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
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-xl);
    /* border-bottom: 1px solid rgba(0, 0, 0, 0.1); */
    margin-left: 100px;
}

.card {
    position: relative;
    transition: var(--transition);
    width: 75%;
    border-radius: 15px !important;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-glow);
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: var(--transition);
}

.card-front, .card-back {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: var(--radius-lg) !important;
    background: var(--white);
    box-shadow: var(--shadow-lg);
    transition: var(--transition);
}

.card-content {
    height: 100%;
    padding: var(--spacing-lg);
    display: flex;
    flex-direction: column;
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
    /* margin-bottom: var(--spacing-lg); */
}

.card-header-premium h2 {
    font-size: 2rem;
    margin-bottom: var(--spacing-sm);
}

.applied-coupon-msg {
        background: rgba(40, 167, 69, 0.1);
        border: 1px dashed var(--success);
        padding: 0.75rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        text-align: center;
        font-weight: 600;
        color: var(--success);
        font-size: small;
        box-sizing: content-box;
    }
    
.price {
    font-size: 34px;
    font-weight: 700;
    color: var(--primary);
}

.currency {
    font-size: 1.5rem;
    vertical-align: super;
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
    /* padding: var(--spacing-sm); */
    border-radius: var(--radius-sm);
    transition: var(--transition);
}

.features li:hover {
    /* background: rgba(99, 102, 241, 0.05); */
    transform: translateX(5px);
}

/* .features li.featured {
    background: rgba(99, 102, 241, 0.1);
    border-left: 3px solid var(--primary);
} */

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


.dark-mode .card-front{
    background-color: #1a1a27 !important;
    
}
.dark-mode .feature-title{
    color: #e0e0e0;
}
/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: var(--spacing-md);
    }

    .title {
        font-size: 2rem;
    }

    .pricing-cards {
        grid-template-columns: 1fr;
        margin-left: 0;
    }

    .card {
        min-height: auto;
        width: auto;
    }

    .popular-badge {
        top: 10px;
        right: 10px;
    }
} 
    </style>
@endpush

<div class="upgrade-container">
    <!-- Coupon Section -->
    <div class="coupon-section">
        <button id="couponActionBtn" class="btn coupon-btn" 
                data-bs-toggle="modal" data-bs-target="#applyCouponModal"
                data-action="apply">
            @if(session('applied_coupon'))
                <i class="fas fa-tag me-2"></i>Remove Coupon
            @else
                <i class="fas fa-tag me-2"></i>Apply Coupon
            @endif

        </button>
    </div>
    
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
            <span>Yearly 
                {{-- @if($jspricingData->contains('yearly_discount', '!=', null))
                    <span class="discount">Save up to {{ $jspricingData->max('yearly_discount') }}%</span>
                @endif --}}
            </span>
        </div>
    </div>
    
    
    <div class="pricing-cards">
        <!-- Basic Plan -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <div class="card-content">
                        <div class="card-header-premium">
                            <h2 class="white-color">Basic</h2>
                            <div class="price basic-price">₹0<span class="currency">/</span><span class="period">mo</span></div>
                        </div>
                        <ul class="features">
                            <li>
                                <span class="feature-icon">✓</span>
                                <div class="feature-content">
                                    <span class="feature-title">Monitor 5 websites</span>
                                </div>
                            </li>
                            <li>
                                <span class="feature-icon">✓</span>
                                <div class="feature-content">
                                    <span class="feature-title">5-minute check</span>
                                </div>
                            </li>
                            <li>
                                <span class="feature-icon">✓</span>
                                <div class="feature-content">
                                    <span class="feature-title">Email alerts</span>
                                </div>
                            </li>
                            <li>
                                <span class="feature-icon">✓</span>
                                <div class="feature-content">
                                    <span class="feature-title ">1-Month history</span>
                                </div>
                            </li>
                            <li class="featured">
                                <span class="feature-icon">x</span>
                                <div class="feature-content">
                                    <span class="feature-title ">Telegram bot alert unavailable</span>
                                </div>
                            </li>
                            <li class="featured">
                                <span class="feature-icon">x</span>
                                <div class="feature-content">
                                    <span class="feature-title ">SSL expiry check unavailable</span>
                                </div>
                            </li>
                            <li  class="featured">
                                <span class="feature-icon">x</span>
                                <div class="feature-content">
                                    <span class="feature-title ">Create and manage team members unavailable</span>
                                </div>
                            </li>
                        </ul>
                        <button class="select-plan basic-price">Current Plan</button>
                    </div>
                </div>
                <div class="card-back">
                    <div class="card-content">
                        <h3>Basic Plan</h3>
                        <p>Ideal for small businesses and startup projects</p>
                        <button class="select-plan">Get Started</button>
                    </div>
                </div>
            </div>
        </div>

        @php
        $appliedCoupon = session('applied_coupon');
        @endphp

        <!-- Pro Plan -->
        @foreach($plans as $plan)
        <div class="card pricing-card" data-subscription-id="{{ $plan->id }}">
            <div class="popular-badge">Most Popular</div>
            <div class="card-inner">
                <div class="card-front">
                    <div class="card-content">
                        <div class="card-header-premium">
                            <h2 class="white-color">{{ $plan->name }}</h2>
                            {{-- Discount badge placeholder --}}
                            <div class="discount-badge" data-id="{{ $plan->id }}"></div>

                            <div class="price" data-original="{{ $plan->amount }}" data-id="{{ $plan->id }}">
                                
                            @php
                                $originalPrice = $plan->amount;
                                $discount = ($appliedCoupon && $appliedCoupon['subscription'] == $plan->id) 
                                            ? $appliedCoupon['discount'] 
                                            : 0;
                                $finalPrice =($appliedCoupon && $appliedCoupon['discount_type']==='flat')? round(max(0, $originalPrice - $discount)):round(max(0, $originalPrice - (($originalPrice*$discount)/100)));

                            @endphp
                    
                    @if($discount > 0)
                        {{-- <del>₹{{ number_format($originalPrice, 2) }}</del> --}}
                        <del>₹{{ round($originalPrice) }}</del>
                        ₹{{ round($finalPrice) }}
                    @else
                        ₹{{ round($originalPrice) }}
                    @endif
                        <span class="currency">/</span><span class="period">mo</span></div>
                        </div>

                        @if($appliedCoupon && $appliedCoupon['subscription'] == $plan->id)
                        <div class="applied-coupon-msg">
                            <i class="fas fa-check-circle me-2"></i>Coupon "{{ $appliedCoupon['code'] }}" applied!
                        </div>
                        @if($appliedCoupon['discount_type'] && $appliedCoupon['discount_type']==='percentage')
                            <div class="applied-coupon-msg">
                                <i class="fas fa-tag"></i> {{$appliedCoupon['discount']}}% OFF
                            </div>
                        @elseif($appliedCoupon['discount_type'] && $appliedCoupon['discount_type']==='flat')
                            <div class="applied-coupon-msg">
                                <i class="fas fa-tag"></i>FLAT {{$appliedCoupon['discount']}} OFF
                            </div>
                        @endif
                        @endif
                        <ul class="features">
                            @foreach ($plan->features ?? [] as $feature )
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
                        <form id="paymentForm_{{ $plan->id }}" action="{{ route('store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                            <input type="hidden" name="mobile" value="{{ auth()->user()->phone }}">
                            <input type="hidden" name="subscription_id" value="{{ $plan->id }}">
                            <input type="hidden" name="billing_cycle" id="billing_cycle" value={{$plan->billing_cycle}}>

                            {{-- cashfree subscription --}}
                            <input type="hidden" name="plan_id" value="{{ $plan->plan_id}}">
                            <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                            <input type="hidden" name="plan_type" value="{{ $plan->plan_type }}">
                            <input type="hidden" name="plan_currency" value="INR">
                            {{-- only for periodic plan recurring amount is required --}}
                            <input type="hidden" name="plan_recurring_amount" value="{{ $plan->plan_recurring_amount }}">
            
                            <input type="hidden" name="amount" value="{{ $plan->amount }}">
                            <button class="select-plan">Choose Plan</button>
                        </form>
                    </div>
                </div>
                <div class="card-back">
                    <div class="card-content">
                        <h3>Pro Plan</h3>
                        <p>Professional solutions for growing businesses</p>
                        <button class="select-plan">Get Started</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

       
    </div>

</div>

<!-- Coupon Modal -->
<div class="modal fade" id="applyCouponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="applyCouponForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Enter Coupon Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="coupon_code" class="form-control white-color" placeholder="Enter code" required>
                    <div id="couponMessage" class="text-danger mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <div id="removeCouponWrapper" class="{{ session('applied_coupon') ? '' : 'd-none' }}">
                        <button type="button" id="removeCouponBtn" class="btn btn-danger">Remove Coupon</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<!-- Include Cashfree SDK -->
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };

    var count = 200;
    var defaults = {
      origin: { y: 0.7 }
    };

    function fire(particleRatio, opts) {
      confetti({
        ...defaults,
        ...opts,
        particleCount: Math.floor(count * particleRatio)
      });
    }

    function runConfettiPopper() {
      fire(0.25, {
        spread: 26,
        startVelocity: 55,
      });
      fire(0.2, {
        spread: 60,
      });
      fire(0.35, {
        spread: 100,
        decay: 0.91,
        scalar: 0.8
      });
      fire(0.1, {
        spread: 120,
        startVelocity: 25,
        decay: 0.92,
        scalar: 1.2
      });
      fire(0.1, {
        spread: 120,
        startVelocity: 45,
      });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const couponActionBtn = document.getElementById('couponActionBtn');
        const couponForm = document.getElementById('applyCouponForm');
        const message = document.getElementById('couponMessage');
        const removeWrapper = document.getElementById('removeCouponWrapper');
        const removeBtn = document.getElementById('removeCouponBtn');
    
        // Initialize button state
        @if(session('applied_coupon'))
            couponActionBtn.textContent = 'Remove Coupon';
            couponActionBtn.setAttribute('data-action', 'remove');
            couponActionBtn.removeAttribute('data-bs-toggle');
            couponActionBtn.removeAttribute('data-bs-target');
        @endif
    
        couponForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const code = this.coupon_code.value;
    
            fetch('/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update the specific subscription card
                    const targetCard = document.querySelector(`.pricing-card[data-subscription-id="${data.subscription_id}"]`);
                    if (targetCard) {
                        const priceElement = targetCard.querySelector('.price');
                        const originalPrice = parseFloat(priceElement.getAttribute('data-original'));
                        priceElement.innerHTML = `
                            <del>₹${originalPrice.toFixed(2)}</del>
                            ₹${(data.discount_type==='flat')?
                                    Math.round((originalPrice - data.discount).toFixed(2)):
                                    Math.round((originalPrice - (originalPrice * data.discount / 100)).toFixed(2))
                                }
                            <small>/month</small>
                            <div class="applied-coupon-msg">
                                <i class="fas fa-check-circle me-2"></i>Coupon "${data.code}" applied!
                            </div>
                            ${
                                data.discount_type === 'percentage' 
                                    ? `<div class="applied-coupon-msg"><i class="fas fa-tag"></i> ${data.discount}% OFF</div>` 
                                    : `<div class="applied-coupon-msg"><i class="fas fa-tag"></i> FLAT ₹${data.discount} OFF</div>`
                            }
                        `;
                    }

                    couponActionBtn.textContent = 'Remove Coupon';
                    couponActionBtn.setAttribute('data-action', 'remove');
                    couponActionBtn.removeAttribute('data-bs-toggle');
                    couponActionBtn.removeAttribute('data-bs-target');
                    
                    const modal = bootstrap.Modal.getInstance(document.getElementById('applyCouponModal'));
                    modal.hide();
                    toastr.success(data.message);
                    runConfettiPopper();
                    // window.location.reload();
                } else {
                    message.classList.remove('text-success');
                    message.classList.add('text-danger');
                    message.textContent = data.message;
                }
            });
        });
    
        couponActionBtn.addEventListener('click', function(e) {
            if (this.getAttribute('data-action') === 'remove') {
                e.preventDefault();
                removeCoupon();
            }
        });
    
        function removeCoupon() {
            fetch('/remove-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    @if(session('applied_coupon'))
                        const subscriptionId = {{ session('applied_coupon')['subscription'] }};
                        const targetCard = document.querySelector(`.pricing-card[data-subscription-id="${subscriptionId}"]`);
                        if (targetCard) {
                            const priceElement = targetCard.querySelector('.price');
                            const originalPrice = parseFloat(priceElement.getAttribute('data-original'));
                            priceElement.innerHTML = `
                                ₹${originalPrice.toFixed(2)}
                                <small>/month</small>
                            `;
                            targetCard.querySelector('.applied-coupon-msg').style.display = 'none';
                        }
                    @endif
    
                    couponActionBtn.textContent = 'Apply Coupon';
                    couponActionBtn.setAttribute('data-action', 'apply');
                    couponActionBtn.setAttribute('data-bs-toggle', 'modal');
                    couponActionBtn.setAttribute('data-bs-target', '#applyCouponModal');
                    
                    toastr.success(data.message);
                    window.location.reload();
                }
            });
        }
    
        removeBtn.addEventListener('click', removeCoupon);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form[id^="paymentForm_"]').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
    
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
                        const cashfree = Cashfree({ 
                            mode:"sandbox",
                         });
    
                         cashfree.subscriptionsCheckout({
                            subsSessionId : data.subscription_session_id,
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
        });
    });
</script>
    


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.querySelector('.switch input');
        const prices = document.querySelectorAll('.price');
        const periods = document.querySelectorAll('.period');
        const couponBtn = document.getElementById('couponActionBtn');

        const pricingData = @json($jspricingData);

        if (toggle.checked) {
            couponBtn.style.visibility = 'hidden';
        }


        toggle.addEventListener('change', () => {
            const isYearly = toggle.checked;
            const billing_cycle = isYearly ? 'yearly' : 'monthly';

            document.querySelectorAll('input[name="billing_cycle"]').forEach(input => {
                input.value = billing_cycle;
            });

            prices.forEach((priceEl) => {
                const planId = parseInt(priceEl.getAttribute('data-id'));
                const planData = pricingData.find(p => p.id === planId);

                if (!planData) return;

                const newPrice = toggle.checked ? planData.yearly : planData.monthly;
                const periodText = toggle.checked ? 'year' : 'mo';

                priceEl.innerHTML = `
                    ₹${Math.round(newPrice)} 
                    <span class="currency">/</span>
                    <span class="period">${periodText}</span>
                `;

                const badgeE1 = document.querySelector(`.discount-badge[data-id="${planId}"]`);
                if (badgeE1) {
                    if (toggle.checked && planData.yearly_discount) {
                        badgeE1.innerHTML = `<span class="discount">Save ${planData.yearly_discount}%</span>`;
                    }else {
                        badgeE1.innerHTML = '';
                    }
                }
            });

            couponBtn.style.visibility = toggle.checked ? 'hidden' : 'visible';
        });
    });
</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
    
        const toggle = document.querySelector('.switch input');
        const prices = document.querySelectorAll('.price');
        const periods = document.querySelectorAll('.period');
        const discount = document.querySelector('.discount');

        const pricingData = @json($plans->map(function($plan) {
            return [
                'id' => $plan->id,
                'monthly' => $plan->amount,
                'yearly' => round($plan->amount * 12 * 0.8) 
            ];
        }));
        

        toggle.addEventListener('change', () => {
        prices.forEach((priceEl) => {
        const planId = parseInt(priceEl.getAttribute('data-id'));
        const planData = pricingData.find(p => p.id === planId);
        
        if (!planData) return;

        const newPrice = toggle.checked ? planData.yearly : planData.monthly;
        const periodText = toggle.checked ? 'year' : 'mo';
        const discountBadge = planData.yearly_discount && toggle.checked 
            ? `<span class="discount-badge">Save ${planData.yearly_discount}%</span>` 
            : '';

        priceEl.innerHTML = `
            ₹${newPrice.toFixed(2)} 
            <span class="currency">/</span>
            <span class="period">${periodText}</span>
            ${discountBadge}
        `;
    });
});

    });
</script> --}}

@endpush

@endsection