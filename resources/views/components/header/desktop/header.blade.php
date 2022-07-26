<div
    {{ $attributes->class(['hidden border-b border-gray-100 justify-around items-center w-full overflow-hidden max-h-[140px] h-[140px] px-12 py-2']) }}>

    <div class="flex-1 font-bold lg:text-lg 2xl:text-2xl text-xl text-[#0F6BA5] text-center">
        البيشي للخدمات التجارية
        <br>
        للوساطة في استيراد سيارات الديزل الكورية
    </div>

    <div class="flex-1 overflow-hidden">
        <a href="{{ route('home') }}"><img class="h-16 mx-auto cursor-pointer" src="{{ asset('media/logo.png') }}" alt="Logo" /></a>
    </div>

    <div class="flex-1 px-3">
        <div>
            <div class="mt-1 relative rounded-full shadow-sm">
                <div class="absolute inset-y-0 left-0 flex items-center">
                    <button
                        class="flex items-center bg-[#0F6BA5] hover:bg-[#0f6ba5c4] text-white mx-[10px] text-xs py-[5px] px-[16px] rounded-full cursor-pointer">
                        <span>بحث</span>
                    </button>
                </div>
                <label>
                    <input
                        type="text"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 pl-20 ltr:pl-7 ltr:pr-12 sm:text-sm border-gray-300 rounded-full placeholder-gray-400"
                        placeholder="البحث بإسم السيارة أو الموديل...">
                </label>
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <div class="pr-3">
                            <span class="text-gray-500 sm:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
