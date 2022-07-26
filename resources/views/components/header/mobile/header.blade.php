<div {{ $attributes->class(['border-b border-gary-100/90']) }}>
    <div class="flex bg-white justify-around items-center w-full overflow-hidden max-h-[100px] h-[100px] px-6 py-2 gap-4">

        <div class="flex-2 overflow-hidden">
            <img class="h-12" src="{{ asset('media/logo.png') }}" alt="Logo" />
        </div>

        <div class="flex-1 font-semibold text-xs text-[#0F6BA5] ">
            البيشي للخدمات التجارية
            <br>
            للوساطة في استيراد سيارات الديزل الكورية
        </div>
    </div>

    <div class="px-3 mb-3">
        <div>
            <div class="mt-1 relative rounded-full shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none hidden">

                </div>
                <label>
                    <input
                        type="text"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 pl-12 ltr:pl-7 ltr:pr-12 sm:text-sm border-gray-300 rounded-full placeholder-gray-400"
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
