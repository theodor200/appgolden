<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex md:items-center md:justify-between p-8 bg-gray-800">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">Sites</h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <button wire:click="$set('page', 'show_page'), resetForm" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Ver todos</button>
                        <button wire:click="$set('page', 'add_page')" type="button" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Agregar</button>
                    </div>

                </div>

                <form class="space-y-8 divide-y divide-gray-200 p-12">
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Registrar Site</h3>
                                {{$page}}
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Para registrar un site se debe completar todos los campos del formulario.</p>
                            </div>
                            <div class="space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Clave SID<br>
                                        <span class="inline-flex items-center text-sm py-2 text-gray-800">Esta clave se optiene del inicio de sesion en DCC y servira para obtener el ID del cliente y el nombre, estos datos se obtienen desde el DCC con el SID</span>
                                    </label>

                                    <div class="flex-row gap-4 mt-1 sm:mt-0 sm:col-span-2">
                                        <div class="flex gap-4">
                                            <input wire:model="sid" type="text" name="sid" id="sid" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                            <button wire:click="obtenerDatos" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Obtener datos</button>
                                        </div>

                                        @error('sid')
                                        <div class="flex items-center gap-2 py-4">
                                                <span>
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Cliente ID </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="text" name="customer_id" id="customer_id" autocomplete="given-name" disabled value="{{$customer_id}}"  class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
                                        @error('customer_id')
                                        <div class="flex items-center gap-2 py-4">
                                                <span>
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Nombre </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="text" name="name" id="name" autocomplete="family-name" disabled value="{{$name}}" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
                                        @error('name')
                                        <div class="flex items-center gap-2 py-4">
                                                <span>
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Correo electronico </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input wire:model="email" id="email" name="email" type="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                        @error('email')
                                            <div class="flex items-center gap-2 py-4">
                                                <span>
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                            <button wire:click.prevent="guardarSite" type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                        </div>
                    </div>
                    <!--Mensaje de sesion-->
                    @if (session()->has('message'))
                        <div class="bg-indigo-600 fixed inset-x-0 bottom-0">
                            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                                <div class="flex items-center justify-between flex-wrap">
                                    <div class="w-0 flex-1 flex items-center">
                                <span class="flex p-2 rounded-lg bg-indigo-800">
                                  <!-- Heroicon name: outline/speakerphone -->
                                  <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                  </svg>
                                </span>
                                        <p class="ml-3 font-medium text-white truncate">
                                            <span class="md:hidden"> We announced a new product! </span>
                                            <span class="hidden md:inline"> {{ session('message') }} </span>
                                        </p>
                                    </div>
                                    <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                                        <a href="#" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50"> Learn more </a>
                                    </div>
                                    <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-3">
                                        <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white sm:-mr-2">
                                            <span class="sr-only">Dismiss</span>
                                            <!-- Heroicon name: outline/x -->
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--Fin de mensaje de sesion-->
                </form>

            </div>
        </div>
    </div>
</div>
