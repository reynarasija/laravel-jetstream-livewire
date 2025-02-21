<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Index extends Component
{
    use WithPagination;

    public $title, $content, $post_id;
    public $isOpen = 0;
    public $search;
    protected $updatesQueryString = ['search'];
    public function render()
    {

        
        return view('livewire.posts',[
            'posts'=>$this->search === null ?
               Post::orderBy('created_at', 'asc')->paginate(5) :
               Post::orderBy('created_at', 'asc')->where('title','like','%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%')->paginate(5) 
        ]);
        
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
        $this->post_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
   
        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'content' => $this->content
        ]);
  
        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
        
        $this->closeModal();
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;

    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
