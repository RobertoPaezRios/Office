<x-app-layout>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

  <!-- SPINNER -->
  <div class="text-center mt-10" id="spinner">
    <div role="status">
      <svg aria-hidden="true" class="inline w-20 h-20 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
      </svg>
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- SPINNER JS -->
  <script>
    window.onload = () => {
      const spinner = document.getElementById('spinner');  

      spinner.classList.add('hidden');
    }
  </script>

  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Operations') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid orange">
        PERSONAL PAGE
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="flex overflow-hidden bg-white">
          <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto">
            <main>
              <div class="px-4 py-4">
                <!-- LEVEL PROGRESS BAR -->
                <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                  <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold leading-none text-gray-900">Current Level</h3>
                  </div>
                  <div class="flow-root">
                    <div class="mb-1 text-lg font-medium">Total Income this Year</div>
                    <div class="flex items-center">
                      <span class="mr-2 font-medium">{{number_format($total, 2, ',', '.')}}€</span>
                      <div class="relative w-full">
                        <div class="w-full bg-gray-200 rounded-full h-5">
                            <div class="bg-green-500 h-5 rounded-full" style="width: {{($total / 30000) * 100}}%; max-width: 100%;"></div>
                        </div>
                      </div>
                      <span class="ml-2 font-medium">30.000€</span>
                    </div>
                  </div>
                </div>
              
                <!-- SALES CHART AND COMMISSION DISTRIBUTION-->
                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                  <!-- SALES CHART -->
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                      <div class="flex items-center justify-between mb-4">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($total, 2, ',', '.')}} €</span>
                            <br><h3 class="text-base font-normal text-gray-500 inline-block">My Sales: </h3>
                            <span>{{$nSales}}</span>
                        </div>
                        <div class="flex items-center justify-end flex-1">
                          @if ($nSales > 0)
                            <span class="text-green-500 text-base font-bold">
                              {{number_format(100 / $nSales, 2, ',', '.')}} %
                            </span>
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          @else
                            0%
                          @endif 
                        </div>
                      </div>
                      <div>
                        <canvas id="main-chart"></canvas>
                      </div>
                  </div>
                  <!-- COMMISSION DISTRIBUTION -->
                  <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Distribution of Commissions</h3>
                    <div class="block w-full overflow-x-auto">
                      <table class="items-center w-full bg-transparent border-collapse">
                          <thead>
                            <tr>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-100">
                            <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                                <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                  <div class="flex items-center">
                                      <span class="mr-2 text-xs font-medium">30%</span>
                                      <div class="relative w-full">
                                        <div class="w-full bg-gray-200 rounded-sm h-2">
                                            <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                        </div>
                                      </div>
                                  </div>
                                </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                </div>
              </div>

                <!-- SIP INCOME -->
                <div class="w-full grid grid-cols-1 mb-8 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                  <div class="bg-white shadow rounded-lg mb-4 mt-4 p-4 sm:p-6 h-full">
                    <div class="flex items-center justify-between mb-4">
                      <h3 class="text-xl font-bold leading-none text-gray-900">My Income from S.I.P.</h3>
                    </div>
                    <div class="flow-root">
                      <ul role="list" class="divide-y divide-gray-200">
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Neil Sims
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $320
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/bonnie-green.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Bonnie Green
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d4b1b9b5bdb894a3bdbab0a7a0b1a6fab7bbb9">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $3467
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/michael-gough.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Michael Gough
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="57323a363e3b17203e3933242332257934383a">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $67
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/thomas-lean.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Thomes Lean
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="284d45494144685f41464c5b5c4d5a064b4745">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $2367
                            </div>
                          </div>
                        </li>
                        <li class="pt-3 sm:pt-4 pb-0">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/lana-byrd.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Lana Byrd
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a2c7cfc3cbcee2d5cbccc6d1d6c7d08cc1cdcf">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $367
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="bg-white shadow rounded-lg mb-4 mt-4 p-4 sm:p-6 h-full">
                    <div class="flex items-center justify-between mb-4">
                      <h3 class="text-xl font-bold leading-none text-gray-900">Total Income from S.I.P.</h3>
                    </div>
                    <div class="flow-root">
                      <ul role="list" class="divide-y divide-gray-200">
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Neil Sims
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $320
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/bonnie-green.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Bonnie Green
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d4b1b9b5bdb894a3bdbab0a7a0b1a6fab7bbb9">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $3467
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/michael-gough.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Michael Gough
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="57323a363e3b17203e3933242332257934383a">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $67
                            </div>
                          </div>
                        </li>
                        <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/thomas-lean.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Thomes Lean
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="284d45494144685f41464c5b5c4d5a064b4745">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $2367
                            </div>
                          </div>
                        </li>
                        <li class="pt-3 sm:pt-4 pb-0">
                          <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                              <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/lana-byrd.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate">
                                Lana Byrd
                              </p>
                              <p class="text-sm text-gray-500 truncate">
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a2c7cfc3cbcee2d5cbccc6d1d6c7d08cc1cdcf">[email&#160;protected]</a>
                              </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                              $367
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <hr class="mt-4 mb-4">
                    <div class="flex items-center justify-between mb-4">
                      <h3 class="text-xl font-bold leading-none text-gray-900">
                        Total: 1980$
                      </h3>
                    </div>
                  </div>
                </div>

                <!-- SALES TABLE -->
                {{--<div class="bg-white w-full shadow mt-4 rounded-lg p-4 sm:p-6 h-full">
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
                            Last Year
                            <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                          </button>
                          
                          <!-- Dropdown menu -->
                          <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                              <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                  <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="filter-radio-example-1" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last 6 Months</label>
                                </div>
                              </li>
                              <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                  <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="filter-radio-example-2" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last 3 Months</label>
                                </div>
                              </li>
                              <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                  <input id="filter-radio-example-3" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="filter-radio-example-3" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last Month</label>
                                </div>
                              </li>
                              <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                  <input id="filter-radio-example-4" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="filter-radio-example-4" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last 2 Weeks</label>
                                </div>
                              </li>
                              <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                  <input id="filter-radio-example-5" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="filter-radio-example-5" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last Week</label>
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
                </div>--}}
                @livewire('filter-operations')
              </div>
            </main>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CHART JS -->
  <script>
    const ctx = document.getElementById('main-chart').getContext('2d');

    //GRADIENT
    let gradient = ctx.createLinearGradient(0, 0, 200, 0);
    gradient.addColorStop(0, "rgba(255, 0, 174, 0.3)");
    gradient.addColorStop(1, "rgba(194, 0, 255, 1)");
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          @foreach ($sales as $sale)
            @json($details[$sale->id]->date),
          @endforeach
        ],
        datasets: [{
          label: 'Sale Commission',
          data: [
            @foreach ($sales as $sale)
              @json ($income[$sale->id]),
            @endforeach
          ],
          borderWidth: 2,
          tension: 0.3,
          borderColor: gradient,
          pointBackgroundColor: '#fff'
        }]
      },
      options: {
        radius: 3,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return value + '€';
              }
            }
          }
        }
      }
    });
  </script>
                  
</x-app-layout>