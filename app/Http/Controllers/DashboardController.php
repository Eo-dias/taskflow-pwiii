<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Gráfico 1 - tarefas por status
        $tarefasPorStatus = DB::table('tarefa')
            ->select('status', DB::raw('COUNT(*) as quantidade'))
            ->groupBy('status')
            ->get();

        // Gráfico 2 - projetos por usuário
        $projetosPorUsuario = DB::table('usuario')
            ->leftJoin('projeto', 'usuario.id', '=', 'projeto.usuario_id')
            ->select(
                'usuario.nome',
                DB::raw('COUNT(projeto.id) as quantidade')
            )
            ->groupBy('usuario.id', 'usuario.nome')
            ->get();

        // Gráfico 3 - tarefas por projeto
        $tarefasPorProjeto = DB::table('projeto')
            ->select('nome', 'quantiaTarefas')
            ->get();

        // Gráfico 4 - projetos x tarefas por usuário
        $projetosETarefasPorUsuario = DB::table('usuario')
            ->leftJoin('projeto', 'usuario.id', '=', 'projeto.usuario_id')
            ->leftJoin('tarefa', 'projeto.id', '=', 'tarefa.projeto_id')
            ->select(
                'usuario.nome',
                DB::raw('COUNT(DISTINCT projeto.id) as projetos'),
                DB::raw('COUNT(tarefa.id) as tarefas')
            )
            ->groupBy('usuario.id', 'usuario.nome')
            ->get();

        // Dados para a dashboard
        return view('dashboard', compact(
            'tarefasPorStatus',
            'projetosPorUsuario',
            'tarefasPorProjeto',
            'projetosETarefasPorUsuario'
        ));
    }
}