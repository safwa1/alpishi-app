<section class="md:bg-[#D7E5EB]/60 md:mb-2 mb-1">
    <x-container>
        <div class="mx-auto md:py-12 md:px-4 md:w-full p-2">
            <div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
                <div class="carousel-inner relative w-full overflow-hidden">
                    <div class="carousel-item relative float-left w-full">
                        <img src="{{asset("media/3.jpg")}}" class="block w-full" alt="...">
                    </div>
                    <div class="carousel-item relative float-left w-full">
                        <img src="{{asset("media/2.jpg")}}" class="block w-full" alt="...">
                    </div>
                    <div class="carousel-item relative float-left w-full active">
                        <img src="{{asset("media/1.jpg")}}" class="block w-full" alt="...">
                    </div>
                </div>
                <button
                    class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                    type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                    type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </x-container>
</section>
