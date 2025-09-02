
@push('styles')
    
<style>
    .dropdown {
        position: relative;
    }
    
    .dropdown:after {
        padding: 12px 15px;
        position: absolute;
        right: 5px;
        top: 8px;
        color: var(--white);
    }
    
    .dropdown.active:after {
        transform: rotate(180deg);
    }
    
    .dropdown_wrapper {
    position: absolute;
    z-index: 1000; 
    top: 100%; 
    left: 0;
    right: 0;
    padding-top: 8px;
    height: 250px;
    display: none;
    padding-right: 11px;
    padding-left: 11px;
}
    
    .dropdown_wrapper.active {
        display: block;
    }
    
    .languages_wrapper {
        overflow-y: hidden;
        height: 100%;
        padding: 8px;
        padding-right: 0;
        background: var(--white);
        /* border: 2px solid var(--dark-border); */
        border-radius: 15px;
    }
    
    #ports {
        overflow-y: auto;
        height: inherit;
    }
    
    #ports span {
        display: block;
        padding: 12px;
        border-radius: 15px;
        letter-spacing: .025rem;
        /* color: var(--dark-border);  */
    }
    
    #ports span:hover {
        background: var(--primary);
        color: var(--white);
        cursor: pointer;
    }

    .languages_wrapper::-webkit-scrollbar-track {
    background: var(--white);
}

html.dark-mode .languages_wrapper {
    background-color: var(--color-card-dark)!important ;
}

html.dark-mode #ports span {
    color: var(--white);
}


html.dark-mode .languages_wrapper {
    scrollbar-color: var(--color-card-dark) var( --color-card-accent-dark);
}

html.dark-mode .languages_wrapper::-webkit-scrollbar-track {
    background: var( --color-card-accent-dark);
}

html.dark-mode .languages_wrapper::-webkit-scrollbar-thumb {
    background-color: var(--color-card-dark);
    border: 2px solid var( --color-card-accent-dark);
}


.col-md-4.position-relative {
  position: relative;
}

datalist#portOptions {
  position: absolute;
  background-color: var(--white);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 90%;
  padding: 7px;
  max-height: 10rem;
  overflow-y: auto;
  display: none; 
  z-index: 1000;
  margin-top: 5px;
  scrollbar-width: none;
}

datalist#portOptions::-webkit-scrollbar {
  display: none; 
}

/* Dropdown option items */
datalist#portOptions option {
  padding: 4px;
  font-size: 16px;
  cursor: pointer;
  color: var(--primary);
}

datalist#portOptions option:hover,
datalist#portOptions option.active {
  background-color: #e6f0ff;
}

#portInput:focus {
    box-shadow: none !important;
    outline: none !important;
    border: 2px solid var(--primary); 
}

html.dark-mode datalist#portOptions {
  background-color: var(--color-card-dark);
}

html.dark-mode datalist#portOptions option {
  color: var(--color-text-dark);
}

html.dark-mode datalist#portOptions option:hover,
datalist#portOptions option.active {
  background-color: var(--color-input-dark);
}

@media (max-width: 578px) {

datalist#portOptions {
  width: 93%;
    }

}
</style>

@endpush


