<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;        
use App\Http\Requests;
use App\Http\Requests\CadastroRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        if (Auth::user()->email === 'adm@gmail.com') {
            $usuario = Usuario::all();
            $usuarioCount = Usuario::count();
            $usuarioAtivo = Usuario::where('status', 'Ativo')->count();
        } else {
            $usuario = Usuario::where('id', Auth::id())->get();
            $usuarioCount = $usuario->count();
            $usuarioAtivo = $usuario->where('status', 'Ativo')->count();
        }

        return view('usuario', compact('usuario', 'usuarioCount', 'usuarioAtivo'));
    }

    public function create()
    {
        return view('insertUsuario');
    }

    public function insert(CadastroRequest $request)
    {
        $usuario = new Usuario();

        $usuario->nome = $request->txNome;
        $usuario->email = $request->txEmail;
        $usuario->senha = Hash::make($request->txSenha);
        $usuario->status = 'Ativo';
        $usuario->quantiaProjetos = 0;
        $usuario->created_at = date('Y-m-d H:i:s');
        $usuario->updated_at = date('Y-m-d H:i:s');

        $usuario->save();
        Auth::login($usuario);

        return redirect('/');
    }
    public function desativar(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->status = "Inativo";

        $usuario->save();
        return redirect('/usuario');
    }
    public function ativar(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->status = "Ativo";

        $usuario->save();
        return redirect('/usuario');
    }
    public function editar(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->nome = $request->txNome;
        $usuario->email = $request->txEmail;


        $usuario->save();

        return redirect('/usuario');
    }
    public function excluir(string $id)
    {
        Usuario::where('id', '=', $id)->where('quantiaProjetos', '=', 0)->delete();

        return redirect('/usuario');
    }

    //login
    public function fazerLogin(LoginRequest $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ])->withInput($request->only('email'));
    }


    //logout
    public function fazerLogOut(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    //API

    public function indexAPI()
    {
        $usuario = Usuario::all();

        return $usuario;
    }
    //Listar o id de um usuario específico
    public function listarIDAPI(string $nome)
    {
        $usuario = Usuario::select('usuario.id')
            ->where('usuario.nome', 'LIKE', "%{$nome}%")
            ->get();

        return $usuario;
    }

    public function insertAPI(Request $request)
    {
        $usuario = new Usuario();

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->status = 'Ativo';
        $usuario->quantiaProjetos = 0;

        $usuario->save();

        return response()->json($usuario, 201);
    }
    public function excluirAPI(string $id)
    {
        $deletado = Usuario::where('id', '=', $id)->where('quantiaProjetos', '=', 0)->delete();

        if ($deletado > 0) {
            return response()->json([
                'message' => 'Usuário excluído com sucesso',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'Message' => 'Não é possível excluir um usuário com projetos vinculados!'
            ]);
        }
    }
    public function atualizarAPI(Request $request, string $id)
    {
        $validarDados = $request->validate([
            'nome' => 'min:3',
            'email' => 'max:200',
        ]);
        $usuario = Usuario::findOrFail($id);

        $usuario->update($validarDados);

        return response()->json($usuario, 201);
    }
    public function desativarAPI(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->status = "Inativo";

        $usuario->save();
        return response()->json($usuario, 201);
    }
    public function ativarAPI(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->status = "Ativo";

        $usuario->save();
        return response()->json($usuario, 201);
    }
}
