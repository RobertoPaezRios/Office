<x-app-layout>
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
      <div class="flex justify-between gap-4">
        <span class="p-3 rounded-full bg-green-400 text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
          </svg>        
        </span> 
        <span class="font-semibold text-xl text-gray-800 leading-tight p-2" style="border-radius: 5px; border: 2px solid @if ($role == 'admin') green @elseif ($role == 'Personal Page') orange @else red @endif">
          {{strtoupper($role)}}
        </span>
      </div>
    </div>
  </x-slot>

  <script src="https://kit.fontawesome.com/1cddfb5520.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div>
                <div class="flex overflow-hidden bg-white">
                  <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto">
                      <main>
                        <div class="pt-4 px-4">
                          @if ($role == 'Personal Page')
                          <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                            <div class="flex items-center justify-between mb-4">
                              <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                              <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                              View all
                              </a>
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
                          @endif
                            <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                                  <div class="flex items-center justify-between mb-4">
                                    <div class="flex-shrink-0">
                                        <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($total, 2, ',', '.')}} €</span>
                                        <br><h3 class="text-base font-normal text-gray-500 inline-block">Team Sales this Month: </h3>
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
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                                <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
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
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                              <div class="flex items-center">
                                                  <span class="mr-2 text-xs font-medium">24%</span>
                                                  <div class="relative w-full">
                                                    <div class="w-full bg-gray-200 rounded-sm h-2">
                                                        <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </td>
                                        </tr>
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                              <div class="flex items-center">
                                                  <span class="mr-2 text-xs font-medium">18%</span>
                                                  <div class="relative w-full">
                                                    <div class="w-full bg-gray-200 rounded-sm h-2">
                                                        <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </td>
                                        </tr>
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                              <div class="flex items-center">
                                                  <span class="mr-2 text-xs font-medium">12%</span>
                                                  <div class="relative w-full">
                                                    <div class="w-full bg-gray-200 rounded-sm h-2">
                                                        <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </td>
                                        </tr>
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                              <div class="flex items-center">
                                                  <span class="mr-2 text-xs font-medium">9%</span>
                                                  <div class="relative w-full">
                                                    <div class="w-full bg-gray-200 rounded-sm h-2">
                                                        <div class="bg-indigo-600 h-2 rounded-sm" style="width: 9%"></div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </td>
                                        </tr>
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                                            <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                                            <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                                              <div class="flex items-center">
                                                  <span class="mr-2 text-xs font-medium">7%</span>
                                                  <div class="relative w-full">
                                                    <div class="w-full bg-gray-200 rounded-sm h-2">
                                                        <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
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
                            <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                                  <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                                        <h3 class="text-base font-normal text-gray-500">New products this week</h3>
                                    </div>
                                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                        14.6%
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                  </div>
                              </div>
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                                  <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                                        <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
                                    </div>
                                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                        32.9%
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                  </div>
                              </div>
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                                  <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                                        <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
                                    </div>
                                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                                        -2.7%
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
                              <!--<div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                                  <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold leading-none text-gray-900">Latest Customers</h3>
                                    <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                                    View all
                                    </a>
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

              
                                    <div class="mb-1 text-lg font-medium">Total Income this Year</div>
                                    <div class="flex items-center">
                                      <span class="mr-2 font-medium">20.000€</span>
                                      <div class="relative w-full">
                                        <div class="w-full bg-gray-200 rounded-full h-5">
                                            <div class="bg-green-500 h-5 rounded-full" style="width: 50%"></div>
                                        </div>
                                      </div>
                                      <span class="ml-2 font-medium">40.000€</span>
                                  </div>

                                  </div>
                              </div>-->
                              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
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
                                          <div class="p-2">
                                            {{$sales->links('pagination::tailwind')}}
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
                                                @foreach ($sales as $key => $sale)
                                                  <tr class="hover:bg-gray-100 hover:cursor-pointer" onclick="window.location.href='{{route('operation', $sale->id)}}'">
                                                    <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                                      {{$details[$key]->date}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                      <div class="flex">
                                                        <div class="text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                          <img class="h-8 w-8 rounded-full object-cover" src="{{ $sellers[$key]->profile_photo_url }}" alt="{{ $sellers[$key]->name }}" />
                                                        </div>
                                                        <span class="font-semibold pt-2 px-2">{{$sellers[$key]->name}}</span>
                                                      </div>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                      <div class="flex">
                                                        <div class="text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                          <img class="h-8 w-8 rounded-full object-cover" src="{{ $listers[$key]->profile_photo_url }}" alt="{{ $listers[$key]->name }}" />
                                                        </div>
                                                        <span class="font-semibold pt-2 px-2">{{$listers[$key]->name}}</span>
                                                      </div>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                      <div class="flex">
                                                        <span class="font-semibold pt-2 px-2">{{number_format($income[$key], 2, ',', '.')}}€</span>
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
                        </div>
                      </main>
                  </div>
                </div>
                <script>
                  const ctx = document.getElementById('main-chart');
                  new Chart(ctx, {
                    type: 'line',
                    data: {
                      labels: [
                        @foreach ($sales as $key => $sale)
                          @json($details[$key]->date),
                        @endforeach
                      ],
                      datasets: [{
                        label: 'Sale Commission',
                        data: [
                          @foreach ($sales as $key => $sale)
                            @json ($income[$key]),
                          @endforeach
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                </script>
                <script async defer src="https://buttons.github.io/buttons.js"></script>
                <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
              </div>
               
              {{--<div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                              Seller
                            </th>
                            <th scope="col" class="px-6 py-3">
                              Lister
                            </th>
                            <th scope="col" class="px-6 py-3">
                              Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                              Commission
                            </th>
                            <th scope="col" class="px-6 py-3">
                              Type
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($sales as $key => $sale)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              @if (isset($sellers))
                              {{$sellers[$key]->name}}
                              @endif
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              @if (isset($listers))
                              {{$listers[$key]->name}}
                              @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{number_format($sale->amount / 100, 2, ',', '.')}} €
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{number_format($sale->commission / 100, 2, ',', '.')}} €
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{$sale->type}}
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>--}}
          </div>
      </div>
  </div>
</x-app-layout>