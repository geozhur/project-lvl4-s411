<div class="col-12 col-md-3">
        <div class="card shadow-sm">
                <div class="card-header font-weight-bold text-muted">
                {{ __('account.settings') }}
                </div>
                <div class="list-group list-group-flush">
                    <a class="nav-link list-group-item list-group-item-action {{ (\Request::route()->getName() == 'account.edit') ? 'active' : '' }}" href="{{ route('account.edit', $user->id) }}">{{ __('account.contact') }}</a>
                    <a class="nav-link list-group-item list-group-item-action {{ (\Request::route()->getName() == 'account.password.edit')  ? 'active' : '' }}" href="{{ route('account.password.edit', $user->id) }}">{{ __('account.security') }}</a>
                </div>
        </div>
</div>
