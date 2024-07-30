<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('Veterinaire');
    }

    // public function broadcast(Request $request)
    // {
    //     // broadcast(new PusherBroadcast($request->get( key: 'message')))->toOthers();

    //     // return view('broadcast', ['message' => $request->get(key:'message')]);
    //     $message = $request->get('message');
    //     $veterinaireId = $request->get('veterinaire_id');

    //     // Diffuser l'événement de message
    //     broadcast(new PusherBroadcast($message, $veterinaireId))->toOthers();

    //     return response()->json(['message' => $message]);
    // }

    public function broadcast(Request $request)
    {
    $message = $request->get('message');
    $veterinaireId = $request->get('veterinaire_id');
    // Diffuser l'événement de message
    broadcast(new PusherBroadcast($message, $veterinaireId))->toOthers();
    return response()->json(['message' => $message]);
    }

    public function receive(Request $request)
    {
        // return view('receive', ['message' => $request->get(key:'message')]);
        $message = $request->get('message');
        // Retourner la vue partielle du message reçu
        $formattedMessage = view('receive', ['message' => $message])->render();
        return response()->json($formattedMessage);
    }
}
