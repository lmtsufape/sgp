<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoUpdateFormRequest;
use App\Http\Requests\AlunoStoreFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function store(AlunoStoreFormRequest $request)
    {
        try {
            $aluno = new Aluno();
            $aluno->cpf = $request->cpf;
            $aluno->curso_id = $request->curso;
            $aluno->semestre_entrada = $request->semestre_entrada;
            // dd($request);
            if ($aluno->save()){
                if ( 
                    $aluno->user()->create([
                        'name' => $request->nome,
                        'name_social' => $request->nome_social == null ? "-": $request->nome_social,
                        'email' => $request->email,
                        'password' => Hash::make($request->senha)
                    ])->givePermissionTo('aluno')
                ){
                    
                    return redirect('/alunos')->with('sucesso', 'Aluno cadastrado com sucesso.');
    
                } else {
                    return redirect()->back()->withErrors( "Falha ao cadastrar aluno. tente novamente mais tarde." );
                }
            }
        } catch (Exception $e) {
                return redirect()->back()->withErrors("Falha ao cadastrar aluno. Tente novamente mais tarde.");
            }
    }

    // public function criar_aluno(Request $request)
    // {
    //     $validacao = $request->validate(
    //         [
    //             'nome' => ['required'],
    //             'cpf' => ['required'],
    //             'email' => ['required'],
    //             'semestre_entrada' => ['required'],
    //             'curso' => ['required'],
    //             'password' => ['required']
    //         ],
    //         [
    //             'required' => 'O campo :attribute é obrigatório.'
    //         ]
    //     );

    //     $aluno = Aluno::create([
    //         'cpf' => $request->input('cpf'),
    //         'curso' => $request->input('curso'),
    //         'semestre_entrada' => $request->input('semestre_entrada')
    //     ]);

    //     $aluno->user()->create([
    //         'name' => $request->input('nome'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password'))
    //     ])->givePermissionTo('aluno');

    //     return redirect(url("/login"));
    // }

    public function update(AlunoUpdateFormRequest $request, $id)
    {
        $aluno = Aluno::find($id);

        $aluno->cpf = $request->cpf == $aluno->cpf ? $aluno->cpf : $request->cpf;
        $aluno->semestre_entrada = $request->semestre_entrada;
        $aluno->curso_id = $request->curso;

        $aluno->user->name = $request->nome;
        $aluno->user->email = $request->email;
        if ($request->senha && $request->senha != null){
            if (strlen($request->senha) > 3 && strlen($request->senha) < 9){
                $aluno->user->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withErrors( "Senha deve ter entre 4 e 8 dígitos" );
            }
        }

        if ($aluno->save()){
            
            if ($aluno->user->update()){
                return redirect('/alunos')->with('sucesso', 'Aluno atualizado com sucesso.');
            } else {
                return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
            }

        } else {
            return redirect()->back()->withErrors( "Falha ao cadastrar orientador. tente novamente mais tarde." );
        }
    }

    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.delete', ['aluno' => $aluno]);
    }

    public function destroy(Request $request)
    {
        $id = $request->only(['id']);
        $aluno = Aluno::findOrFail($id)->first();

        if ($aluno->user->delete() && $aluno->delete()) {
            return redirect(route("alunos.index"));
        }
    }

    public function index(Request $request)
    {
        $alunos = Aluno::with('user')->get();
        //dd($alunos);
        return view("Alunos.index", compact("alunos"));
    }

    public function edit($id){
        $aluno = Aluno::find($id);
        $cursos = Curso::all();
        return view("Alunos.editar-aluno", compact('aluno', 'cursos'));
    }

    public function create(){
        $cursos = Curso::all();
        return view("Alunos.cadastro-aluno", compact('cursos'));
    }

}
