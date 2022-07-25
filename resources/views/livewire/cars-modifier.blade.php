@php
    // brand, model, releaseDate
    $columnHeaders = [
        '',
        'المعرف',
        'الشركة المصنعة',
        'الموديل',
        'سنة التصنيع'
    ];
@endphp

<div>
    @if(!empty($cars))
        <x-table.container>
            <x-table.new :column-headers="$columnHeaders">
                <x-slot:content>
                    @foreach($cars as $index => $car)
                        <x-table.row>

                            <x-table.cell class="px-4 py-1 text-sm">
                                <div class="cursor-pointer w-10 h-10 overflow-hidden rounded-full hover:ring-2 ring-offset-1 hover:ring-gray-200 bg-gray-300">
                                @if(isset($car['mediable']['path']))
                                    <img
                                        class="w-full h-full object-cover"
                                        src="{{ \Illuminate\Support\Facades\Storage::url($car['mediable']['path']) }}"
                                        alt="car" />
                                @endif
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                {{ $car['id'] }}#
                            </x-table.cell>

                            <x-table.cell>
                                {{ $car['brand'] }}
                            </x-table.cell>

                            <x-table.cell>
                                {{ $car['model'] }}
                            </x-table.cell>

                            <x-table.cell>
                                {{ $car['releaseDate'] }}
                            </x-table.cell>

                            <x-table.controls-cell>
                                <!-- delete -->
                                <button
                                    wire:click.prevent="confirmingCarDeletion({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-red-400 rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-red-100 hover:rounded-full"
                                    aria-label="Delete"
                                    title="حذف">
                                    <x-icons.remove />
                                </button>

                                <!-- edit -->
                                <button
                                    wire:click="managingCars({{$index}})"
                                    class="flex justify-between items-center px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg focus:outline-none focus:shadow-outline-gray even:hover:bg-gray-200 hover:bg-gray-100 hover:rounded-full"
                                    title="تعديل"
                                    aria-label="Edit">
                                    <x-icons.edit-outline />
                                </button>

                            </x-table.controls-cell>
                        </x-table.row>
                    @endforeach
                </x-slot:content>
            </x-table.new>

            <!-- FAB -->
            <button wire:click="managingCars"
                    class="group fixed right-4 bottom-4 md:right-8 md:bottom-8 cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 shadow-xl shadow-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                    type="button">
                <div class="flex items-center gap-2">
                    <x-icons.pen />
                    <span class="text-red-200 group-hover:text-red-100 duration-300">إضافة سيارة</span>
                </div>
            </button>

        </x-table.container>
    @endif

    @empty($cars)
        <div class="md:py-20 py-2">
            <div class="p-2 flex items-center justify-center flex-col">
                <x-icons.car class="w-20 h-20" />
                <p class="py-4">لا يوجد أي سيارات حالياً.</p>
                <button
                    wire:click="managingCars"
                    class="group cursor-pointer bg-red-500 text-sm focus:ring-4 focus:ring-red-200 hover:bg-red-600 active:bg-red-600 px-6 py-2 rounded-full text-red-200 hover:text-red-100"
                    type="button">
                    <div class="flex items-center gap-2">
                        <x-icons.pen />
                        <span class="text-red-200 group-hover:text-red-100 duration-300">إضافة سيارة جديد</span>
                    </div>
                </button>
            </div>
        </div>
    @endEmpty

    <!-- Delete Confirmation Modal -->
    <x-car.delete />

    <!-- Create New Messages Modal -->
    <x-car.manage :car-photo="$carPhoto" :edit-mode="$editMode">
        {{ __(':title', ['title' => is_null($carIndexBeingUpdated) ? 'سيارة جديدة': 'تعديل']) }}
    </x-car.manage>

</div>


{{--

// Store the uploaded file in the "photos" directory of the default filesystem disk.
$this->photo->store('photos');

// Store in the "photos" directory in a configured "s3" bucket.
$this->photo->store('photos', 's3');

// Store in the "photos" directory with the filename "avatar.png".
$this->photo->storeAs('photos', 'avatar');

// Store in the "photos" directory in a configured "s3" bucket with the filename "avatar.png".
$this->photo->storeAs('photos', 'avatar', 's3');

// Store in the "photos" directory, with "Website" visibility in a configured "s3" bucket.
$this->photo->storePublicly('photos', 's3');

// Store in the "photos" directory, with the name "avatar.png", with "Website" visibility in a configured "s3" bucket.
$this->photo->storePubliclyAs('photos', 'avatar', 's3');

--}}
