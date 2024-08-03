@extends('layout-main')
@section('content')
<div class="container mt-5">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" disabled value="{{ $pet['id'] ?? 'brak'}}">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategoria</label>
            <input type="text" class="form-control" id="category" name="category" disabled value="{{ $pet['category'] ?? 'brak' }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name" disabled value="{{ $pet['name'] ?? 'brak'  }}">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tagi</label>
            <input type="text" class="form-control" id="tags" name="tags" aria-describedby="tagsHelp" disabled value="{{ $pet['tags'] ?? 'brak' }}">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="status">Status</label>
            <select class="form-select" id="status" name="status" disabled>
                @if ($pet['status']==='available')
                    <option>Dostępny</option>
                @elseif ($pet['status']==='sold')
                    <option>Sprzedany</option>
                @else
                    <option>Brak</option>
                @endif
            </select>
            </div>

        <a href="javascript:history.back()" class="btn btn-lg btn-primary">Wróć</a>
</div>
@endsection
