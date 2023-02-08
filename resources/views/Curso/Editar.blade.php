@extends("templates.app")

@section("body")
<style>
    select[multiple] {
        overflow: hidden;
        background: #f5f5f5;
        width:100%;
        height:auto;
        padding: 0px 5px;
        margin:0;
        border-width: 2px;
        border-radius: 5px;
        -moz-appearance: menulist;
        -webkit-appearance: menulist;
        appearance: menulist;
    }
    .required .chosen-single {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }
    /* select multiple */
    .required .chosen-choices {
        background: #F5F5F5;
        border-radius: 5px;
        border: 1px #D3D3D3;
        padding: 0px 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }

    .titulo {
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        display: flex;
        color: #131833;
    }
    .boxinfo{
        background: #F5F5F5;
        border-radius: 6px;
        border: 1px #D3D3D3;
        width: 100%;
        padding: 5px;
        box-shadow: inset 0px 3px 6px rgba(0, 0, 0, 0.25);
    }
    .boxchild{
        background: #FFFFFF;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.25);
        border-radius: 20px;
        padding: 34px;
        width: 65%
    }

</style>

<div class="container" style="display: flex; justify-content: center; align-items: center; margin-top: 1em; margin-bottom:10px; ">
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{session('sucesso')}}
        </div>
    @endif
    <br>

    <div class="boxchild">
        <div class="row">
            <h1 style="font-weight: 600; font-size: 30px; line-height: 47px; display: flex; align-items: center; color: #131833;">
                Editar Curso</h1>
        </div>

        <hr>

        <form action="{{url("/cursos/$curso->id")}}"method="post">
            @csrf
            @method("put")

            <label for="nome" class="titulo">Nome:</label>
            <input class="boxinfo" type="text" name="nome" id="nome" placeholder="Digite o nome do curso" value="{{$curso->nome}}">

            <label class="titulo" for="disciplinas">Disciplinas:</label>
            <select aria-label="Default select example" class="boxinfo" name="disciplinas[]" id="disciplinas" multiple>
                <option value=""></option>
                @foreach ($disciplinas as $disciplina)
                <option value="{{$disciplina->id}}" {{in_array($disciplina->id, $idsDisciplinasDoCurso) ? 'selected' : ''}}>{{$disciplina->nome}}</option>
                @endforeach
            </select><br><br>
            
            <div style="display: flex; align-content: center; align-items: center; justify-content: center; gap:5%">
                <input type="button" value="Voltar" href="{{url("/cursos/")}}" onclick="window.location.href='{{url("/cursos/")}}'" style="background: #2D3875;
                                box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25); display: inline-block;
                                border-radius: 13px; color: #FFFFFF; border: #2D3875; font-style: normal; font-weight: 400; font-size: 24px;
                                line-height: 29px; text-align: center; padding: 5px 15px;">
                <input type="submit" value="Salvar" style="background: #34A853; box-shadow: 4px 5px 7px rgba(0, 0, 0, 0.25);
                    display: inline-block; border-radius: 13px; color: #FFFFFF; border: #34A853; font-style: normal;
                    font-weight: 400; font-size: 24px; line-height: 29px; text-align: center; padding: 5px 15px;">
            </div>


        </form>

    </div>
</div>
<script>
        $("#disciplinas").chosen({
                placeholder_text_multiple: "Selecione uma disciplina",
                // max_shown_results : 5,
                no_results_text: "Não possui disciplinas."
            });

            $('div.chosen-container-single').addClass('required');
            $('div.chosen-container-multi').addClass('required');
    </script>

@endsection