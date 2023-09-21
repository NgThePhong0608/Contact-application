<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public function __construct(protected CompanyRepository $company)
    {
        // $this->company = $company;
    }

    public function index(Request $request)
    {
        $companies = $this->company->pluck();
        /* if (!request()->query('company_id')) {
            $contacts = Contact::latest()->paginate(10);
        } else {
            $contacts = Contact::latest()->where('company_id', request()->query('company_id'))->paginate(10);
        } */
//        DB::enableQueryLog();
        $contacts = Contact::latest()->where(function ($query) {
            $companyId = request()->query('company_id');

            if ($companyId) {
                $query->where('company_id', $companyId);
            }

        })->where(function ($query) {
            $search_value = trim(request()->query('search'));
//            dd($search_value);
            if ($search_value) {
                $query->where('first_name', 'LIKE', "%{$search_value}%")
                    ->orWhere('last_name', 'LIKE', "%{$search_value}%")
                    ->orWhere('address', 'LIKE', "%{$search_value}%")
                    ->orWhere('email', 'LIKE', "%{$search_value}%")
                    ->orWhere('phone', 'LIKE', "%{$search_value}%");
            }
        })->paginate(10);
//        dump(DB::getQueryLog());

        /* $contactsCollection = Contact::latest()->get();
        $limit = 10;
        $currentPage = request()->query('page', 1);
        $items = $contactsCollection->slice(($currentPage * $limit - $limit), $limit);
        $total = $contactsCollection->count();
        $contacts = new LengthAwarePaginator($items, $total, $limit, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query()
        ]); */
//        return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);
        return $contacts;
    }


    public function show(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
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

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $companies = $this->company->pluck();
        return view('contacts.edit', ['contact' => $contact, 'companies' => $companies]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:30|string',
            'last_name' => 'required|max:30|string',
            'email' => 'required|max:30|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ]);
        Contact::findOrFail($id)->update($request->all());
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('message', 'Contact has been removed successfully');
    }
}
