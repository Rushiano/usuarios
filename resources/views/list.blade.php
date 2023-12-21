@extends('layout.base')
@section('title', 'Lista de Usuários')
@section('content')
    <h1>Lista de Usuários</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
        </thead>
        <tbody id="userTableBody">
        </tbody>
@endsection

@section('script')
    <script>
        window.onload = function() {
            fetch('/api/users')
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('userTableBody');
                    data.users.forEach((user, index) => {
                        let row = document.createElement('tr');

                        let idCell = document.createElement('td');
                        idCell.textContent = index + 1;
                        row.appendChild(idCell);

                        let nameCell = document.createElement('td');
                        nameCell.textContent = user.name;
                        row.appendChild(nameCell);

                        let emailCell = document.createElement('td');
                        emailCell.textContent = user.email;
                        row.appendChild(emailCell);

                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        };
    </script>
@endsection
