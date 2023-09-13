<?php

namespace App\Http\Controllers;

use App\Http\Requests\GravarUsuario;
use App\User;
use App\Models\Unidade;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Processo;

class UserController extends Controller
{
    public function getAllUsers(){
        $listaDeUsuarios = User::orderBy('ID', 'desc')
                            ->where('ST_EXCLUIDO', 'N')->get();
        return view('admin.list', compact('listaDeUsuarios'));
    }

    public function createUsers(){
        $perfis = Perfil::where('ST_EXCLUIDO', 'N')->get();
        $unidades = Unidade::all();
        return view('admin.create', compact('perfis','unidades'));
    }

    public function incluirUsers(GravarUsuario $request, User $modelUsuario){
        if($modelUsuario->incluir($request)){
            return redirect()
                        ->route('admin.usuario.listUser')
                        ->with('success', 'Usuário cadastrado com sucesso.');               
        }else{
            return redirect()
                        ->route('admin.usuario.listUser')
                        ->with('error', 'Usuário não cadastrado.');
            }        
    }
    public function editUsers($id){
        $usuario = User::find($id);
        $perfis = Perfil::where('ST_EXCLUIDO', 'N')->orderBy('SIGLA', 'desc')->get();
        $unidades = Unidade::all();
        return view('admin.edit', compact('usuario', 'unidades','perfis'));
    }
    
    public function updateUsers($id, User $modelUsuario, GravarUsuario $request){
        if ($modelUsuario->excluir($id)) {
            if ($modelUsuario->incluir($request)) {
                return redirect()
                                ->route('admin.usuario.listUser')
                                ->with('success', 'Usuário atualizado com sucesso.');
                }
            }
        }

    public function deleteUsers($id, User $modelUsuario){
        if ($modelUsuario->excluir($id)) {
                return redirect()
                                ->route('admin.usuario.listUser')
                                ->with('success', 'Usuário excluido com sucesso.');
                }
            }
    
    public function meusDados($id) {
        if (Auth::user()->ID == $id) {
            $usuario = User::with(['unidade', 'perfil'])
                    ->where('ID', '=', $id)
                    ->first();
            return view('usuario.meusDados', compact('usuario'));
        } else {
            $usuario = User::with(['unidade', 'perfil'])
                    ->where('ID', '=', Auth::user()->ID)
                    ->first();
            return view('usuario.meusDados', compact('usuario'))->withErrors('Não é possível acessar o perfil de outro usuário.');
        }
    }


}