<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Name">
                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row mt-2">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email">
                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row mt-3">
                    @foreach ($allRoles as $role)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="roles"
                                    value="{{ $role->name }}">
                                <label class="form-check-label">
                                    {{ $role->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                     @error('roles')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="row mt-2">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input wire:model="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="row mt-2">
                    <label for="password_confirmation" class="form-label">Confirm Password <span
                            class="text-danger">*</span></label>
                    <input wire:model="password_confirmation" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Enter confirm password">
                    @error('password_confirmation')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                        class="fas fa-times mr-1"></i>Cancel</button>
                <button wire:click="store" type="button" class="btn btn-primary btn-sm"><i
                        class="fas fa-save mr-1"></i>Save changes</button>
            </div>
        </div>
    </div>
</div>
