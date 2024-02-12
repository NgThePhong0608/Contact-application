<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Settings
        </div>
        <div class="list-group list-group-flush">
            <a href="{{route('user-profile-information.edit')}}"
               class="list-group-item list-group-item-action @if(request()->routeIs('user-profile-information.edit')) active @endif"><span>Profile</span></a>
            <a href="{{route('user-update-password.edit')}}"
               class="list-group-item list-group-item-action @if(request()->routeIs('user-update-password.edit')) active @endif "><span>Password</span></a>
            <a href="#"
               class="list-group-item list-group-item-action @if(request()->routeIs('user-export-import.edit')) active @endif "><span>Import & Export</span> </a>
        </div>
    </div>
</div><!-- /.col-md-3 -->
