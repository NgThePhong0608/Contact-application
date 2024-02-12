<tr>
    <th scope="row">{{ $companies->firstItem() + $index }}</th>
    <td>{{ $company->name }}</td>
    <td>{{ $company->website }}</td>
    <td>{{ $company->email }}</td>
    <td><a href="{{ route('admin.contacts.index', ['company_id' => $company->id]) }}">{{ $company->contacts->count() }}</a></td>
    <td width="150">
        @if ($showTrashButton)
            <form action="{{ route('admin.companies.restore', $company->id) }}" method="post" style="display: inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-circle btn-outline-info" title="Restore"><i
                        class="fa fa-undo"></i></button>
            </form>

            <form action="{{ route('admin.companies.force-delete', $company->id) }}"
                onsubmit="return confirm('Your data will be removed permanently ?')" method="post"
                style="display: inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently"><i
                        class="fa fa-times"></i></button>
            </form>
        @else
            <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-sm btn-circle btn-outline-info"
                title="Show"><i class="fa fa-eye"></i></a>
            <a href="{{ route('admin.companies.edit', $company->id) }}"
                class="btn btn-sm btn-circle btn-outline-secondary" title="Update"><i class="fa fa-edit"></i></a>
            <form action="{{ route('admin.companies.destroy', $company->id) }}" method="post" style="display: inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete"><i
                        class="fa fa-trash"></i></button>
            </form>
        @endif

    </td>
</tr>
