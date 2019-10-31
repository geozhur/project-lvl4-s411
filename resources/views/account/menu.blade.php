<div class="col-12 col-md-3">
        <div class="card shadow-sm">
                <div class="card-header font-weight-bold text-muted">
                Settings
                </div>
                <div class="list-group list-group-flush">
                    <a class="nav-link list-group-item list-group-item-action {{ (\Request::route()->getName() == 'account.edit') ? 'active' : '' }}" href="{{ route('account.edit', $user->id) }}">{{ __('Contact') }}</a>
                    <a class="nav-link list-group-item list-group-item-action {{ (\Request::route()->getName() == 'account.editSecurity')  ? 'active' : '' }}" href="{{ route('account.editSecurity') }}">{{ __('Security') }}</a>
                </div>
        </div>
</div>
