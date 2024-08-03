@extends('layout-main')
@section('content')
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/update/{{ $pet['id'] }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="{{ $pet['id'] ?? 'brak'}}" disabled>
            <input type="hidden" name="id" value="{{ $pet['id'] }}">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategoria</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $pet['category'] ?? 'brak' }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $pet['name'] ?? 'brak'  }}">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tagi</label>
            <input type="text" class="form-control" id="tags" name="tags" aria-describedby="tagsHelp" value="{{ $pet['tags'] ?? 'brak' }}">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="status">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="" {{ $pet['status'] !== 'sold' && $pet['status'] !== 'available' ? 'selected' : '' }}>Wybierz status</option>
                <option value="available" {{ $pet['status'] === 'available' ? 'selected' : '' }}>Dostępny</option>
                <option value="sold" {{ $pet['status'] === 'sold' ? 'selected' : '' }}>Sprzedany</option>
            </select>
        </div>

        <a href="javascript:history.back()" class="btn btn-lg btn-primary">Wróć</a>
        <button type="submit" class="btn btn-lg btn-primary">Edytuj</button>
        </form>
</div>
@endsection
