<div class="d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form id="dnsMonitoringForm" method="POST" action="/add/dns">
                    @csrf
                    <input type="hidden" name="form_type" value="dns">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Friendly name</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="E.g. Google" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="domain" class="form-label">Domain or URL</label>
                        <input id="domain" class="form-control" name="domain" type="text" placeholder="E.g. google.com"   >
                            @error('domain')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="retries" class="form-label">Retries</label>
                            <input id="retries" class="form-control" name="retries" type="number" min="0" value="3"  >
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

                  

                    <div class="mb-3">
                        <label for="dns_resource_type" class="form-label">DNS Resource Type</label>
                        <select id="dns_resource_type" class="form-control" name="dns_resource_type"  >
                            <option value="A">A</option>
                            <option value="AAAA">AAAA</option>
                            <option value="CNAME">CNAME</option>
                            <option value="MX">MX</option>
                            <option value="NS">NS</option>
                            <option value="SOA">SOA</option>
                            <option value="TXT">TXT</option>
                            <option value="SRV">SRV</option>
                            <option value="DNS_ALL">DNS_ALL</option>
                        </select>
                            @error('dns_resource_type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                    </div>

                    <h5 class="card-title">Notification</h5>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="example@gmail.com">
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
                    </div>

                    <input class="btn btn-primary w-100" type="submit" value="Submit">

                </form>
            </div>
        </div>
    </div>
</div>