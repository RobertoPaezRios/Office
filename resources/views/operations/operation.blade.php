<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Operation Detailed View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-gray-900 inline-block">Date: </h4>
                            <span>{{$detail['date']}}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 inline-block">Lister: </h4>
                            <span>{{$lister->name}}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 inline-block">Seller: </h4>
                            <span>{{$seller->name}}</span>
                        </div>
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900 inline-block">Property:</h4>
                    <span>{{$detail['type']}}</span>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Location</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Address:</h5>
                        <span> {{$detail['address']}}</span><br>
                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Town:</h5>
                        <span> {{$detail['town']}}</span>
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Buyers</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        @foreach ($buyers as $key => $buyer)
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Buyer {{++$key}}:</h5>
                                <span> {{$buyer->name}}</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">C.I.F:</h5>
                                <span> {{$buyer->nif}}</span><br>
                            </div>
                        </div>
                        @endforeach
                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Address:</h5>
                        <span> {{$buyer->address}}</span><br>
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Town:</h5>
                                <span> {{$buyer->town}}</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Phone:</h5>
                                <span> {{$buyer->phone}}</span><br>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Sellers</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        @foreach ($sellers as $key => $seller)
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Seller {{++$key}}:</h5>
                                <span> {{$seller->name}}</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">C.I.F:</h5>
                                <span> {{$seller->nif}}</span><br>
                            </div>
                        </div>
                        @endforeach
                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Address:</h5>
                        <span> {{$seller->address}}</span><br>
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Town:</h5>
                                <span> {{$seller->town}}</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Phone:</h5>
                                <span> {{$seller->phone}}</span><br>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Collaborators</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        @foreach ($collaborators as $key => $collaborator)
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Collaborator {{++$key}}:</h5>
                                <span> {{$collaborator->name}}</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Commission:</h5>
                                <span> {{number_format($collaborator->commission / 100, 2, ',', '.')}}%</span><br>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Economic Data</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Amount:</h5>
                                <span> {{number_format($sale->amount / 100, 2, ',', '.')}} €</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Commission Type:</h5>
                                <span>{{number_format($sale->commission / 100, 2, ',', '.')}} %</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Commission:</h5>
                                <span>
                                    {{number_format(($sale->amount / 100) * ($sale->commission / 10000), 2, ',', '.')}}
                                    €</span><br>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Amount:</h5>
                                <span>
                                    {{number_format(($sale->amount / 100) * ($sale->commission / 10000), 2, ',', '.')}}
                                    €</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Percent:</h5>
                                <span> {{number_format($commType / 100, 2, ',', '.')}}%</span><br>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">Net Commission:</h5>
                                <span> {{number_format($netCommission, 2, ',', '.')}} €</span><br>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-5">
                    <h4 class="mt-5 font-bold text-gray-900">Distribution</h4>
                    <div style="border-left: 1px solid black; padding-left: 1.25rem; margin-top: 1rem;">
                        <div class="flex justify-between">
                            <div class="flex-justify-between">
                                <div class="flex gap-10">
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">% Lister:</h5>
                                        <span>{{$levels[0]->level}} %</span><br>
                                    </div>
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Lister:</h5>
                                        <span>{{number_format(($netCommission / 100) * ($levels[0]->level / 2), 2, ',', '.')}}
                                            €</span><br>
                                    </div>
                                    <div>
                                        <h5 class="mt-5">
                                            {{number_format($levels[0]->level / 2, 2, ',', '.')}} 
                                            %
                                        </h5>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">% Seller:</h5>
                                        <span>{{$levels[1]->level}} %</span><br>
                                    </div>
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Seller:</h5>
                                        <span>
                                            {{number_format(($netCommission / 100) * ($levels[1]->level / 2), 2, ',', '.')}}
                                            €</span><br>
                                    </div>
                                    <div>
																<h5 class="mt-5">
																	{{number_format($levels[1]->level / 2, 2, ',', '.')}} 
																	%
																</h5>
															</div>
                                </div>
                            </div>
                            <div class="mt-5"
                                style="border-radius: 5px;border: 2px solid black; width: 200px; text-align: center;">
                                <h1 class="p-5 font-bold text-gray-900">
                                    {{number_format((($netCommission / 100) * ($levels[0]->level / 2)) + (($netCommission / 100) * ($levels[1]->level / 2)), 2, ',', '.')}}
                                    €
                                </h1>
                            </div>
                        </div>
                        <hr class="mt-5">
                        <div class="flex justify-around">
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">
                                    S.I.P:
                                </h5>
                                <span>
                                    {{number_format($netCommission * 0.05, 2, ',', '.')}}
                                    €
                                </span>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">
                                    Support:
                                </h5>
                                <span>
                                    {{number_format($netCommission * 0.03, 2, ',', '.')}}
                                    €
                                </span>
                            </div>
                            <div>
                                <h5 class="mt-5 font-bold text-gray-900 inline-block">
                                    Marketing:
                                </h5>
                                <span>
                                    {{number_format($netCommission * 0.03, 2, ',', '.')}}
                                    €
                                </span>
                            </div>
                        </div>
                        <hr class="mt-5">
                        <div class="flex justify-between">
                            <div class="flex-justify-between">
                                <div class="flex gap-10">
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">% Franchise:</h5>
                                        <span>
                                            {{number_format(\App\Models\Team::FRANCHISE_COMM - (($levels[0]->level / 2) + ($levels[1]->level / 2)), 2, ',', '.')}}
                                            %
                                        </span><br>
                                    </div>
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Franchise:</h5>
                                        <span>
                                            {{number_format($netCommission * (\App\Models\Team::FRANCHISE_COMM - (($levels[0]->level / 2) + ($levels[1]->level / 2))) / 100, 2, ',', '.')}}
                                            €
                                        </span><br>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">% Central:</h5>
                                        <span>
                                            {{number_format(\App\Models\Team::CENTRAL, 2, ',', '.')}}
                                            %
                                        </span><br>
                                    </div>
                                    <div>
                                        <h5 class="mt-5 font-bold text-gray-900 inline-block">Central:</h5>
                                        <span>
                                            {{number_format($netCommission * \App\Models\Team::CENTRAL / 100, 2, ',', '.')}}
                                            €
                                        </span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5"
                                style="border-radius: 5px;border: 2px solid black; width: 200px; text-align: center;">
                                <h1 class="p-5 font-bold text-gray-900">
                                    {{number_format(($netCommission * \App\Models\Team::CENTRAL / 100) + ($netCommission * (\App\Models\Team::FRANCHISE_COMM - (($levels[0]->level / 2) + ($levels[1]->level / 2))) / 100), 2, ',', '.')}}
                                    €
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
