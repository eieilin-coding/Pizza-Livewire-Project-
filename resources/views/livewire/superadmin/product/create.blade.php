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
                <div class="row">
                    <label class="form-label">Category</label>
                    <select wire:model.defer="category_id" class="form-select form-control">
                        <option value="">-- select category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input wire:model="image" type="file" class="form-control">
                    @error('image')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror

                    @if ($image)
                        <div class="mt-2">
                            <p class="small text-muted">Preview:</p>
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid" style="max-height:120px">
                        </div>
                    @endif
                </div>
                <div class="row">
                    <label class="form-label">Price</label>
                    <input wire:model.defer="price" type="number" step="0.01" class="form-control">
                    @error('price')
                        <span class="text-danger small">{{ $message }}</span>
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
