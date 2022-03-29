<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Photos extends Component
{
    use WithPagination;
    use WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $image, $imageOld, $title;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.photos.view', [
            'photos' => Photo::latest()
                        ->where('user_id', 'LIKE', Auth::user()->id)
						/* ->orWhere('image', 'LIKE', $keyWord) */
						->where('title', 'LIKE', $keyWord)                      
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
		'image' => 'image|max:2048',
		'title' => 'required'
        ]);


        Photo::create([ 
			'image' => $this-> image->store('uploads', 'public'),
			'title' => $this-> title,
            'user_id' => Auth::user()->id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Photo Successfully created.');
    }

    public function edit($id)
    {
        $record = Photo::findOrFail($id);

        $this->selected_id = $id; 
		$this->imageOld = $record-> image;
		$this->title = $record-> title;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $updatedImage = '';

        if($this->image == null) {
            $this->validate(['title' => 'required']);
            $updatedImage = $this->imageOld;
        }else{  
            $this->validate([
                'image' => 'image|max:2048',
                'title' => 'required']);          
            $updatedImage = $this->image->store('uploads', 'public');
        }

        if ($this->selected_id) {
			$record = Photo::find($this->selected_id);
            $record->update([ 
			'image' => $updatedImage,
			'title' => $this-> title,
            'user_id' => Auth::user()->id
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
