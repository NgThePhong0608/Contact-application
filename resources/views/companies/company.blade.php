<tr>
    <th scope="row">{{ $company->id }}</th>
    <td>{{ $company->name }}</td>
    <td>{{ $company->address }}</td>
    <td>{{ $company->website }}</td>
    <td>{{ $company->email }}</td>
    <td>
        <a href="{{admin.contacts.index}}" class="btn btn-sm btn-circle btn-outline-danger" title="Back" onclick="confirm('Are you sure?')"><i class="fa fa-times"></i></a>
    </td>
</tr>