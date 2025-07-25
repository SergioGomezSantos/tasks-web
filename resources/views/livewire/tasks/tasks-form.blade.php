<form wire:submit="{{ $editMode ? 'update' : 'save' }}"
    class="p-6 border border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">

    <h1 class="text-2xl mb-6 text-center font-bold border-b-2 border-gray-500 dark:border-white pb-2">
        <span class="text-blue-300">{{ ucwords(auth()->user()->name) }}</span> - {{ $formTitle }}
    </h1>

    <div class="mb-4">
        <x-label for="title" class="mb-1 text-xl">Title</x-label>
        <x-input type="text" id="title" wire:model="form.title" class="w-full mt-1 rounded" />
        <div class="mt-1">
            @error('form.title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <x-label for="description" class="mb-1 text-xl">Description</x-label>
        <x-textarea id="description" wire:model="form.description" class="w-full mt-1 rounded"></x-textarea>
        <div class="mt-1">
            @error('form.description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="col-span-2 grid grid-cols-2 gap-4">
            <div>
                <x-label for="status" class="text-xl">Status</x-label>
                <x-select id="status" wire:model="form.status" class="w-full mt-1 rounded">
                    <option value="" selected disabled>Select a status...</option>
                    @foreach (\App\Enums\StatusType::cases() as $status)
                        <option value="{{ $status->value }}">
                            {{ Str::of($status->value)->headline() }}
                        </option>
                    @endforeach
                </x-select>
                @error('form.status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-label for="priority" class="text-xl">Priority</x-label>
                <x-select id="priority" wire:model="form.priority" class="w-full mt-1 rounded">
                    <option value="" selected disabled>Select a priority...</option>
                    @foreach (\App\Enums\PriorityType::cases() as $priority)
                        <option value="{{ $priority->value }}">
                            {{ Str::of($priority->value)->headline() }}
                        </option>
                    @endforeach
                </x-select>
                @error('form.priority')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-span-2">
            <x-label for="deadline" class="text-xl">Deadline</x-label>
            <x-input type="date" id="deadline" wire:model="form.deadline" class="w-full mt-1 rounded" />
            @error('form.deadline')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex justify-end gap-4">

        @if (session()->has('success'))
            <div class="flex-1 p-2 text-center rounded-lg bg-green-300 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($showFlash)
            <div class="flex-1 p-2 text-center rounded-lg bg-green-300 text-green-800" x-data="{ show: true }"
                x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                {{ $flashMessage }}
            </div>
        @endif

        <div class="flex items-center gap-2">

            @if (!$task)
                <x-button type="button" class="border-2 cursor-pointer" wire:click="resetForm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </x-button>
            @endif

            <x-button type="submit" class="border-2 cursor-pointer">
                {{ $editMode ? 'Update Task' : 'Add Task' }}
            </x-button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('hide-flash-after-delay', () => {
            setTimeout(() => {
                Livewire.dispatch('hide-flash');
            }, 3000);
        });
    });
</script>
