@extends('dashboard')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<style>
.attachments-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
}

.attachment-container {
    position: relative;
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 4px;
    border: 1px solid var(--color-border-primary);
    cursor: pointer;
}

.attachment-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.attachment-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 12px;
    text-align: center;
    padding: 5px;
}

.attachment-container:hover .attachment-overlay {
    opacity: 1;
}

.attachment-container:hover .attachment-image {
    transform: scale(1.05);
}

@media (max-width: 578px) {
           
        }
</style>

@endpush

<div class="container py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800 white-color subscription-head">Feature Requests</h1>
    </div>

    <div id="featureRequests">
        <div class="row gap-2 mb-3">
            <div class="col-12 col-md-6">
                <input class="search form-control w-100" placeholder="Search feature requests"/>
            </div>
    
        <div class="col-12 col-md-auto d-flex gap-2">
            <button class="sort btn btn-sm btn-outline-primary" data-sort="date" data-order="desc">
                Sort by Newest
            </button>
            <button class="sort btn btn-sm btn-outline-secondary" data-sort="date" data-order="asc">
                Sort by Oldest
            </button>
        </div>
        </div>
    

    <div class="list row">
        @foreach($feedbearPosts as $post)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title title"><strong>{{ $post->title }}</strong></h5>
                    <p class="card-text">{{ $post->content }}</p>
                    
                     {{-- @if(!empty($post->attachments))
                     @foreach($post->attachments as $attachment)
                            @if($attachment)
                                <div class="attachment-container" data-image="{{ $attachment['image'] }}">
                                    <img src="{{ $attachment['image'] }}" class="attachment-image" alt="Attachment">
                                    <div class="attachment-overlay">
                                        <div>
                                            <i class="fas fa-search-plus fa-lg mb-2"></i>
                                            <div>Click to view</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif --}}

                    @if(!empty($post->attachments))
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($post->attachments as $attachment)
                                @if($attachment)
                                    <div class="attachment-container" data-image="{{ $attachment['image'] }}">
                                        <img src="{{ $attachment['image'] }}" 
                                            class="attachment-image img-thumbnail" 
                                            style="object-fit:cover; cursor:pointer;" 
                                            alt="Attachment">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                    {{-- @if(!empty($post->attachments))
                        <div class="mb-3">
                            @foreach($post->attachments as $attachment)
                                <img src="{{ $attachment['image'] }}" class="img-fluid rounded mb-2" style="max-height: 200px;">
                            @endforeach
                        </div>
                    @endif --}}
                </div>
                
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-wrap">
                            <span class="text-muted author">Posted by {{ $post->author_name }}</span>
                            <span class="mx-2">•</span>
                            <small class="text-muted date" data-date="{{ $post->created_at->timestamp }}">{{ $post->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</small>
                        </div>
                        <div>
                            <span class="badge badge-primary">{{ $post->upvotes_count }} upvotes</span>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $feedbearPosts->appends(request()->query())->links('pagination::bootstrap-4') }}
     </div>

</div>


<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1"   role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attachment Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Attachment">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="downloadBtn" href="#" class="btn btn-primary" download>
                    <i class="fas fa-download"></i> Download
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

<script>

    var options = {
        valueNames: [ 'title', 'author', { name: 'date', attr: 'data-date' } ]
    };

    var featureList = new List('featureRequests', options);

    // Default sort (newest first)
    featureList.sort('date', { order: "desc" });


// Image modal functionality
const imageModal = $('#imageModal');
const modalImage = document.getElementById('modalImage');
const downloadBtn = document.getElementById('downloadBtn');

document.querySelectorAll('.attachment-container').forEach(container => {
    container.addEventListener('click', function() {
        const imageUrl = this.getAttribute('data-image');
        modalImage.src = imageUrl;
        downloadBtn.href = imageUrl;
        downloadBtn.setAttribute('download', imageUrl.split('/').pop());
        imageModal.modal('show');
    });
});

modalImage.onerror = function() {
    this.src = 'https://via.placeholder.com/800x600?text=Image+Not+Available';
    downloadBtn.style.display = 'none';
};

imageModal.on('hidden.bs.modal', function() {
    downloadBtn.style.display = 'block';
});

</script>
@endpush
@endsection