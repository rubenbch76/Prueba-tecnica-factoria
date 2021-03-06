@section('title', __('Photos'))

<div class="container-fluid">

				<div class="section-title">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa fa-camera"></i>
							Galería de Imágenes </h4>
						</div>
						<div style="display: flex; align-items: center;">					
							<div style="margin-right: 15px">
								<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar imagen">
							</div>
							<div class="btn btn-orange btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
								<i class="fa fa-plus"></i>  Añadir imagen
							</div>
						</div>	
					</div>
				</div>
				
				<div class="cards-container">
					@include('livewire.photos.create')
					@include('livewire.photos.update')
										
						@foreach($photos as $row)

								<div class="card col-xs-12">				<a href="{{ asset('storage').'/'.$row->image }}">	
										<img class="card-img-top" src="{{ asset('storage').'/'.$row->image }}" alt="{{ $row->title }}">
									</a>
									<div class="card-main">
										<h5 class="card-title">{{ $row->title }}</h2>
									</div>
									<div class="card-body"> 
										<div class="btn-group">
											<button type="button" class="btn btn-orange dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Opciones
											</button>
											<div class="dropdown-menu dropdown-menu-right">
												<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
												<a class="dropdown-item" onclick="confirm('Confirm Delete Photo id {{$row->id}}? \nDeleted Photos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
											</div>
										</div>
									</div>									
								</div>

						@endforeach																
				</div>
				<div class="pagination">
					{{ $photos->links() }}
				</div>
				
</div>
