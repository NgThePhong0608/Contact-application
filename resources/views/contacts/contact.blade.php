<tr>
    <th scope="row">{{ $contacts->firstItem() + $index }}</th>
    <td>{{ $contact->first_name }}</td>
    <td>{{ $contact->last_name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->address }}</td>
    <td>{{ $contact->company->name ?? null }}</td>
    <td width="150">
        @if ($showTrashButton)
            @include('shared.buttons.restore', [
                'action' => route('admin.contacts.restore', $contact->id)
            ])
            @include('shared.buttons.force-delete', [
                'action' => route('admin.contacts.force-delete', $contact->id)
            ])
        @else
            @include('shared.buttons.button', [
                'action' => route('admin.contacts.show', $contact->id),
                'buttonAction' => 'Show',
                'icons' => 'fa fa-eye'
            ])
            @include('shared.buttons.button', [
                'action' => route('admin.contacts.edit', $contact->id),
                'buttonAction' => 'Edit',
                'icons' => 'fa fa-edit'
            ])
            @include('shared.buttons.destroy', [
                'action' => route('admin.contacts.destroy', $contact->id)
            ])
        @endif
    </td>
</tr>
