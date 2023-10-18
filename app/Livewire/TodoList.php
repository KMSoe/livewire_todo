<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:2')]
    public $name;

    public $search;

    public function create()
    {
        $this->validateOnly('name');

        Todo::create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);

        session()->flash('success', 'Saved.');
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function render()
    {
        $todos = Todo::where(
            'name',
            'LIKE',
            "%$this->search%"
        )->latest()->paginate(10);

        return view('livewire.todo-list', [
            'todos' => $todos,
        ]);
    }
}
