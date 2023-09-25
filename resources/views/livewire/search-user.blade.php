<div class="position-relative">
    <input type="text" class="form-control" placeholder="Search User" wire:model="query" id="searchName"
        wire:keydown.arrow-up="decrementHighlight" wire:keydown.arrow-down="incrementHighlight"
        wire:keydown.enter="selectUser" />

    @if (!empty($query) && !empty($user))
        <div class="position-absolute w-100 list-group" style="z-index: 99;">
            @foreach ($user as $i => $u)
                <button type="button" class="list-group-item list-group-item-action"
                    wire:click="selectUser({{ $i }})">
                    {{ $u['nama'] }}
                </button>
            @endforeach
        </div>
    @endif
</div>
