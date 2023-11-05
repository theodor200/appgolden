<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:flex md:items-center md:justify-between p-8 bg-gray-800">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">Site $name_client</h2>
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
            </div>

        </div>
    </div>
    <!--Table-->
    <div class="flex flex-col px-10">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-2 text-left text-xs font-medium text-gray-800 bg-gray-50 uppercase tracking-wider">Site</th>
                            <th scope="col" class="px-6 py-2 text-left text-xs font-medium text-gray-800 bg-gray-50 uppercase tracking-wider">Serie</th>

                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-800 bg-gray-300 uppercase tracking-wider">Toner<br>Black<div class="rounded-3xl h-3 w-3 bg-[#000000]"></div> </th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-800 bg-gray-300 uppercase tracking-wider">Toner<br>Cyan<div class="rounded-3xl h-3 w-3 bg-[#00ffff]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-800 bg-gray-300 uppercase tracking-wider">Toner<br>Magenta<div class="rounded-3xl h-3 w-3 bg-[#FF00FF]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-800 bg-gray-300 uppercase tracking-wider">Toner<br>Yellow<div class="rounded-3xl h-3 w-3 bg-[#ffff00]"></div></th>

                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-200 uppercase tracking-wider">Drum<br>Black<div class="rounded-3xl h-3 w-3 bg-[#000000]"></div> </th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-200 uppercase tracking-wider">Drum<br>Cyan<div class="rounded-3xl h-3 w-3 bg-[#00ffff]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-200 uppercase tracking-wider">Drum<br>Magenta<div class="rounded-3xl h-3 w-3 bg-[#FF00FF]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-200 uppercase tracking-wider">Drum<br>Yellow<div class="rounded-3xl h-3 w-3 bg-[#ffff00]"></div></th>

                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-300 uppercase tracking-wider">Developer<br>Black<div class="rounded-3xl h-3 w-3 bg-[#000000]"></div> </th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-300 uppercase tracking-wider">Developer<br>Cyan<div class="rounded-3xl h-3 w-3 bg-[#00ffff]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-300 uppercase tracking-wider">Developer<br>Magenta<div class="rounded-3xl h-3 w-3 bg-[#FF00FF]"></div></th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 bg-gray-300 uppercase tracking-wider">Developer<br>Yellow<div class="rounded-3xl h-3 w-3 bg-[#ffff00]"></div></th>

                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fusor</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transfer<br>Kit</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cleaning<br>Kit</th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waster<br>Collector</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Odd row -->
                        <tr class="bg-white">
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">PV Santa Clara</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">NHDBDFH5645</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">100%</td>
                        </tr>


                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Fin Table-->
</div>