<div class="d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form id="portMonitoringForm" method="POST" action="{{ route('monitor.port') }}">
                    @csrf
                    <input type="hidden" name="form_type" value="port">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Friendly name</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="E.g. Google" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="url" class="form-label">URL, IP or host to monitor</label>
                            <input id="url" class="form-control" name="url" type="text" 
                                   placeholder="E.g. https://example.com" 
                                   value="{{ old('url') }}">
                            @error('url')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        {{-- <div class="col-md-4 mb-3 position-relative">
                            <label for="port" class="form-label">TCP port</label>
                            <input id="port" class="form-control mb-1 port-input" name="port" type="text"
                                   placeholder="E.g. 22, 80, 443"
                                   list="portOptions"
                                   value="{{ old('port') }}">
                            
                            <div class="datalist-options">
                                <datalist id="portOptions" role="listbox">
                                    <option value="21">FTP (21)</option>
                                    <option value="22">SSH (22)</option>
                                    <option value="25">SMTP (25)</option>
                                    <option value="53">DNS (53)</option>
                                    <option value="80">HTTP (80)</option>
                                    <option value="110">POP3 (110)</option>
                                    <option value="143">IMAP (143)</option>
                                    <option value="443">HTTPS (443)</option>
                                    <option value="465">SMTP-SSL (465)</option>
                                    <option value="587">SMTP-TLS (587)</option>
                                </datalist>
                            </div>
                            
                            @error('port')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="col-md-4 mb-3 position-relative">
                            <label for="port" class="form-label">TCP port</label>
                            <input autocomplete="off" role="combobox" list="" id="portInput" name="port"
                                   placeholder="E.g. 22, 80, 443" class="form-control mb-1"
                                   value="{{ old('port') }}" type="text">
                            <datalist id="portOptions" role="listbox">
                                <option value="21">FTP (21)</option>
                                <option value="22">SSH (22)</option>
                                <option value="25">SMTP (25)</option>
                                <option value="53">DNS (53)</option>
                                <option value="80">HTTP (80)</option>
                                <option value="110">POP3 (110)</option>
                                <option value="143">IMAP (143)</option>
                                <option value="443">HTTPS (443)</option>
                                <option value="465">SMTP-SSL (465)</option>
                                <option value="587">SMTP-TLS (587)</option>
                                <option value="995">POP3 (995)</option>
                                <option value="3306">MySQL (3306)</option>
                            </datalist>
                        </div>
                        
                    </div>
            
                    {{-- <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="url" class="form-label">URL, IP or host to monitor</label>
                            <input id="url" class="form-control" name="url" type="text" 
                                   placeholder="E.g. ple.com" 
                                   value="{{ old('url') }}">
                            @error('url')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-5 mb-3">
                            <label for="port" class="form-label">TCP port</label>
                            <div class="dropdown">
                                <input id="port" class="form-control" name="port" type="text"
                                       placeholder="E.g. 22, 80, 443"
                                       value="{{ old('port') }}">
                            </div>
                            
                            <div class="dropdown_wrapper">
                                <div class="languages_wrapper">
                                    <div id="ports">
                                        <span data-value="21">FTP (21)</span>
                                        <span data-value="22">SSH (22)</span>
                                        <span data-value="25">SMTP (25)</span>
                                        <span data-value="53">DNS (53)</span>
                                        <span data-value="80">HTTP (80)</span>
                                        <span data-value="110">POP3 (110)</span>
                                        <span data-value="143">IMAP (143)</span>
                                        <span data-value="443">HTTPS (443)</span>
                                        <span data-value="465">SMTP-SSL (465)</span>
                                        <span data-value="587">SMTP-TLS (587)</span>
                                    </div>
                                </div>
                            </div>
                            
                            @error('port')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="retries" class="form-label">Retries</label>
                            <input id="retries" class="form-control" name="retries" type="number" value="{{ old('retries', 3) }}">
                                @error('retries')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                        </div>
    
                        <div class="col-md-6 mb-3">
                                    <label for="interval" class="form-label">Interval (in minutes)</label>
                                    <input 
                                        id="interval"
                                        class="form-control {{ auth()->user()->status === 'free' ? 'bg-light text-muted border-secondary' : '' }}"
                                        name="interval"
                                        type="number"
                                        min="{{ auth()->user()->status === 'free' ? 5 : 1 }}"
                                        max="10"
                                        value="{{ old('interval', auth()->user()->status === 'free' ? 5 : 1) }}"
                                        {{ auth()->user()->status === 'free' ? 'title=Only 5-10 minutes allowed for free users' : '' }}
                                    >
                                    @if (auth()->user()->status === 'free')
                                        <small class="form-text text-muted">
                                            Free users can set an interval between <strong>5 and 10 minutes</strong>. 
                                            <a href="{{ route('premium.page') }}">Upgrade to premium <i class="fa-solid fa-crown" style="color: #FFD43B;"></i></a> to set a shorter interval.
                                        </small>
                                    @endif
                            </div>
                    </div>
    
                    <h5 class="card-title">Notification</h5>
    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                    </div>
    
                   <div class="mb-3">
                    <label for="telegram_id" class="form-label">Telegram ID (Optional)</label>
                    <input id="telegram_id" class="form-control {{ auth()->user()->status === 'free' ? 'bg-light text-muted border-secondary' : '' }}" name="telegram_id" type="text"
                        {{ auth()->user()->status === 'free' ? 'disabled title=Only available for paid users' : '' }}>
                    @if (auth()->user()->status === 'free')
                        <small class="form-text text-muted">
                            <a href="{{ route('premium.page') }}">Upgrade to premium <i class="fa-solid fa-crown" style="color: #FFD43B;"></i></a> to enable Telegram notifications.
                        </small>
                    @endif
                </div>
    
                <div class="mb-3">
                    <label for="telegram_bot_token" class="form-label">Telegram Bot Token (Optional)</label>
                    <input id="telegram_bot_token" class="form-control {{ auth()->user()->status === 'free' ? 'bg-light text-muted border-secondary' : '' }}" name="telegram_bot_token" type="text"
                        {{ auth()->user()->status === 'free' ? 'disabled title=Only available for paid users' : '' }}>
                    @if (auth()->user()->status === 'free')
                        <small class="form-text text-muted">
                            <a href="{{ route('premium.page') }}">Upgrade to premium <i class="fa-solid fa-crown" style="color: #FFD43B;"></i></a> to enable Telegram notifications.
                        </small>
                    @endif
                    <div class="form-text">You can get a token from <a href="https://t.me/BotFather" target="_blank">https://t.me/BotFather</a>.</div>
                </div>
                    
                    <input class="btn btn-primary w-100" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')


<script>
    const portInput = document.getElementById('portInput');
    const portOptions = document.getElementById('portOptions');
    let currentFocus = -1;
    
    // Show dropdown on focus
    portInput.onfocus = function () {
      portOptions.style.display = 'block';
    //   portInput.style.borderRadius = "5px 5px 0 0";
    };
    
    // Click to select an option
    for (let option of portOptions.options) {
      option.onclick = function () {
        portInput.value = option.value;
        portOptions.style.display = 'none';
        // portInput.style.borderRadius = "5px";
      }
    }
    
    // Filter list based on input
    portInput.oninput = function () {
      currentFocus = -1;
      let filter = portInput.value.toUpperCase();
      for (let option of portOptions.options) {
        option.style.display = option.value.toUpperCase().includes(filter)
          ? "block"
          : "none";
      }
    };
    
    // Keyboard navigation
    portInput.onkeydown = function (e) {
      if (e.keyCode == 40) {
        // Down arrow
        currentFocus++;
        addActive(portOptions.options);
      } else if (e.keyCode == 38) {
        // Up arrow
        currentFocus--;
        addActive(portOptions.options);
      } else if (e.keyCode == 13) {
        // Enter
        e.preventDefault();
        if (currentFocus > -1) {
          portOptions.options[currentFocus].click();
        }
      }
    };
    
    function addActive(items) {
      if (!items) return;
      removeActive(items);
      if (currentFocus >= items.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = items.length - 1;
      items[currentFocus].classList.add("active");
    }
    
    function removeActive(items) {
      for (let i = 0; i < items.length; i++) {
        items[i].classList.remove("active");
      }
    }
    
    // Hide dropdown when clicking outside
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.col-md-4')) {
        portOptions.style.display = 'none';
        // portInput.style.borderRadius = "5px";
      }
    });
    </script>

    
@endpush
    