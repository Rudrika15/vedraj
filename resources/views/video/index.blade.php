@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Videos</h3>
            </div>
            <div class="">
                <a href="{{ route('video.create') }}" class="btn btn-primary">Create Video</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Disease Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Title Hindi</th>
                        <th scope="col">Youtube Link</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $video->disease->disease_name ?? '' }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->title_hindi }}</td>
                            <td>{!! $video->youtube_link !!}</td>
                            <td><img src="{{ asset('images/videos/' . $video->thumbnail) }}" width="120" alt="">
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('video.edit', $video->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="{{ route('video.delete', $video->id) }}"
                                        data-url="{{ route('video.delete', $video->id) }}"
                                        class="btn btn-xs btn-danger delete-button">Delete</a>
                                    {{-- <button type="button" class="btn btn-xs btn-info"
                                        onclick="showPreview('{{ $video->youtube_link }}')">Preview</button> --}}

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <p class="close">&times;</p>
            <div class="modal-body">
                <iframe id="youtube-iframe" width="100%" height="315" src="" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 700px;
            position: relative;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 0;
            margin-bottom: 2px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }
    </style>

    <script>
        // Modal handling logic
        const modal = document.getElementById("myModal");
        const closeModal = document.querySelector(".close");

        // Close modal when clicking "X"
        closeModal.onclick = function() {
            closePreview();
        };

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target === modal) {
                closePreview();
            }
        };

        function closePreview() {
            modal.style.display = "none";
            const iframe = document.getElementById("youtube-iframe");
            iframe.src = ""; // Clear iframe source
        }

        function showPreview(youtubeLink) {
            try {
                if (youtubeLink) {
                    let videoId = null;

                    // Handle embedded iframe links
                    if (youtubeLink.includes('<iframe')) {
                        const srcMatch = youtubeLink.match(/src=["']([^"']+)["']/);
                        if (srcMatch) {
                            youtubeLink = srcMatch[1]; // Extract the src attribute value
                        } else {
                            alert("Invalid embedded iframe. Could not extract YouTube link.");
                            return;
                        }
                    }

                    // Ensure the link is absolute
                    const isAbsoluteUrl = youtubeLink.startsWith("http://") || youtubeLink.startsWith("https://");
                    if (!isAbsoluteUrl) {
                        alert("Invalid YouTube link. Please provide a valid URL.");
                        return;
                    }

                    // Parse video ID from YouTube URL formats
                    const url = new URL(youtubeLink);
                    if (url.hostname.includes("youtube.com")) {
                        if (url.pathname.includes("/embed/")) {
                            videoId = url.pathname.split('/embed/')[1].split('?')[0];
                        } else {
                            const urlParams = new URLSearchParams(url.search);
                            videoId = urlParams.get('v');
                        }
                    } else if (url.hostname.includes("youtu.be")) {
                        videoId = url.pathname.substring(1);
                    }

                    // Show the video or fallback
                    if (videoId) {
                        const iframe = document.getElementById("youtube-iframe");
                        iframe.src = `https://www.youtube.com/embed/${videoId}?rel=0`;

                        modal.style.display = "block"; // Show modal
                    } else {
                        alert("Invalid YouTube link. Could not extract video ID.");
                    }
                } else {
                    alert("No YouTube link provided.");
                }
            } catch (error) {
                alert("An error occurred: " + error.message);
            }
        }
    </script>
@endsection
