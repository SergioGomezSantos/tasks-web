<div class="border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
    <div class="pt-8 pl-8 pb-4 pr-4">
        <div class="flex justify-between">
            <h1 class="{{ $titleClasses ?? 'text-lg font-bold' }}">
                <a href="/{{ $task->slug }}">{{ Str::limit($task->title, 50) }}</a>
            </h1>

            <x-tasks.task-priority-badge :task="$task" />
        </div>

        <p class="mb-4 font-normal text-gray-700 dark:text-gray-400 whitespace-pre-line">{{ Str::limit(explode("\n", $task->description)[0], 50) }}</p>

        <div class="flex justify-between text-sm">
            <x-tasks.task-status-buttons :task="$task" :task-id="$task->id" />
            <x-tasks.task-action-buttons 
                :task="$task" 
                :show-view="$showViewButton ?? true" 
                :show-edit="$showEditButton ?? true" 
                :show-delete="$showDeleteButton ?? true"
                :show-back="$showBackButton ?? true" />
        </div>
    </div>
</div>
