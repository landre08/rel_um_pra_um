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

use App\Cliente;
use App\Endereco;

Route::get('/clientes', function () {
    $clientes = Cliente::all();

    foreach($clientes as $c) {
        echo "<p> Id: ".$c->id."</p>";
        echo "<p> Nome: ".$c->name."</p>";
        echo "<p> Telefone: ".$c->telefone."</p>";
       //  $e = Endereco::where('cliente_id', $c->id)->first();
        echo "<p> Rua: ".$c->endereco->rua."</p>";
        echo "<p> Número: ".$c->endereco->numero."</p>";
        echo "<p> Bairro: ".$c->endereco->bairro."</p>";
        echo "<p> Cidade: ".$c->endereco->cidade."</p>";
        echo "<p> UF: ".$c->endereco->uf."</p>";
        echo "<p> CEP: ".$c->endereco->cep."</p>";
        echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $ends = Endereco::all();

    foreach($ends as $e) {
        echo "<p> Id: ".$e->cliente_id."</p>";
        echo "<p> Nome do cliente: ".$e->cliente->name."</p>";
        echo "<p> Telefone do cliente: ".$e->cliente->telefone."</p>";
        echo "<p> Rua: ".$e->rua."</p>";
        echo "<p> Número: ".$e->numero."</p>";
        echo "<p> Bairro: ".$e->bairro."</p>";
        echo "<p> Cidade: ".$e->cidade."</p>";
        echo "<p> UF: ".$e->uf."</p>";
        echo "<p> CEP: ".$e->cep."</p>";
        echo "<hr>";
    }
});

Route::get('/inserir', function() {
    $c = new Cliente;
    $c->name = "Manuela Pedrosa";
    $c->telefone = 2197874589;
    $c->save();

    $e = new Endereco;
    $e->rua = "Rua Itaigara";
    $e->numero = 221;
    $e->cidade = "Rio de Janeiro";
    $e->bairro = "Coelho Neto";
    $e->uf = "RJ";
    $e->cep = "";

    // $e->cliente_id = $c->id;
    $e->endereco()->save($e);

});

// Para hasOne
Route::get('/clientes/json', function() {

    // Lazy Loading - Carregamento preguiçoso. Não vem o relacionamento endereço.
    // $clientes = Cliente::all();

    // Eager Loading -Carregamento antecipado. Esse vem o relacionamento endereço.
    $clientes = Cliente::with(['endereco'])->get();

    return $clientes->toJson();
});

// Para belongTo
Route::get('/enderecos/json', function() {

    // $enderecos = Endereco::all();
    $enderecos = Endereco::with(['cliente'])->get();

    return $enderecos->toJson();
});