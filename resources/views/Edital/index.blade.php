@extends("templates.app")

@section("body")
@canany(['admin', 'servidor'])
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

  <div class="container" style="font-family: 'Roboto', sans-serif;">
          @if (session('sucesso'))
              <div class="alert alert-success">
                  {{session('sucesso')}}
              </div>
          @endif
    <br>

      <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
          <h1><strong>Editais</strong></h1>
          <div style="margin: auto"></div>
          <form action="{{route("editals.index")}}" method="GET">
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

      <div style="display: contents; align-content: center; align-items: center;">

          <a style="background: #2D3875; border-radius: 25px; border: #2D3875; color: #f0f0f0; font-style: normal;
          font-weight: 400; font-size: 24px; line-height: 28px; padding-top: 6px; padding-bottom: 6px; align-content: center;
          align-items: center; padding-right: 15px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none;
          padding-left: 10px;"
          href="{{route("editals.create")}}">
          <img src="{{asset("images/plus.png")}}" alt="Cadastrar edital" style="padding-bottom: 5px"> Cadastrar Edital
          </a>
          <br>
      </div>
    <div style="padding-bottom: 6px">
        <a style="background: #2D3875; border-radius: 20px; border: #2D3875; color: #f0f0f0;
        font-weight: 400; font-size: 24px; padding-top: 5px; padding-bottom: 6px; padding-right: 15px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); text-decoration: none; padding-left: 10px;"
        href="{{route("editals.create")}}">
        <img src="{{asset("images/plus.png")}}" alt="Cadastrar edital" style="padding-bottom: 5px"> Cadastrar Edital
        </a>
    </div>

      <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
          <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
          min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
              <thead>
                  <tr>
                      <th scope="col">Data de início</th>
                      <th scope="col">Data de fim</th>
                      <th scope="col">Programa</th>
                      <th scope="col">Ações</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($editals as $edital)
                      <tr>
                          <td class="align-middle">{{date_format(date_create($edital->data_inicio), "d/m/Y")}}</td class="align-middle">
                          <td class="align-middle">{{date_format(date_create($edital->data_fim), "d/m/Y")}}</td class="align-middle">
                          <td class="align-middle">{{$edital->programa->nome}}</td class="align-middle">
                          <td class="align-middle">
                              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show_{{$edital->id}}">
                              <img src="{{asset("images/info.png")}}" alt="Info edital" style="height: 30px; width: 30px;">
                              </a>
                              <a href="{{url("/editals/$edital->id/edit")}}">
                              <img src="{{asset("images/edit-outline-blue.png")}}" alt="Editar edital"  style="height: 30px; width: 30px;">
                              </a>
                              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_delete_{{$edital->id}}">
                              <img src="{{asset("images/delete.png")}}" alt="Deletar edital" style="height: 30px; width: 30px;">
                              </a>


                          </td>
                      </tr>
                      <tr>
                          {{--  Não apagar esse tr  --}}
                      </tr>

                      @include("Edital.components.modal_show", ["edital" => $edital, "orientadores" => $orientadores])
                      @include("Edital.components.modal_delete", ["edital" => $edital])

                  @endforeach
              </tbody>
          </table>
        </div>

        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                <div style="align-self: center; margin-right: auto">
                    <br>
                    <h4 style="font-size: 15px">Legenda dos ícones:</h4>
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
  </div>

      <script type="text/javascript">
          function exibirModalDeletar(id){
            $('#modal_delete_' + id).modal('show');
          }
          function exibirModalVisualizar(id){
            $('#modal_show_' + id).modal('show');
          }
        </script>
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan

@endsection
