<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Scopes\SimpleSoftDeleteScope;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    protected function userCompanies()
    {
        return Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');
    }

    public function index()
    {
        $companies = $this->userCompanies();
        $contacts = Contact::allowedTrashed()
            ->allowedSorts(['first_name', 'last_name', 'email'], '-id')
            ->allowedFilters('company_id')
            ->allowedSearch('first_name', 'last_name', 'phone', 'email', 'address')
            ->forUser(auth()->user())
            ->with('company')
            ->paginate(10);
        return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);
    }


    public function show(Contact $contact)
    {
        // route binding
        return view('contacts.show')->with('contact', $contact);
    }

    public function create()
    {
        $contact = new Contact();
        $companies = $this->userCompanies();
        return view('contacts.create', ['companies' => $companies, 'contact' => $contact]);
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->all());
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been added successfully');
    }


    public function edit(Contact $contact)
    {
        $companies = $this->userCompanies();
        return view('contacts.edit', ['contact' => $contact, 'companies' => $companies]);
    }


    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect) : back())
            ->with('message', 'Contact has been moved to trash')
            ->with('undoRoute', getUndoRoute('admin.contacts.restore', $contact));
    }

    public function restore(Contact $contact)
    {
        $contact->restore();
        return back()
            ->with('message', 'Contact has restored from trash')
            ->with('undoRoute', getUndoRoute('admin.contacts.destroy', $contact));
    }


    public function forceDelete(Contact $contact)
    {
        $contact->forceDelete();
        return back()
            ->with('message', 'Contact has been removed permanently');
    }
}
