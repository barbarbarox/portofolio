<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessageController extends Controller {
    public function index() {
        $messages = Contact::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Contact $contact) {
        $contact->update(['is_read' => true]);
        return view('admin.messages.show', compact('contact'));
    }

    public function destroy(Contact $contact) {
        $contact->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan dihapus.');
    }
}
