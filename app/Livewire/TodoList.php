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

    public $edit_to_id;
    #[Rule('required|min:2')]
    public $edit_todo_new_name;

    public function create()
    {
        $this->validateOnly('name');

        Todo::create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);

        session()->flash('success', 'Saved.');

        $this->resetPage();
    }

    public function edit($id)
    {
        $todo                     = Todo::findOrFail($id);
        $this->edit_to_id         = $id;
        $this->edit_todo_new_name = $todo->name;
    }

    public function update($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'name' => $this->edit_todo_new_name,
        ]);

        $this->reset(['edit_to_id', 'edit_todo_new_name']);
    }

    public function cancelEdit()
    {
        $this->reset(['edit_to_id', 'edit_todo_new_name']);
    }

    public function toggle($id)
    {
        $todo            = Todo::findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function delete($id)
    {
        try {
            $item = Todo::findOrFail($id);
            $item->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete todo');
        }
    }

    public function render()
    {
        $todos = Todo::where(
            'name',
            'LIKE',
            "%$this->search%"
        )->latest()->paginate(5);

        return view('livewire.todo-list', [
            'todos' => $todos,
        ]);
    }
}
