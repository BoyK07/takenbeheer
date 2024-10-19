<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Taak Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="titel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titel</label>
                            <input type="text" name="titel" id="titel" value="{{ $task->titel }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="beschrijving" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Beschrijving</label>
                            <textarea name="beschrijving" id="beschrijving" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $task->beschrijving }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="open" {{ $task->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in uitvoering" {{ $task->status == 'in uitvoering' ? 'selected' : '' }}>In Uitvoering</option>
                                <option value="voltooid" {{ $task->status == 'voltooid' ? 'selected' : '' }}>Voltooid</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="vervaldatum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vervaldatum</label>
                            <input type="date" name="vervaldatum" id="vervaldatum" value="{{ $task->vervaldatum }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="prioriteit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prioriteit</label>
                            <select name="prioriteit" id="prioriteit" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="laag" {{ $task->prioriteit == 'laag' ? 'selected' : '' }}>Laag</option>
                                <option value="normaal" {{ $task->prioriteit == 'normaal' ? 'selected' : '' }}>Normaal</option>
                                <option value="hoog" {{ $task->prioriteit == 'hoog' ? 'selected' : '' }}>Hoog</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="gebruikers" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gebruikers toewijzen</label>
                            <select name="gebruikers[]" id="gebruikers" multiple class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $task->users->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
