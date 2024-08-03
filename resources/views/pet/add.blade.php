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
    <form action="/store" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategoria</label>
            <input type="text" class="form-control" id="category" name="category">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nazwa</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tagi</label>
            <input type="text" class="form-control" id="tags" name="tags" aria-describedby="tagsHelp">
            <div id="tagsHelp" class="form-text">Aby dodać więcej tagów wpisz wartości po przecinku</div>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="status">Status</label>
            <select class="form-select" id="status" name="status">
                <option selected>Wybierz status</option>
                <option value="avaiable">Dostępny</option>
                <option value="sold">Sprzedany</option>
            </select>
            </div>

        <a href="javascript:history.back()" class="btn btn-lg btn-primary">Wróć</a>
        <button type="submit" class="btn btn-lg btn-primary">Dodaj</button>
        </form>
</div>
@endsection
