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

    public function broadcast(Request $request)
    {
    $message = $request->get('message');
    $veterinaireId = $request->get('veterinaire_id');
    broadcast(new PusherBroadcast($message, $veterinaireId))->toOthers();
    return response()->json(['message' => $message]);
    }

    public function receive(Request $request)
    {
        $message = $request->get('message');
        $formattedMessage = view('receive', ['message' => $message])->render();
        return response()->json($formattedMessage);
    }
}
