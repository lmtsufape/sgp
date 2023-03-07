@extends("templates.app")

@section("body")

<style>
  pagination {
    display: inline-block;
  }
  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 10px 4px;
  }
  .pagination a.active {
    background-color: #3B864F;
    color: white;
    border: 1px solid #3B864F;
  }
  .pagination a:hover:not(.active) {
    background-color: #34A853;
  }
</style>


@canany(['admin', 'servidor'])
  <div class="container" style="font-family: 'Roboto', sans-serif;">
    @if (session('sucesso'))
    <div class="alert alert-success">
      {{session('sucesso')}}
    </div>
    @endif
    <br>

    <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1><strong>Orientadores</strong></h1>
    <div style="margin: auto"></div>
    <form action="{{route("orientadors.index")}}" method="GET">
      <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor"
      style="background-color: #D9D9D9;
            border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            background-position: 10px 2px;
            background-repeat: no-repeat;
            width: 35%;
            font-size: 16px;
            height: 45px;
            border: 1px solid #ddd;
            margin-bottom: 12px; margin-right: 10px">

      <input type="submit" value=""
      style="background-image: url('/images/searchicon.png');
            background-color: #D9D9D9;
            border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            width: 40px;
            font-size: 16px;
            height: 45px;
            border: 1px solid #ddd;
            position: absolute;
            margin: auto;"
      />

    </form>
  </div>
  <div style="padding-bottom: 6px">
    <a style="background: #2D3875; border-radius: 20px; border: #2D3875; color: #f0f0f0;
    font-weight: 400; font-size: 24px; padding-top: 5px; padding-bottom: 5px; padding-right: 15px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none; padding-left: 10px;"
        href="{{route("orientadors.create")}}">
        <img src="{{asset("images/plus.png")}}" alt="Cadastrar orientador" style="padding-bottom: 5px"> Cadastrar Orientador
        </a>
    </div>



    @if (sizeof($orientadors) == 0)
      <div class="empty">
        <p>
          Não há orientadores cadastrados
        </p>
      </div>
    @else
    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
            min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    @foreach ($orientadors as $orientador)
                <tbody>
                        <tr>
                            <td>{{$orientador->user->name}}</td>
                            <td>{{$orientador->user->email}}</td>
                            <td>{{$orientador->cpf}}</td>
                            <td>{{$orientador->matricula}}</td>
                            <td>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$orientador->id}}">
                                <img src="{{asset("images/info.png")}}" alt="Info orientador" style="height: 30px; width: 30px;">
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$orientador->id}}">
                                <img src="{{asset("images/document.png")}}" alt="Documento orientador"  style="height: 30px; width: 30px;">
                                {{--  TODO: Fica pra fazer o modal depois  --}}
                                </a>
                                <a href="{{url("/orientadors/$orientador->id/edit")}}">
                                <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar orientador"  style="height: 30px; width: 30px;">
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$orientador->id}}">
                                <img src="{{asset("images/delete.png")}}" alt="Deletar orientador" style="height: 30px; width: 30px;">
                                </a>


                            </td>
                        </tr>
                        <tr>
                            {{--  nao apagar o tr  --}}
                        </tr>
                        @include("Orientador.components.modal_show", ["orientador" => $orientador])
                        @include("Orientador.components.modal_delete", ["orientador" => $orientador])
                        @endforeach
                </tbody>
            </table>
        </div>

        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                <div style="align-self: center; margin-right: auto">
                    <br>
                    <h4 style="font-size: 15px; font-weight: 600">Legenda dos ícones:</h4>
                </div>

          <div style="align-self: center; margin-right: auto">
            <div style="display: flex; margin: 10px">
              <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
            </div>
            <div style="display: flex; margin: 10px">
              <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
            </div>
            <div style="display: flex; margin: 10px">
              <a><img src="/images/document.png" alt="Documentos" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Documentos</p>
            </div>
          </div>
          <div style="align-self: center; margin-right: auto">
            <div style="display: flex; margin: 10px">
              <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
            </div>
            <div style="display: flex; margin: 10px">
              <a><img src="{{asset("images/delete.png")}}" alt="Deletar orientador" style="width: 20px; height: 20px;"></a>
              <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
            </div>
          </div>
        </div>
      </div>
      {{--  <div style="margin: auto; width: 45%; padding: 10px;">
        <div class="pagination">
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Anterior</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">1</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">2</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">3</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">4</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">...</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">15</a>
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Próximo</a>
        </div>
      </div>  --}}

  </div>
    @endif
  </div>

  <script type="text/javascript">
    function exibirModalEditar(id){
      $('#modal_edit_' + id).modal('show');
    }
    function exibirModalDeletar(id){
      $('#modal_delete_' + id).modal('show');
    }
    function exibirModalVisualizar(id){
      $('#modal_show_' + id).modal('show');
    }
  </script>

  <!-- Exibindo erros de validacao ao criar -->
 @if(count($errors->create) > 0)
  <script type="text/javascript">
    $(function () {
      // Bloqueando o usuario na tela de modal apos falha na validacao.
      // Forcando ele a clicar no botao de fechar, para limpar os erros
      $("#modal_create").modal({backdrop:"static", keyboard:false});
      $("#modal_create").modal('show');
    });
  </script>
  @endif

  <!-- Exibindo erros de validacao ao editar -->
  @if(count($errors->update) > 0)
  <script type="text/javascript">
    $(function () {
      // Bloqueando o usuario na tela de modal apos falha na validacao.
      // Forcando ele a clicar no botao de fechar, para limpar os erros
      $("#modal_edit_{{old( 'id' )}}").modal({backdrop:"static", keyboard:false});
      $("#modal_edit_{{old( 'id' )}}").modal('show');
    });
  </script>
  @endif

@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan
@endsection
