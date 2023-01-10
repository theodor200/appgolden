<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex md:items-center md:justify-between p-8 bg-gray-800">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">Sites</h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <button wire:click="$set('page', 'mostrar')" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Ver todos</button>
                        <button wire:click="$set('page', 'guardar')" type="button" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Agregar</button>
                    </div>
                </div>
                <div class="my-5 px-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <!--Foreach-->
                    @foreach($sites as $site)
                        @if(isset($site['rows'][0]))
                        <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                            <dt>
                                <div class="absolute bg-indigo-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg font-medium text-gray-500 truncate">{{strtoupper($site['rows'][0]['name'])}}</p>
                            </dt>
                            <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                <div class="flex flex-col">
                                    <p class="text-md font-semibold text-gray-900">Sites: {{$site['rows'][0]['aggregate'][2]['count']}}</p>
                                    <p class="text-md font-semibold text-gray-900">Equipos: {{$site['rows'][0]['aggregate'][3]['count']}}</p>
                                </div>
                                <div class="absolute bottom-0 inset-x-0 bg-gray-50 px-4 py-4 sm:px-6">
                                    <div class="text-sm">
                                        <a href="{{route('models',$site['rows'][0]['_id'])}}" class="font-medium text-indigo-600 hover:text-indigo-500"> View site</a>
                                    </div>
                                </div>
                            </dd>
                        </div>
                        @else
                            <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                                <dt>
                                    <div class="absolute bg-indigo-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg font-medium text-gray-500 truncate">Site no cargo correctamente</p>
                                </dt>
                            </div>
                        @endif
                    @endforeach
                    <!--EnForeach-->
                </div>
            </div>
        </div>
    </div>
</div>
