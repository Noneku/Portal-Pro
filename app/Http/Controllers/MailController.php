<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{

    public function index()
    {
        $mails = Mail::where('user_id', Auth::id())->get();
        return response()->json($mails);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'from_email' => 'required|email',
            'to_email' => 'required|email',
        ]);

        $mail = Mail::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'from_email' => $validated['from_email'],
            'to_email' => $validated['to_email'],
        ]);

        return response()->json($mail, 201);
    }

    public function show(string $id)
    {
        $mail = Mail::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($mail);
    }

    public function update(Request $request, string $id)
    {
        $mail = Mail::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'subject' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'from_email' => 'sometimes|email',
            'to_email' => 'sometimes|email',
        ]);

        $mail->update($validated);

        return response()->json($mail);
    }

    public function destroy(string $id)
    {
        $mail = Mail::where('user_id', Auth::id())->findOrFail($id);
        $mail->delete();

        return response()->json(['message' => 'Mail supprimé avec succès']);
    }
}
