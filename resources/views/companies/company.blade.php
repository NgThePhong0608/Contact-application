<tr>
    <th scope="row">{{ $companies->firstItem() + $index }}</th>
    <td>{{ $company->name }}</td>
    <td>{{ $company->website }}</td>
    <td>{{ $company->email }}</td>
    <td><a href="{{ route('admin.contacts.index', ['company_id' => $company->id]) }}">{{ $company->contacts_count }}</a></td>
    <td width="150">
        @if ($showTrashButton)
            @include('shared.buttons.restore', [
                'action' => route('admin.companies.restore', $company->id)
            ])
            @include('shared.buttons.force-delete', [
                'action' => route('admin.companies.force-delete', $company->id)
            ])
        @else
            @include('shared.buttons.button', [
                'action' => route('admin.companies.show', $company->id),
                'buttonAction' => 'Show',
                'icons' => 'fa fa-eye'
            ])
            @include('shared.buttons.button', [
                'action' => route('admin.companies.edit', $company->id),
                'buttonAction' => 'Edit',
                'icons' => 'fa fa-edit'
            ])
            @include('shared.buttons.destroy', [
                'action' => route('admin.companies.destroy', $company->id)
            ])
        @endif

    </td>
</tr>
