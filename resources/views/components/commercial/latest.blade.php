@props([
    'commercials' => []
])

<x-container>
    <section class="w-full min-h-[300px] overflow-hidden md:mb-2 mb-1 md:border-t-0 border-t">

        <div class="px-4 !font-noto md:py-8 pt-6 pb-3 md:text-2xl text-xl font-bold text-neutral-700 text-center">
            قائمة السيارات
        </div>

        @if($commercials)
            <!-- inner container -->
            <div class="md:px-16 px-5">

                <!-- grid layout (4 cells in md, lg, and up) (2 cell for sm) (1 cell for mobile) -->
                <div class="w-full grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6 p-2">


                    @foreach($commercials as $commercial)

                        <x-commercial.card
                            :url="route('commercial', \App\Utils\Hashed::new()->encode($commercial->id))"
                            :image-url="$commercial->getCarImageUrl()"
                            :title="$commercial->getCarName()"
                            :price="$commercial->price"
                            :release-date="$commercial->getCarReleaseDate()"
                            :location="$commercial->location"
                        />
                    @endforeach

                </div>

                <!-- show all commercials button -->
                <div class="flex space-x-2 justify-center my-8">
                    <a href="{{route('commercials')}}">
                        <button
                            type="button"
                            data-mdb-ripple="true"
                            data-mdb-ripple-color="light"
                            class="inline-block px-10 py-3.5 bg-blue-600 text-white font-medium text-lg leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            تصفح المزيد
                        </button>
                    </a>
                </div>

            </div>
        @endif

        <!-- Empty State -->
        @empty($commercials)
            <x-commercial.empty />
        @endempty

    </section>
</x-container>
