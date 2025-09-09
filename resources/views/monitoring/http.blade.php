<div class="d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form id="httpMonitoringForm" method="POST" action="{{ route('monitoring.http.store') }}">
                    @csrf
                    <input type="hidden" name="form_type" value="http">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Friendly name</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="E.g. Google" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input id="url" class="form-control" name="url" type="text" placeholder="E.g. https://www.google.com" value="{{ old('url') }}">
                        @error('url')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

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
                    </div> <!-- end row -->

                    {{-- ✅ Allowed Status Codes --}}
                    <div class="mb-3">
                        <label for="allowed_status_codes" class="form-label">Allowed Status Codes</label>
                        <select id="allowed_status_codes" name="allowed_status_codes[]" class="form-control" multiple>
                            {{-- Special default option --}}
                            <option value="2xx" selected>2xx(200-299)</option>

                            {{-- Individual codes --}}
                            @for ($code = 100; $code <= 599; $code++)
                                <option value="{{ $code }}">{{ $code }}</option>
                            @endfor
                        </select>
                        <small class="form-text text-muted">
                            Hold Ctrl (Windows) or Command (Mac) to select multiple codes.
                        </small>
                        @error('allowed_status_codes')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
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
                               value="{{ old('telegram_id') }}"
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
                               value="{{ old('telegram_bot_token') }}"
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
