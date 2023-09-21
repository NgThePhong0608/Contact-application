{{--<select class="custom-select" name="company_id" id="search-select" onchange="this.form.submit()">--}}
<select class="custom-select" name="company_id" id="search-select">

    <option value="" selected>All Companies</option>
    @forelse ($companies as $id => $company)
        <option value="{{ $id }}" @if($id == request()->query('company_id')) selected @endif>{{ $company }}</option>
    @empty
        <option value="">No company found</option>
    @endforelse
</select>
