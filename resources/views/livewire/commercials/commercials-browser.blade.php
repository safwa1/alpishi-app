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

    @if(!empty($allCommercials))
        <section class="w-full min-h-[300px] overflow-hidden md:mb-2 mb-1 md:border-t-0 border-t">
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
                        />
                    @endforeach


                </div>
            </div>
        </section>
    @endif

    <!--empty-->
    @empty($allCommercials)
        <div class="w-full min-h-[300px] overflow-hidden md:mb-2 mb-1 md:border-t-0 border-t flex items-center justify-center">
                <span class="w-full h-full text-center max-w-max font-bold text-xl text-error/50 flex items-center flex-col gap-6">
                    <x-icons.empty-list />
                    لا توجد أي عروض حالياً
                </span>
        </div>
    @endempty

</x-container>
