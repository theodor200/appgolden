<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedido suministros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Obtener información de los pedidos de suministros</h3>
                    <p class="mt-1 max-w-2xl text-lg text-gray-500">Tener en cuenta la siguiente información:</p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Primer paso:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Deberás descargar un reporte de DCC llamado <b>Supply Order History</b> o <b>Historial de pedido de suministros</b>, esta opcion
                            esta dentro del menú principal opcion <b>Reports</b> o <b>Informes</b></dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Segundo paso:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <p>Del informe descargado en el archivo de Excel, deberás conservar y renombrar solo las siguientes columnas :</p><br>
                                <ul class="space-y-2 list-disc pl-6">
                                    <li>Crear la primera columna con el título <b>cliente</b></li>
                                    <li>TRACKING_NO renombrar a <b>nota_venta</b></li>
                                    <li>DEV_SERIAL_NO renombrar a <b>serie</b></li>
                                    <li>DEV_MODEL_NO renombrar a <b>numero_modelo</b></li>
                                    <li>DEV_MODEL_NAME renombrar a <b>modelo</b></li>
                                    <li>ORDER_ID renombrar a <b>order_dcc</b></li>
                                    <li>STATUS renombrar a <b>order_estado_dcc</b></li>
                                    <li>SOURCE renombrar a <b>order_tipo_dcc</b></li>
                                    <li>ORD_PART_NO renombrar a <b>numero_suministro</b></li>
                                    <li>ORD_PART_DESC renombrar a <b>suministro</b></li>
                                    <li>NAME1 renombrar a <b>cliente_dcc</b></li>
                                    <li>NAME2 renombrar a <b>site_dcc</b></li>
                                    <li><b>Borrar el resto de columnas y conservar las que se indican lineas arriba</b></li>
                                </ul>
                                <br>
                                <span><b>Importante:</b> Las columnas con datos vacios, dejarlos así. El titulo de cada columna debe ser en minusculas</span>
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Tercer paso:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Subir tu archivo de Excel con el formato indicado y dar click en el boton <b>Subir</b>, solo se permite archivos con extensión <b>.xlsx</b>,
                            otro tipo de extensiones ocasionarán un error al procesar los datos.</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Cuarto paso:</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">El archivo subido no se almacenará, tampoco se creará un historial. El sistema toma como clave unica el campo <b>order_dcc</b> de tu archivo de Excel,
                            esto significa que si tu archivo de Excel contiene un <b>order_dcc</b> que ya existe en la base de datos procederá con actualizar ese registro con los valores de la fila. Caso contrario, si no existe registro,
                            se creará uno nuevo.</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">
                <!--<x-jet-welcome />-->
                <form action="{{ route('upload.excel') }}" method="post" enctype="multipart/form-data" class="w-3/4 space-y-8 divide-y divide-gray-200">
                    @csrf
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            @if(Session::has('message'))
                                <div class="rounded-md bg-green-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-medium text-green-800">Archivo de Excel procesado.</h3>
                                            <div class="mt-2 text-md text-green-700">
                                                <p>{{ Session::get('message') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="location" class="block text-sm font-medium text-gray-700"><b>Cliente:</b> <br>Importante, tu archivo de Excel no debe contener pedidos ajenos al cliente seleccionado, caso contrario el sistema dara un error.</label>
                                    <select id="location" name="cliente" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                        <option value="">Seleccione un cliente</option>

                                        @foreach(App\Models\CookieCliente::all() as $cookie)
                                            <option value="{{ $cookie->id }}">{{ $cookie->cliente }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="cover-photo" class="block text-sm font-medium text-gray-700"> Subir archivo</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Elegir archivo</span>
                                                    <input id="file-upload" name="file-upload" type="file" required>
                                                </label>

                                            </div>
                                            <p class="text-xs text-gray-500">.xlsx 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <a href="{{ route('pedidos') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancelar</a>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Subir archivo y procesar datos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
