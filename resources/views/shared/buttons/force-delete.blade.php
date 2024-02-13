<form action="{{ $action }}"
      onsubmit="return confirm('Your data will be removed permanently ?')" method="post"
      style="display: inline">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently"><i
            class="fa fa-times"></i></button>
</form>
