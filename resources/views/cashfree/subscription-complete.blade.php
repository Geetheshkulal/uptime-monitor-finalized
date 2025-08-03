


<div class="container py-4">
    <h2 class="mb-4 text-success">Subscription Completed Successfully</h2>

    <div class="card">
        <div class="card-body">
            <h5>Cashfree POST Data:</h5>
            <pre class="bg-light p-3 border rounded">{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>

    <a href="{{ route('monitoring.dashboard') }}" class="btn btn-primary mt-4">Go to Dashboard</a>
</div>

