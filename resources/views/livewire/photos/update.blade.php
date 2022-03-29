<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="image">Seleccione nueva imagen</label>
                        <input wire:model="image" type="file" class="form-control" id="image" >@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}">
                        @else
                            <img src="{{ asset('storage').'/'.$imageOld }}">
                        @endif                        
                    </div>
                    <div class="form-group">
                        <label for="title">Introduzca nuevo título</label>
                        <input wire:model="title" type="text" class="form-control" id="title" placeholder="Title">@error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-orange" data-dismiss="modal">Guardar cambios</button>
            </div>
       </div>
    </div>
</div>
