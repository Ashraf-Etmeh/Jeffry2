<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job->title }}
    </x-slot:heading>

<form method="POST" action="/jobs/{{ $job->id }}">
    @csrf
    @method('PATCH')
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <x-form-field>
              <x-form-label for="title">Title</x-form-label>
              <div class="mt-2">
                <x-form-input name="title" id="title" placeholder="Shift Leader" value="{{ $job->title }}" required />
                <x-form-error name="title" />
              </div>
            </x-form-field>

            <x-form-field>
              <x-form-label for="salary">Salary</x-form-label>
              <div class="mt-2">
                <x-form-input name="salary" id="salary" placeholder="$50,000 USD" value="{{ $job->salary }}" required />
                <x-form-error name="salary" />
              </div>
            </x-form-field>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-x-6">
        <div class="flex items-center">
            <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
        </div>
        <div class="flex items-center gap-x-6">
            <a href="/jobs/{{ $job->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button>update</x-form-button>
        </div>
    </div>
  </form>

  <form method="POST" action="/jobs/{{ $job->id }}" class="hidden" id="delete-form">
    @csrf
    @method('DELETE')
  </form>

</x-layout>
