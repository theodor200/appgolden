<div>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex md:items-center md:justify-between p-8 bg-gray-800">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">Tickets de GLPI</h2>
                        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                            <div class="mt-4 flex items-center text-sm text-gray-300">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                </svg>
                                Cantidad: {{count($tickets)}}
                            </div>
                            <div class="mt-4 flex items-center text-sm text-gray-300">
                                <!-- Heroicon name: solid/calendar -->
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Actualizado al {{ \Carbon\Carbon::now('America/Lima')->toFormattedDateString()}}
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

                <!-- TABLE-->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Ticket</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Entidad</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Sede</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">F. creación</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">F. Asignación</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">F. Ult Actualizacipon</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Grupo Técnico</th>
                                        <th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Técnico</th>
                                        <!--<th scope="col" class="px-6 py-3 text-left text-[12px] font-medium text-gray-500 uppercase tracking-wider">Historico asignación</th>
                                        -->
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 text-[12px]">

                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->numero}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        <span class="px-3 inline-flex text-sm leading-7 rounded-full bg-green-100 text-green-800"> {{$ticket->estado}} </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->entidad}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->locazion}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->tipo}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->apertura}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        En desarrollo
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->actualizacion}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {!! $ticket->grupo !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex flex-col gap-2">
                                                        {{$ticket->tecnico}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <!--<div class="flex items-center ">
                                                    <div class="flex flex-col gap-2">
                                                        <div class="grid gap-y-2">
                                                            <div class="flex items-center gap-x-3">
                                                                <p class="flex items-center text-xs text-gray-500">
                                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                    </svg>
                                                                    Completed phone screening
                                                                </p>
                                                                <p class="text-xs text-gray-900">
                                                                    <time datetime="2020-01-07">January 7, 2020</time>
                                                                </p>
                                                            </div>
                                                            <div class="flex items-center gap-x-3">
                                                                <p class="flex items-center text-xs text-gray-500">
                                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                    </svg>
                                                                    Completed phone screening
                                                                </p>
                                                                <p class="text-xs text-gray-900">
                                                                    <time datetime="2020-01-07">January 7, 2020</time>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TABLE-->
            </div>
        </div>
    </div>
</div>
