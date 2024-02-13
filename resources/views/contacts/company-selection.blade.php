<select class="custom-select search-select" name="company_id">

    <option value="" selected>All Companies</option>
    @forelse ($companies as $id => $company)
        <option value="{{ $id }}" @if($id == request()->query('company_id')) selected @endif>{{ $company }}</option>
    @empty
        <option value="">No company found</option>
    @endforelse
</select>
