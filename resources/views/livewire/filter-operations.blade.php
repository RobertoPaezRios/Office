<div>
    <div class="bg-white w-full shadow mt-4 rounded-lg p-4 sm:p-6 h-full">
        <div class="mb-4 flex items-center justify-between">
          <div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Sales</h3>
            <span class="text-base font-normal text-gray-500">This is a list of latest sales</span>
          </div>
        </div>
        <div class="flex flex-col mt-8">
          <div class="overflow-x-auto rounded-lg">
            <div class="align-middle inline-block min-w-full">
              <div class="shadow overflow-hidden sm:rounded-lg">
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center mb-4 text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                  <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    Filter By Date
                  <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <!-- Dropdown menu -->
                <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                  <ul class="p-3 space-y-1 text-sm text-gray-700" aria-labelledby="dropdownRadioButton">
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100">
                          <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                          <label for="filter-radio-example-1" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last Year</label>
                        </div>
                      </li>
                    <li>
                      <div class="flex items-center p-2 rounded hover:bg-gray-100">
                        <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="filter-radio-example-1" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last 6 Months</label>
                      </div>
                    </li>
                    <li>
                      <div class="flex items-center p-2 rounded hover:bg-gray-100">
                        <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="filter-radio-example-2" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last 3 Months</label>
                      </div>
                    </li>
                    <li>
                      <div class="flex items-center p-2 rounded hover:bg-gray-100">
                        <input id="filter-radio-example-3" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="filter-radio-example-3" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last Month</label>
                      </div>
                    </li>
                    <li>
                      <div class="flex items-center p-2 rounded hover:bg-gray-100">
                        <input id="filter-radio-example-4" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="filter-radio-example-4" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last 2 Weeks</label>
                      </div>
                    </li>
                    <li>
                      <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <input id="filter-radio-example-5" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="filter-radio-example-5" class="w-full ml-2 text-sm font-medium text-gray-900 rounded">Last Week</label>
                      </div>
                    </li>
                  </ul>
                </div> 

                <table class="mt-3 min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                      </th>
                      <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Seller
                      </th>
                      <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lister
                      </th>
                      <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Commission
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                    @foreach ($sales as $sale)
                      <tr class="hover:bg-gray-100 hover:cursor-pointer" onclick="window.location.href='{{route('operation', $sale->id)}}'">
                        <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                          {{$details[$sale->id]->date}}
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                          <div class="flex">
                            <div class="text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                              <img class="h-8 w-8 rounded-full object-cover" src="{{ $sellers[$sale->id]->profile_photo_url }}" alt="{{ $sellers[$sale->id]->name }}" />
                            </div>
                            <span class="font-semibold pt-2 px-2">{{$sellers[$sale->id]->name}}</span>
                          </div>
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                          <div class="flex">
                            <div class="text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                              <img class="h-8 w-8 rounded-full object-cover" src="{{ $listers[$sale->id]->profile_photo_url }}" alt="{{ $listers[$sale->id]->name }}" />
                            </div>
                            <span class="font-semibold pt-2 px-2">{{$listers[$sale->id]->name}}</span>
                          </div>
                        </td>
                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                          <div class="flex">
                            <span class="font-semibold pt-2 px-2">{{number_format($income[$sale->id], 2, ',', '.')}}€</span>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
