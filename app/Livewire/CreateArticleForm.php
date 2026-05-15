<?php

namespace App\Livewire;
use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticleForm extends Component
{
    use WithFileUploads;
    public $images = [];
    public $temporary_images;
    
    #[Validate('required|min:5')]
    public $title;
    
    #[Validate('required|min:10')]
    public $description;
    
    #[Validate('required|numeric')]
    public $price;
    
    #[Validate('required')]
    public $category;
    public $article;
    
    public function save()
    {
        $this->validate();
        
        $this->article = Article::create([
        'title' => $this->title,
        'description' => $this->description,
        'price' => $this->price,
        'category_id' => $this->category,
        'user_id' => Auth::id()
        ]);
        
        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                dispatch(new ResizeImage($newImage->path, 300, 300));
            }
        }

        File::deleteDirectory(storage_path('/app/livewire-tmp'));
        session()->flash('success', "Articolo creato correttamente");
        $this->cleanForm();

    }
    
    public function render()
    {
        return view('livewire.create-article-form', [
        'categories' => Category::all()
        ]);
    }
    
    public function updatedTemporaryImages()
    {
        if ($this->validate([
        'temporary_images.*' => 'image|max:1024',
        'temporary_images' => 'max:6',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }
    
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }
    
    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
        $this->price = '';
        $this->images = [];
    }
}
