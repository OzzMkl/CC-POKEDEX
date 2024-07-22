<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $offset = $request->query('offset', 0);
        $limit = 10;
        $response = Http::get("https://pokeapi.co/api/v2/pokemon?offset={$offset}&limit={$limit}");
        $pokemonDataList = $response->json()['results'];
    
        $pokemonCollection = collect($pokemonDataList)->map(function ($pokemonData) {
            //Segunda consulta para los detalles
            $detailsResponse = Http::get($pokemonData['url']);
            $details = $detailsResponse->json();
    
            $pokemonData = array_merge($pokemonData, $details);
    
            return new Pokemon($pokemonData);
        });
    
        return view('pokemon', [
            'pokemonList' => $pokemonCollection,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function show($id)
    {
        try {
            $response = Http::get("https://pokeapi.co/api/v2/characteristic/{$id}");
    
            if ($response->successful()) {
                $pokemonDetails = $response->json();
                return response()->json($pokemonDetails);
            } else {
                return response()->json(['error' => 'Detalles del Pokémon no encontrados'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los detalles del Pokémon'], 500);
        }
    }
}
