@extends('dashboard')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
        border: 1px solid #ddd;
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
        color: var(--white);
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
    .modal-body{
        display: flex;
        justify-content: center;
    }
</style>
@endpush

<div class="container py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800 white-color subscription-head">Feature Requests</h1>
    </div>

    <div id="featureRequests">
        <div class="row gap-2 mb-3">
            <!-- Search -->
            <div class="col-12 col-md-4">
                <input class="search form-control w-100" placeholder="Search feature requests"/>
            </div>

            <!-- Date Range -->
            <div class="col-12 col-md-4">
                <input type="text" id="dateRange" class="form-control" placeholder="Filter by date range"/>
            </div>

            <!-- Sort Buttons -->
            <div class="col-12 col-md-auto d-flex gap-2 mt-2 mt-md-0">
                <button class="sort btn btn-sm btn-outline-primary" data-sort="date" data-order="desc">
                    Sort by Newest
                </button>
                <button class="sort btn btn-sm btn-outline-secondary" data-sort="date" data-order="asc">
                    Sort by Oldest
                </button>
            </div>
        </div>

        <!-- Posts container -->
        <div class="row" id="postsContainer"></div>
        <div id="pagination" class="mt-4"></div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>

<script>
    let startDate = '';
    let endDate = '';
    let order = 'desc';
    let searchTimeout;

    // Init flatpickr for date range
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "d-m-Y",
        onChange: function(selectedDates) {
            if (selectedDates.length === 2) {
                startDate = flatpickr.formatDate(selectedDates[0], "d-m-Y");
                endDate   = flatpickr.formatDate(selectedDates[1], "d-m-Y");
                fetchPosts();
            }
        }
    });

    // Fetch posts via AJAX
    function fetchPosts(cursor = null) {
        $.ajax({
            url: "{{ route('feedback.filter') }}",
            data: {
                search: $('.search').val(),
                start_date: startDate,
                end_date: endDate,
                order: order,
                cursor: cursor
            },
            success: function(res) {
                renderPosts(res.data);
                renderPagination(res);
            }
        });
    }


    // Render cards dynamically
    function renderPosts(posts) {
        let container = $('#postsContainer');
        container.empty();

        if (posts.length === 0) {
            container.html('<div class="col-12"><p class="text-muted">No feature requests found.</p></div>');
            return;
        }

        posts.forEach(post => {
            let attachmentsHtml = '';
            if (post.attachments && post.attachments.length > 0) {
                attachmentsHtml = `<div class="attachments-gallery">`;
                post.attachments.forEach(att => {
                    attachmentsHtml += `
                        <div class="attachment-container" data-image="${att.image}">
                            <img src="${att.image}" class="attachment-image" alt="Attachment">
                            <div class="attachment-overlay">
                                <div>
                                    <i class="fas fa-search-plus fa-lg mb-2"></i>
                                    <div>Click to view</div>
                                </div>
                            </div>
                        </div>`;
                });
                attachmentsHtml += `</div>`;
            }

            container.append(`
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><strong>${post.title}</strong></h5>
                            <p class="card-text">${post.content ?? ''}</p>
                            ${attachmentsHtml}
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between">
                            <small class="text-muted">Posted by ${post.author_name} • ${new Date(post.created_at).toLocaleString()}</small>
                            <span class="badge badge-primary">${post.upvotes_count} upvotes</span>
                        </div>
                    </div>
                </div>
            `);
        });

        bindAttachmentClicks();
    }

    // Render pagination
    function renderPagination(res) {
        let pagination = $('#pagination');
        pagination.empty();

        let html = `<nav><ul class="pagination justify-content-center">`;

        if (res.prev_cursor) {
            html += `<li class="page-item"><a class="page-link" href="#" data-cursor="${res.prev_cursor}">Prev</a></li>`;
        }

        if (res.next_cursor) {
            html += `<li class="page-item"><a class="page-link" href="#" data-cursor="${res.next_cursor}">Next</a></li>`;
        }

        html += `</ul></nav>`;
        pagination.html(html);

        // bind click events
        $('#pagination .page-link').on('click', function(e) {
            e.preventDefault();
            let cursor = $(this).data('cursor');
            fetchPosts(cursor);
        });
    }


    // Attachment modal handling
    function bindAttachmentClicks() {
        document.querySelectorAll('.attachment-container').forEach(container => {
            container.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                $('#modalImage').attr('src', imageUrl);
                $('#downloadBtn').attr('href', imageUrl).attr('download', imageUrl.split('/').pop());
                $('#imageModal').modal('show');
            });
        });
    }

    // Search event
    $('.search').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => fetchPosts(), 400); // waits 400ms
    });

    // Sort buttons
    $('.sort').on('click', function() {
        order = $(this).data('order');
        fetchPosts();
    });

    // Initial load
    fetchPosts();
</script>

@endpush
@endsection
