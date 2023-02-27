@canany(['admin', 'servidor'])
  <div class="modal fade " id="modal_show_{{$curso->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
      <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
        <div class="modal-header" >
            <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;" class="modal-title title fw-bold">Informações do Curso</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="overflow: auto">
          <div class="mb-3">
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Curso:</label>
            <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">{{$curso->nome}} </div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Disciplinas:</label>
            <div  style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">

              @foreach ($curso->curso_disciplinas as $curso_disciplinas)
                  @foreach ($disciplinas as $disciplina)
                      @if ($curso_disciplinas->id_disciplina == $disciplina->id)
                          <label>{{$disciplina->nome}}</label><br>
                          @break
                      @endif
                  @endforeach
              @endforeach
                      
            </div>
                      
          </div>
          <div class="modal-footer">
                <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>

    </div>
  </div>
  <style>
    .btn-secondary{
      color: #fff;
      background-color: #2d3875;
      border-color: #2d3875;
    }
    .btn-secondary:hover{
      background-color: #4353ab;
      border-color: #4353ab;
    }
  </style>
@else
  <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
  <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{url("/login")}}">Voltar</a>
@endcan