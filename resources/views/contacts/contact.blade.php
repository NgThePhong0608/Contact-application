<tr>
    <th scope="row">{{ $contacts->firstItem() + $index }}</th>
    <td>{{ $contact->first_name }}</td>
    <td>{{ $contact->last_name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->address }}</td>
    <td>{{ $contact->company->name }}</td>
    <td>
        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{ route('admin.contacts.edit' , $contact->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Update"><i class="fa fa-edit"></i></a>
        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post" onsubmit="return confirm('Are you sure?')" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete"><i class="fa fa-times"></i></button>
        </form>
    </td>
</tr>

