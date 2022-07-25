<div class="md:px-8 px-4 py-3 md:text-base text-sm font-bold shadow">
    <nav class="w-full">
        <ol class="list-reset flex">
            <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700">الرئيسية</a></li>
            <li><span class="text-gray-500 mx-2">/</span></li>
            <li class="text-gray-500">قائمة السيارات</li>
        </ol>
    </nav>
</div>

<x-container>

    @if(isset($allCommercials) && count($allCommercials) > 0)
        <section class="w-full min-h-[30rem] overflow-hidden md:mb-2 mb-1 md:border-t-0 border-t">
            <!-- container -->
            <div class="md:px-16 px-5 md:mb-16">
                <div class="w-full grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6 px-2 sm:py-16 py-8">

                    @foreach($allCommercials as $commercial)
                        <x-commercial.card
                            :url="route('commercial', \App\Utils\Hashed::new()->encode($commercial->id))"
                            :image-url="$commercial->getCarImageUrl()"
                            :title="$commercial->getCarName()"
                            :price="$commercial->price"
                            :release-date="$commercial->getCarReleaseDate()"
                            :location="$commercial->location"
                            :sold="$commercial->sold"
                        />
                    @endforeach


                </div>
            </div>
        </section>
    @else
        <x-commercial.empty />
    @endif


</x-container>
