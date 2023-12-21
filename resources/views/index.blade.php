@extends('layout.base')

@section('title', 'Cadastro de Usuários')
@section('content')
    <h1>Cadastro de Usuários</h1>
    <div id="responseMessage"></div>
    <form method="post" action="{{ url('/api/register') }}" class="mt-4" id="userForm">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmação de Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>

@endsection
@section('script')
    <script>
        document.getElementById('userForm').addEventListener('submit', function (event) {
            event.preventDefault();

            axios.post(this.action, new FormData(this))
                .then(response => {
                    document.getElementById('responseMessage').innerHTML = '<div class="alert alert-success">' + response.data.message + '</div>';
                    this.reset();
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        let errorMessage = '<div class="alert alert-danger">Erros de validação:<ul>';
                        for (let field in error.response.data.errors) {
                            errorMessage += '<li>' + error.response.data.errors[field].join('</li><li>') + '</li>';
                        }
                        errorMessage += '</ul></div>';
                        document.getElementById('responseMessage').innerHTML = errorMessage;

                        for (let field in error.response.data.old) {
                            let inputField = document.getElementById(field);
                            if (inputField) {
                                inputField.value = error.response.data.old[field];
                            }
                        }
                    } else if (error.response.data.error) {
                        document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">' + error.response.data.error + '</div>';
                    } else {
                        document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">Ocorreu Um Erro</div>';
                    }
                });
        });
    </script>
@endsection
