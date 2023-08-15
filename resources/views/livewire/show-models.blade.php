<!-- This example requires Tailwind CSS v2.0+ -->
<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex md:items-center md:justify-between p-8 bg-gray-800">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">Site {{$name_client}}</h2>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="mt-4 flex items-center text-sm text-gray-300">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                    Equipos agrupados por modelo
                                </div>
                                <div class="mt-4 flex items-center text-sm text-gray-300">
                                    <!-- Heroicon name: solid/calendar -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    Actualizado al {{ \Carbon\Carbon::now('America/Lima')->toFormattedDateString() }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4">
                            <!--
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Edit</button>
                            <button type="button" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Publish</button>
                            -->
                        </div>
                </div>
                <dl class="my-5 px-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                            <dt>
                                <div class="absolute bg-indigo-500 rounded-md p-3">
                                    <!-- Heroicon name: outline/users -->
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-sm font-medium text-gray-500 truncate">{{\Str::upper('cantidad total de equipos')}}</p>
                            </dt>
                            <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                <p class="text-2xl font-semibold text-gray-900">{{$total_devices}}</p>
                                <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                                    <div class="text-sm">
                                        <a href="{{ route('devices', ['model'=>'all', 'customer'=>$this->getId()]) }}" class="font-medium text-indigo-600 hover:text-indigo-500"> View all</a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        @foreach($models_devices as $model)
                            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                                <dt>
                                    <div class="absolute bg-indigo-500 rounded-md p-3">
                                        <!-- Heroicon name: outline/users -->
                                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">{{$model['value']}}</p>
                                </dt>
                                <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                    <p class="text-2xl font-semibold text-gray-900">{{$model['count']}}</p>
                                    <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="{{ route('devices', ['model'=>$model['value'] == '' ? 'all' : $model['value'], 'customer'=>$this->getId() ]) }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                View all devices
                                            </a>
                                        </div>
                                    </div>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
            </div>
        </div>
    </div>
</div>
