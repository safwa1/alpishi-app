<section class="w-full h-fit md:min-h-[20rem] overflow-hidden bg-while">
    <x-container>
        <div class="w-full md:min-h-[36rem] md:px-10 px-5 md:py-20 py-6 flex items-center justify-center flex-col">
            <div
                id="up"
                class="w-full md:p-8 p-4 space-y-6 max-w-2xl bg-white overflow-hidden md:rounded-xl rounded-md border md:border-gray-50 border-gray-100/70 md:shadow-[0_3px_10px_rgb(0,0,0,0.1)]">

                @if(session()->has('contactusSent'))
                    <x-bladewind.alert
                        class="rounded-lg"
                        type="success">
                        {{ session()->get('contactusSent') }}
                    </x-bladewind.alert>
                @endif

                <div class="block md:px-2 md:py-2 rounded-lg bg-white">
                    <div class="sm:text-base text-sm text-neutral-500 pb-8">
                        دعنا نسمع منك، يمكنك الإستفسار أو الإبلاغ عن مشكلة أو تقديم إقتراح،
                        تأكد سنكون سعداء بهذا
                    </div>
                    <form wire:submit.prevent="submit">
                        @csrf
                        <div class="form-group md:mb-6 mb-4">
                            <label>
                                <input
                                    wire:model.lazy="contactUsModel.name"
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-sm font-normal text-gray-700 placeholder-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="الإسم الكامل *">
                            </label>
                            @if($errors->has("contactUsModel.name"))
                                <span class="text-error text-xs">{{ $errors->first("contactUsModel.name") }}</span>
                            @endif
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-3">
                            <div class="form-group md:mb-6 mb-4">
                                <label>
                                    <input
                                        wire:model.lazy="contactUsModel.email"
                                        type="email"
                                        class="form-control block w-full px-3 py-2 text-sm font-normal text-gray-700 placeholder-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        placeholder="البريد الإلكتروني *">
                                </label>
                                @if($errors->has("contactUsModel.email"))
                                    <span class="text-error text-xs">{{ $errors->first("contactUsModel.email") }}</span>
                                @endif
                            </div>
                            <div class="form-group md:mb-6 mb-4">
                                <!-- price -->
                                <div>
                                    <label for="price" class="sr-only">رقم الهاتف</label>
                                    <div class="relative rounded">
                                        <div class="absolute inset-y-0 left-0 flex items-center">
                                            <label for="country" class="sr-only">Country</label>
                                            <select
                                                wire:model.lazy="countryKey"
                                                id="country"
                                                class="[direction:ltr] focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 rtl:text-left sm:text-sm rounded-md">
                                                @foreach(\App\Utils\CountriesKeys::all() as $country)
                                                    <option data-countryName="{{$country['name']}}"
                                                            data-countryCode="{{ $country['code'] }}"
                                                            value="{{$country['value']}}">
                                                        {{$country['label']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input
                                            wire:model.lazy="contactUsModel.phone"
                                            type="text"
                                            id="price"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-20 form-control block px-3 py-2 text-sm font-normal text-gray-700 placeholder-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white"
                                            placeholder="رقم الهاتف" />
                                    </div>
                                    @if($errors->has("contactUsModel.phone"))
                                        <span
                                            class="text-error text-xs">{{ $errors->first("contactUsModel.phone") }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group md:mb-6 mb-4">
                            <label>
                                <input
                                    wire:model.lazy="contactUsModel.subject"
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-sm font-normal text-gray-700 placeholder-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="عنوان الموضوع *">
                            </label>
                            @if($errors->has("contactUsModel.subject"))
                                <span class="text-error text-xs">{{ $errors->first("contactUsModel.subject") }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-4"
                             x-data="{length:0 }">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-neutral-400 text-right">الحد الأقصى هو 500 حرف</span>
                                <span class="block text-xs text-neutral-400 text-left">
                                    <span x-text="length"></span> / 500
                            </span>
                            </div>
                            <label>
                                <textarea
                                    wire:model.lazy="contactUsModel.message"
                                    @input="length = $el.value.length"
                                    class="form-control block w-full px-3 py-1.5 text-sm font-normal text-gray-700 placeholder-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="8"
                                    maxlength="500"
                                    placeholder="نص الرسالة *"></textarea>
                            </label>
                            @if($errors->has("contactUsModel.message"))
                                <span class="text-error text-xs">{{ $errors->first("contactUsModel.message") }}</span>
                            @endif
                        </div>
                        <button
                            type="submit"
                            data-mdb-ripple="true"
                            data-mdb-ripple-color="light"
                            class="inline-block px-8 py-1.5 bg-primary text-white font-medium sm:text-base text-sm leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            إرسال
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </x-container>
</section>
