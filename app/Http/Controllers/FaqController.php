<?php

// app/Http/Controllers/FaqController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Auth;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        // Création d'une nouvelle FAQ
        $faq = new Faq();
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->user_id = Auth::user()->id; // Si vous enregistrez l'utilisateur qui a créé la FAQ
        $faq->save();

        return redirect()
            ->route('faq.index')
            ->with('status', 'FAQ added');
    }
    // Autres méthodes pour l'édition et la suppression des FAQs

    public function edit(Faq $faq)
    {
        // Logique de récupération des données et affichage du formulaire d'édition
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        // Validation des données
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        // Mise à jour du FAQ
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->save();

        return redirect()
            ->route('faq.index')
            ->with('status', 'FAQ updated');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        // Vérifiez si l'utilisateur est autorisé à supprimer la FAQ
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Supprimez la FAQ de la base de données
        $faq->delete();

        return redirect()
            ->route('faq.index')
            ->with('status', 'FAQ deleted');
    }
}
