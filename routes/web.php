<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.index');
})->middleware('auth');

Auth::routes();

Route::group(['prefix' => 'admin'], function() {
    Route::get('usuario/list', ['uses' => 'UserController@getAllUsers', 'as' => 'admin.usuario.listUser']);
    Route::get('usuario/create', ['uses' => 'UserController@createUsers', 'as' => 'admin.usuario.createUser']);
    Route::get('usuario/{id}/edit', ['uses' => 'UserController@editUsers', 'as' => 'admin.usuario.editUser']);
    Route::post('usuario/{id}/edit', ['uses' => 'UserController@updateUsers', 'as' => 'admin.usuario.updateUser']);
    Route::post('usuario/create', ['uses' => 'UserController@incluirUsers', 'as' => 'admin.usuario.saveUser']);
    Route::get('usuario/{id}/delete', ['uses' => 'UserController@deleteUsers', 'as' => 'admin.usuario.deleteUser']); 
    
});

Route::group(['prefix' => 'processo'], function() {
    Route::get('', ['uses' => 'ProcessoController@listarProcessos', 'as' => 'usuario.listarProcessos']);
    
});

Route::group(['prefix' => 'usuario'], function() {
    Route::get('{id}', ['uses' => 'UserController@meusDados', 'as' => 'usuario.meusDados']);
    
});

Route::group(['prefix' => 'login'], function() {
    Route::get('reset', ['uses' => 'Auth\ForgotPasswordController@showFormResetSenha', 'as' => 'login.showFormResetSenha']);
    Route::post('reset', ['uses' => 'Auth\ForgotPasswordController@resetSenha', 'as' => 'login.resetSenha']);
});

Route::group(['prefix' => 'logout'], function() {
    Route::get('public/logout', 'HomeController@logout');
});

Route::group(['prefix' => 'Upag'], function() {
    Route::get('pendentes', ['uses' => 'ProcessoController@resumoPendenciasUpag', 'as' => 'processoUpag.resumoPendencias']);
    Route::get('create', ['uses' => 'ProcessoController@create', 'as' => 'processoUpag.create']);
    Route::post('create', ['uses' => 'ProcessoController@solicitarReversaoASDPP', 'as' => 'processoUpag.solicitarReversaoASDPP']);
    Route::get('processo/{id}/processo', ['uses' => 'ProcessoController@downloadProcesso', 'as' => 'processoUpag.downloadProcesso']);
    Route::get('processo/{id}/oficio', ['uses' => 'ProcessoController@downloadOficio', 'as' => 'processoUpag.downloadOficio']);
    Route::get('processo/{id}/oficio_reiteracao', ['uses' => 'ProcessoController@downloadOficioReiteracao', 'as' => 'processoUpag.downloadOficioReiteracao']);
    Route::get('processo/{id}/obito', ['uses' => 'ProcessoController@downloadObito', 'as' => 'processoUpag.downloadObito']);
    Route::get('processo/{id}/contracheque', ['uses' => 'ProcessoController@downloadContracheque', 'as' => 'processoUpag.downloadContracheque']);
    Route::get('processo/{id}/resposta', ['uses' => 'ProcessoController@downloadResposta', 'as' => 'processoUpag.downloadResposta']);
    Route::get('devolvidos', ['uses' => 'ProcessoController@listarDevolvidosSdpp', 'as' => 'processoUpag.listarDevolvidos']);
    Route::get('finalizado', ['uses' => 'ProcessoController@listarFinalizadoSdpp', 'as' => 'processoUpag.finalizadoSdpp']);
    Route::get('finalizadoUpag', ['uses' => 'ProcessoController@listarFinalizadoUpag', 'as' => 'processoUpag.finalizadoUpag']);
    Route::get('processo/{ID}/atualizar', ['uses' => 'ProcessoController@mostrarProcessoFinalizado', 'as' => 'processoUpag.mostraProcessoFinalizado']);
    Route::post('processo/{ID}/atualizar', ['uses' => 'ProcessoController@atualizarProcessoFinalizado', 'as' => 'processoUpag.atualizaProcessoFinalizado']);
    
});

