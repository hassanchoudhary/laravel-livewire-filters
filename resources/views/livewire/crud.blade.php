<x-slot name="header">
    <h2 class="text-center">Livewire CRUD </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Create Student</button>
            <form wire:submit.prevent="genderFilter">
               
               
            </form>
            <select wire:model="gender" wire:change="genderFilter">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <br>
                <label><input type="checkbox" name="gender-male" wire:model="filters.male" value="{{$filters['male']}}" wire:change="genderFilterCheckBox"/> Male</label><br>
                <label><input type="checkbox" name="gender-female" wire:model="filters.female" value="true" wire:change="genderFilterCheckBox"/> Female</label>
                <br>
                <label for="points">Points (between 0 and 10):</label>
                <input type="range" id="points" name="points" min="0" max="10" wire:model="prices" wire:change="RangePrices"> 

                
            @if($isModalOpen)
            @include('livewire.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Mobile</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border px-4 py-2">{{ $student->id }}</td>
                        <td class="border px-4 py-2">{{ $student->name }}</td>
                        <td class="border px-4 py-2">{{ $student->email}}</td>
                        <td class="border px-4 py-2">{{ $student->mobile}}</td>
                        <td class="border px-4 py-2">{{ $student->gender}}</td>
                        <td class="border px-4 py-2">{{ $student->prices}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $student->id }})"
                                class="bg-blue-500  text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $student->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>