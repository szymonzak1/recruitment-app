@extends('layout-main')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col mb-3">
                <label for="id" class="form-label">Podaj id żeby edytować lub zobaczyć zwierze</label>
                <input type="number" class="form-control" id="id" name="id">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 d-flex justify-content-center">
                <a href="/add" class="btn btn-lg btn-primary">Dodaj</a>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <a href="#" id="editBtn" class="btn btn-lg btn-primary">Edytuj</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                <a href="#" id="showBtn" class="btn btn-lg btn-primary">Pokaż</a>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <a href="#" id="deleteBtn" class="btn btn-lg btn-primary">Usuń</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idInput = document.getElementById('id');

            document.getElementById('editBtn').addEventListener('click', function() {
                const id = idInput.value;
                if(id)
                    window.location.href = `/edit/${id}`;
                else
                    window.location.href = `/`;
            });

            document.getElementById('showBtn').addEventListener('click', function() {
                const id = idInput.value;
                if(id)
                    window.location.href = `/show/${id}`;
                else
                    window.location.href = `/`;
            });

            document.getElementById('deleteBtn').addEventListener('click', function() {
                const id = idInput.value;
                if(id)
                    window.location.href = `/delete/${id}`;
                else
                    window.location.href = `/`;
            });
        });
    </script>

@endsection
