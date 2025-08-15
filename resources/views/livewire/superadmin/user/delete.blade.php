<!-- Modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash mr-1"></i>Delete
                    {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">Name</div>
                    <div class="col-8">:{{ $name }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Email</div>
                    <div class="col-8">:{{ $email }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Role</div>
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
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                            class="fas fa-times mr-1"></i>Cancel</button>
                    <button wire:click="destroy({{ $user_id }})" type="button" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash mr-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
