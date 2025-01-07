@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Edit Notification</h3>
            </div>
            <div class="">
                <a href="{{ route('notification.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="{{ route('notification.update', $notification->id) }}" method="POST">@csrf
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" value="{{ $notification->subject }}" class="form-control" id="subject"
                    name="subject" value="{{ old('subject') }}">
                @error('subject')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message">{{ $notification->message ?? old('message') }}</textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
