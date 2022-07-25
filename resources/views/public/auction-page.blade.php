<x-home-guest>

    <div class="md:px-8 px-4 py-3 md:text-base text-sm font-bold shadow">
        <nav class="w-full">
            <ol class="list-reset flex">
                <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700">الرئيسية</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                <li class="text-gray-500">المزادات اليومية</li>
            </ol>
        </nav>
    </div>


    <section
        class="w-full h-fit md:min-h-[24rem] overflow-hidden bg-white md:my-10">
        <x-container>
            <div class="w-full md:min-h-[24rem] md:px-10 px-5 py-6 flex items-center justify-center flex-col">
                <div
                    class="w-full md:shadow-[rgba(7,_65,_210,_0.2)_0px_9px_30px] shadow-[rgba(7,_65,_210,_0.1)_0px_9px_30px] px-4 py-6 space-y-6 max-w-xl bg-white opacity-80 backdrop-blur-md overflow-hidden rounded-2xl border border-blue-50 shadow-[rgba(7,_65,_210,_0.1)_0px_9px_30px]">

                    <div class="!font-bold sm:text-2xl text-lg !font-noto text-center">
                        المزادات اليومية على تيليجرام
                    </div>

                    <div class="bg-error w-20 h-2 rounded-full mx-auto"></div>

                    <article class="md:prose prose-sm lg:prose-xl">
                        <p class="px-6 py-2 opacity-95">
                            نقيم مزادات يومية لبيع السيارات على منصة تيليجرام، يمكنك المشاركة في المزادات أو الإطلاع عليها عبر النقر على الزر أدناه
                        </p>
                    </article>

                    <div class="flex justify-center">
                        <a href="https://t.me/albishi9" target="_blank">
                            <button class="inline-block px-6 py-2.5 mb-2 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out flex items-center bg-[#0088cc] hover:opacity-80" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                <x-icons.telegram />
                                <span class="mr-4 text-white">إنقر هنا للإطلاع على مزاد اليوم</span>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
        </x-container>
    </section>


</x-home-guest>
