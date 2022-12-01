@extends("templates.app")

@section("body")

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('sucesso'))
        <div class="alert alert-danger">
            {{session('sucesso')}}
        </div>
    @endif
    <br>
    <div style="background: #FFFFFF; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25); border-radius: 20px; padding: 34px; width: 65%";>
        <div class="row">
            <h1 style="font-weight: 600; font-size: 40px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                Cadastrar Orientador</h1>
        </div>

        <hr>

        <form action="{{route("orientadors.store")}}" method="POST">
            @csrf
            <label for="nome" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Nome: </label>
            <input type="text" name="nome" id="nome"
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

            <label for="email" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">E-mail: </label>
            <input type="text" name="email" id="email"
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

            <label for="senha" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Senha: </label>
            <input type="password" name="senha" id="senha"
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

            <label for="cpf" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">CPF: </label>
            <input type="text" name="cpf" id="cpf"
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
            box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>

            <label for="matricula" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Matrícula: </label>
            <input type="text" name="matricula" id="matricula"
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px;
             box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);"><br><br>
            
            <div style="display: flex; gap: 71%; align-content: center; align-items: center">
                <input type="button" value="Voltar" href="{{route('home')}}" onclick="window.location.href='{{route('home')}}'"
                style="background: #2D3875; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                line-height: 29px; text-align: center; padding: 5px 15px;">

                <input type="submit" value="Cadastrar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                display: inline-block;
                border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal; font-weight: 400; font-size: 24px;
                line-height: 29px; text-align: center; padding: 5px 15px;">
            </div>
        </form>        
    </div>
</div>

@endsection