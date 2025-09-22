<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client; // Importa la clase aquí
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use App\Services\GoogleService;

class ContactoController extends Controller
{
    public function enviarMensaje(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Verificar que el token de Google está configurado
    if (!session('google_token')) {
        return redirect('/auth/google')->with('error', 'Por favor autentica tu cuenta de Google primero.');
    }

    // Configurar el cliente de Google
    $client = GoogleService::getClient();
    $client->setAccessToken(session('google_token'));

    $service = new Google_Service_Gmail($client);

    // Crear el mensaje usando los datos del formulario
    $mimeMessage = "From: {$request->email}\r\n";
    $mimeMessage .= "To: utodomotor@gmail.com\r\n";
    $mimeMessage .= "Subject: Mensaje de contacto de {$request->name}\r\n";
    $mimeMessage .= "\r\n";
    $mimeMessage .= "{$request->message}\r\n";
    $mimeMessage .= "{$request->email}";


    $message = new Google_Service_Gmail_Message();
    $message->setRaw(base64_encode($mimeMessage));

    // Enviar el mensaje
    try {
        $service->users_messages->send('me', $message);
        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    } catch (Exception $e) {
        return back()->with('error', 'Error al enviar el mensaje: ' . $e->getMessage());
    }
}


    public function autenticarUsuario()
{
    $client = new \Google_Client();
    $client->setAuthConfig(env('GOOGLE_CREDENTIALS_PATH'));
    $client->addScope(\Google_Service_Gmail::GMAIL_SEND);
    $client->setRedirectUri(route('oauth.callback')); // La ruta de redirección debe coincidir con la configurada en Google Console

    // Redirigir al usuario a la página de autenticación de Google
    return redirect($client->createAuthUrl());
}


public function callback(Request $request)
{
    $client = new \Google_Client();
    $client->setAuthConfig(env('GOOGLE_CREDENTIALS_PATH'));
    $client->addScope(\Google_Service_Gmail::GMAIL_SEND);
    $client->setRedirectUri(route('oauth.callback'));

    // Verifica si hay un código en la solicitud
    if ($request->query('code')) {
        $token = $client->fetchAccessTokenWithAuthCode($request->query('code'));
        session(['google_token' => $token]);
        return redirect('/')->with('success', 'Autenticación exitosa');
    }

    return redirect('/')->with('error', 'No se pudo autenticar');
}

}
