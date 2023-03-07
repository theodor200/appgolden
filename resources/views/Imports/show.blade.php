<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver pedidos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 h-96">
            <div class="bg-white overflow-y-hidden shadow-xl sm:rounded-lg">
              <table class="block divide-y divide-gray-200 h-[800px] overflow-auto">
                  <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota de venta</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serie equipo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código modelo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo equipo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Orden DCC</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado orden DCC</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de orden DCC</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código suministro</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo suministro</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Site</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guía remisión</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido procesado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido preparado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido transito</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido zona</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido entregado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha escano guia</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha pedido rechazado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obsevaciones de pedido</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha actualización de registro</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                  </thead>
                  <tbody>
                  <!-- Odd row -->
                  @foreach($items as $item)
                      <tr class="bg-white">
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$item->cliente}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->nota_venta}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->serie}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->numero_modelo}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->modelo}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->order_dcc}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->order_estado_dcc}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->order_tipo_dcc}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->numero_suministro}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->suministro}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->cliente_dcc}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->site_dcc}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <a class="underline" href="https://www.ingrammicromps.com/hpmps/gd/{{$item->guia_remision}}.pdf" target="_blank">{{$item->guia_remision}}</a>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->procesado}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->preparado}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->transito}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->zona}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->entregado}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->digitalizado}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->rechazado}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->observaciones}}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$item->updated_at}}</td>

                      </tr>
                  @endforeach
                  <!-- More people... -->
                  </tbody>
              </table>
            </div>
        </div>
    </div>

</x-app-layout>