Route::group(['prefix' => 'Sdpp'], function() {
    Route::get('dashboard', ['uses' => 'DashboardController@alimentaDashboard', 'as' => 'dashboard.alimentaDashboard']);
    Route::get('atrasados', ['uses' => 'ProcessoController@listarAtrasadosSdpp', 'as' => 'processoSdpp.atrasadosSdpp']);
    Route::get('concluidos', ['uses' => 'ProcessoController@listarConcluidosSdpp', 'as' => 'processoSdpp.concluidosSdpp']);
    Route::get('devolvidos', ['uses' => 'ProcessoController@listarDevolvidosSdpp', 'as' => 'processoSdpp.devolvidosSdpp']);
    Route::get('enviados', ['uses' => 'ProcessoController@listarEnviadosSdpp', 'as' => 'processoSdpp.enviadosSdpp']);
    Route::get('iniciados', ['uses' => 'ProcessoController@listarIniciadosSdpp', 'as' => 'processoSdpp.iniciadosSdpp']);
    Route::get('pendentes', ['uses' => 'ProcessoController@resumoPendenciasSdpp', 'as' => 'processoSdpp.resumoPendencias']);
    Route::get('processo/{ID}/autorizar', ['uses' => 'ProcessoController@autorizarProcesso', 'as' => 'processoSdpp.autorizarProcesso']);
    Route::post('processo/{ID}/autorizar', ['uses' => 'ProcessoController@solicitarReversaoAoBanco', 'as' => 'processoUpag.solicitarReversaoAoBanco']);
    Route::get('processo/{ID}/detalhar', ['uses' => 'ProcessoController@detalharProcesso', 'as' => 'processoSdpp.detalharProcesso']);
    Route::get('processo/{ID}/detalharExcluido', ['uses' => 'ProcessoController@detalharProcessoExcluido', 'as' => 'processoSdpp.detalharProcessoExcluido']);
    Route::get('processo/{ID}/analisar', ['uses' => 'ProcessoController@mostraProcessoParaAnalise', 'as' => 'processoSdpp.mostraProcessoParaAnalise']);
    Route::post('processo/{ID}/analisar', ['uses' => 'ProcessoController@analisarProcesso', 'as' => 'processoSdpp.analisarProcesso']);
    Route::get('processo/{ID}/retornar', ['uses' => 'ProcessoController@mostrarProcesso', 'as' => 'processoSdpp.retornarProcesso']);
    Route::post('processo/{ID}/retornar', ['uses' => 'ProcessoController@retornarProcesso', 'as' => 'processoSdpp.retornarProcesso']);
    Route::get('reiterados', ['uses' => 'ProcessoController@listarReiteradosSdpp', 'as' => 'processoSdpp.listarReiteradosSdpp']);
    Route::get('processo/{id}/reiterar', ['uses' => 'ProcessoController@reiterarProcesso', 'as' => 'processoSdpp.reiterarProcesso']);
    Route::post('processo/{ID}/reiterar', ['uses' => 'ProcessoController@reiteraProcesso', 'as' => 'processoUpag.reiteraProcesso']);
    Route::post('processo/{ID}/detalhar', ['uses' => 'ProcessoController@excluirProcesso', 'as' => 'processoUpag.excluirProcesso']);
    Route::get('', ['uses' => 'ProcessoController@listarExcluidos', 'as' => 'processoSdpp.listarExcluidos']);
});
Route::group(['prefix' => 'relatorio'], function() {
    Route::get('SDPP', ['uses' => 'RelatoriosController@opcoesSDPP', 'as' => 'relatorios.opcoesSDPP']);
    Route::get('upag', ['uses' => 'RelatoriosController@opcoesUpag', 'as' => 'relatorios.opcoesUpag']);
    Route::get('relatorio_analitico_sdpp_unidade', ['uses' => 'RelatoriosController@listarRelatoriosSdppPorUnidade', 'as' => 'relatorios.analiticoSdppPorUnidade']);
    Route::get('relatorio_analitico_sdpp_banco', ['uses' => 'RelatoriosController@listarRelatoriosSdppPorBanco', 'as' => 'relatorios.analiticoSdppPorBanco']);
    Route::get('relatorio_analitico_upag', ['uses' => 'RelatoriosController@listarAnaliticoUnidade', 'as' => 'relatorios.analiticoUnidade']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','UserController@getAllUsers')->name('admin');
