<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Photo;

class Photos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $image, $title;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.photos.view', [
            'photos' => Photo::latest()
						->orWhere('image', 'LIKE', $keyWord)
						->orWhere('title', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->image = null;
		$this->title = null;
    }

    public function store()
    {
        $this->validate([
		'image' => 'required',
		'title' => 'required',
        ]);

        Photo::create([ 
			'image' => $this-> image,
			'title' => $this-> title
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Photo Successfully created.');
    }

    public function edit($id)
    {
        $record = Photo::findOrFail($id);

        $this->selected_id = $id; 
		$this->image = $record-> image;
		$this->title = $record-> title;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'image' => 'required',
		'title' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Photo::find($this->selected_id);
            $record->update([ 
			'image' => $this-> image,
			'title' => $this-> title
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Photo Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Photo::where('id', $id);
            $record->delete();
        }
    }
}
