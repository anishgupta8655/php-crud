@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="heroForm" action="{{ route('heroSend') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="form-control" required>
                @error('subtitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Background Image</label>
                <input type="file" name="background_image" class="form-control" required>
                @error('background_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Hero</button>
        </form>

        <hr>

        {{-- <h3>Saved Heroes</h3>
        @foreach ($heroes as $hero)
            <div class="mb-4">
                <h4>{{ $hero->title }}</h4>
                <p>{{ $hero->subtitle }}</p>
                @if ($hero->background_image)
                    <img src="{{ asset('storage/' . $hero->background_image) }}" alt="" style="max-width:300px;">
                @endif
            </div>
        @endforeach --}}
    </div>
@endsection
