<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    #[Rule('required|min:2')]
    public $name;

    public function create()
    {
        $this->validate();

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
        $todos = Todo::paginate(10);

        return view('livewire.todo-list', [
            'todos' => $todos,
        ]);
    }
}
