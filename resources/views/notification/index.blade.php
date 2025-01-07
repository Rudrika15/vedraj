@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Notifications</h3>
            </div>
            <div class="">
                <a href="{{ route('notification.create') }}" class="btn btn-primary">Add Notification</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->subject }}</td>
                                <td>{{ $notification->message }}</td>
                                <td>{{ $notification->type }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('notification.edit', $notification->id) }}"
                                        class="btn btn-xs btn-primary">Edit</a>
                                    <a href="{{ route('notification.delete', $notification->id) }}"
                                        data-url="{{ route('notification.delete', $notification->id) }}"
                                        class="btn btn-xs btn-danger delete-button">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
