<?php

namespace App\Http\Livewire;

use App\Models\UserModel;
use Livewire\Component;

class SearchUser extends Component {
    public $query;
    public $user;
    public $highlightIndex;

    public function mount() {
        $this->query = '';
        $this->user = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight() {
        if ($this->highlightIndex === count($this->user) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight() {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->user) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectUser($index = 0) {
        $resIndex = $this->highlightIndex;
        if ($index > 0) {
            $resIndex = $index;
        }

        $user = $this->user[$resIndex] ?? null;
        if ($user) {
            $this->query = $user['nama'];
            $this->user = [];
        }
    }

    public function updatedQuery() {
        $this->user = UserModel::query()
            ->where('nama', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render() {
        return view('livewire.search-user');
    }
}
