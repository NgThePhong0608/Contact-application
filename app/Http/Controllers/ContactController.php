<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Scopes\SimpleSoftDeleteScope;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public function __construct(protected CompanyRepository $company)
    {
    }

    public function index()
    {
        $companies = $this->company->pluck();
        $contacts = Contact::allowedTrashed()
            ->allowedSorts(['first_name', 'last_name', 'email'], '-id')
            ->allowedFilters('company_id')
            ->allowedSearch('first_name', 'last_name', 'phone', 'email', 'address')
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
        $companies = $this->company->pluck();
        return view('contacts.create', ['companies' => $companies, 'contact' => $contact]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:30|string',
            'last_name' => 'required|max:30|string',
            'email' => 'required|max:30|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ]);
        Contact::create($request->all());
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been added successfully');
    }

    public function edit(Contact $contact)
    {
        $companies = $this->company->pluck();
        return view('contacts.edit', ['contact' => $contact, 'companies' => $companies]);
    }


    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required|max:30|string',
            'last_name' => 'required|max:30|string',
            'email' => 'required|max:30|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ]);
        $contact->update($request->all());
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect) : back())
            ->with('message', 'Contact has been moved to trash')
            ->with('undoRoute', $this->getUndoRoute('admin.contacts.restore', $contact));
    }

    public function restore(Contact $contact)
    {
        $contact->restore();
        return back()
            ->with('message', 'Contact has restored from trash')
            ->with('undoRoute', $this->getUndoRoute('admin.contacts.destroy', $contact));
    }

    protected function getUndoRoute($name, $resource)
    {
        return request()->missing('undo') ? route($name, [$resource->id, 'undo' => true]) : null;
    }

    public function forceDelete(Contact $contact)
    {
        $contact->forceDelete();
        return back()
            ->with('message', 'Contact has been removed permanently');
    }
}
