<div class="modal fade" tabindex="-1" role="dialog" id="updatePass">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-5 border-success text-success">
            <div class="modal-header">
                <h5 class="modal-title subtitle-modal fw-bolder">Update Password</h5>
                <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group py-2">
                        <label for="update_password_current_password" :value="__('Current Password')" class="subtitle-moda mb-2l">Palavra-passe Antiga:</label>
                        <input id="update_password_current_password" name="current_password" type="password"  class="form-control" placeholder="*******" autocomplete="current-password" required>
                        <x-input-error :messages="$errors->updatePassword->get('current_password')"/>
                    </div>

                    <div class="form-group py-2">
                        <label for="update_password_password" :value="__('New Password')" class="subtitle-modal mb-2">Palavra-passe Nova:</label>
                        <input id="update_password_password" name="password" type="password" class="form-control" placeholder="*******" autocomplete="new-password" required>
                        <x-input-error :messages="$errors->updatePassword->get('password')"/>
                    </div>

                    <div class="form-group py-2">
                        <label for="update_password_password_confirmation" :value="__('Confirm Password')" class="subtitle-modal mb-2">Confirmar Palavra-passe:</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="*******" autocomplete="new-password" required>
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"/>
                    </div>
                    
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif

                    <div class="d-flex py-2">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success ms-2">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="updateProfile">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-5 border-success text-success">
            <div class="modal-header">
                <h5 class="modal-title subtitle-modal fw-bolder">Update Profile</h5>
                <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group py-2">
                        <label for="name" :value="__('Name')" class="subtitle-moda mb-2l">Nome:</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{Auth::user()->name}}" required autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" />
                    </div>

                    <div class="form-group py-2">
                        <label for="email" :value="__('Email')" class="subtitle-modal mb-2">Email:</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{Auth::user()->email}}" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                    <div class="d-flex justify-content-between py-2">
                        <div>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success ms-2">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="deleteAccount">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-5 border-success text-success">
            <div class="modal-header">
                <h5 class="modal-title subtitle-modal fw-bolder">Eliminar Conta</h5>
                <button type="button" class="close btn rounded bg-success text-light border border-transparent" data-bs-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="form-group py-2">
                        <label for="name" class="subtitle-moda mb-2l">Tem a certeza que quer eliminar a conta?</label>
                    </div>
                    <div class="form-group py-2">
                        <label for="password" value="{{ __('Password') }}" class="subtitle-moda mb-2l">Password:</label>
                        <input type="password" class="form-control"  id="password"
                        name="password"
                        type="password" placeholder="******" required>
                    </div>
                    <x-input-error :messages="$errors->userDeletion->get('password')"/>
                    <div class="d-flex justify-content-between py-2">
                        <div>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success ms-2">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>