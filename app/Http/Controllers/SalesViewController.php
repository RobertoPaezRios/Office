<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Team;
use App\Models\Detail;
use App\Models\Sale;
use App\Models\Membership;
use App\Models\Level;
use App\Models\Collaborator;

use App\Services\Sales\SalesService;
use App\Services\Team\TeamService;
use App\Services\Sales\ListerService;
use App\Services\Sales\SellerService;
use App\Services\Levels\LevelService;
use App\Services\Sales\DetailService;

use App\Services\Team\PersonalTeamService;

class SalesViewController extends Controller
{
    private $salesService;
    private $teamService;
    private $listerService;
    private $sellerService;
    private $levelService;
    private $detailService;

    private $personalTeamService;

    public function __construct (SalesService $salesService, TeamService $teamService, ListerService $listerService, SellerService $sellerService, LevelService $levelService, DetailService $detailService, PersonalTeamService $personalTeamService) {
        $this->salesService = $salesService;
        $this->teamService = $teamService;
        $this->listerService = $listerService;
        $this->sellerService = $sellerService;
        $this->levelService = $levelService;
        $this->detailService = $detailService;
        
        $this->personalTeamService = $personalTeamService;
    }

    public function index () {
        $user = Auth::user();
        if ($user->current_team_id == null) return view('dashboard');
        $team = $this->teamService->getTeam($user->current_team_id);

        if ($this->teamService->isPersonal($team)) {
            if ($this->personalTeamService->display($user)['status'] == 'ok') {
                return view ('operations.operations', [
                    'role' => $this->personalTeamService->display($user)['role'],
                    'sales' => $this->personalTeamService->display($user)['sales'],
                    'listers' => $this->personalTeamService->display($user)['listers'],
                    'sellers' => $this->personalTeamService->display($user)['sellers'],
                    'details' => $this->personalTeamService->display($user)['details'],
                    'income' => $this->personalTeamService->display($user)['income'],
                    'total' => $this->personalTeamService->display($user)['total'],
                    'nSales' => $this->personalTeamService->display($user)['nSales']
                ]);
            }  

            return view('operations.operations', [
                'role' => 'Personal Page',
                'total' => 0,
                'nSales' => 0, 
                'sales' => Sale::where('team_id', $team->id)->paginate(4)
            ]);

            /*return view('operations.operations', [
                'sales' => $sales,
                'role' => 'admin'
            ]);*/
            /*$sales = $this->salesService->getMySalesWithPaginate($user, 4);

            /*if (!empty($sales)) {   
                $listers = [];
                $sellers = [];
                $details = [];
                $nSales = 0;
                $income = [];
                $level = $this->levelService->getLevel($user);
                $total = 0;

                foreach ($sales as $key => $sale) {
                    $listers[] = $this->listerService->getLister($sale);
                    $sellers[] = $this->sellerService->getSeller($sale);
                    $details[] = $this->detailService->getSaleDetail($sale);
                    $auxComm[] = $this->salesService->getCommission($sale);

                    $this->salesService->iParticipate($sale, $user) ? $nSales++ : 0;

                    //IF THERE WERE ANY COLLABORATOR THE COMMISION IS DISTRIBUTED
                    if (!empty($this->salesService->getCollaborators($sale))) {
                        $collaborators = $this->salesService->getCollaborators($sale);
                        $auxComm[$key] -= $this->salesService->collaboratorsAmount($collaborators);
                    }
                    
                    $income[] = ($this->salesService->getAmount($sale) / 100) * (($auxComm[$key] / 10000) * (($level[0]->level / 100) / 2));
                    
                    if ($this->sellerService->getSeller($sale)->id == $user->id && $this->listerService->getLister($sale)->id == $user->id) {
                        $income[$key] *= 2;
                    }

                    $total += $income[$key];
                }

                return view ('operations.operations', [
                    'sales' => $sales, 
                    'listers' => $listers, 
                    'sellers' => $sellers, 
                    'role' => 'Personal Page', 
                    'details' => $details,
                    'income' => $income,
                    'total' => $total,
                    'nSales' => $nSales
                ]);
            } */
        }

        if (isset($team->owner)) {
            //DUEÑO
            if ($user->id == $team->owner->id) {
                $members = $team->users;
                $sales = Sale::where('team_id', $team->id)->paginate(4);
                $myLevel = Level::where('user_id', $user->id)->get();

                if (count($sales) != 0) {   
                    $listers = [];
                    $sellers = [];
                    $details = [];
                    $nSales = 0;
                    $income = [];
                    $levels = [];
                    $total = 0;

                    $levels [] = $myLevel;

                    foreach ($members as $member) {
                        $levels[$member->id] = Level::where('user_id', $member->id)->where('team_id', $team->id)->get();
                    }

                    foreach ($sales as $key => $sale) {
                        $listers[] = $sale->lister;
                        $sellers[] = $sale->seller;
                        $details[] = $sale->detail;
                        $auxComm[] = $sale->commission;
                        
                        $nSales++;
    
                        foreach ($sale->collaborators as $collaborator) {
                            $auxComm[$key] -= $collaborator->commission;
                        }

                        //THE SAME AGENT IS THE SELLER AND LISTER, INCOME * 2
                        if ($listers[$key]->id == $sellers[$key]->id) {
                            $income[] = ($sale->amount / 100) * (($auxComm[$key] / 10000) * ($levels[$listers[$key]->id][0]->level / 100));
                        } else {
                            $income[] = ($sale->amount / 100) * ($auxComm[$key] / 10000);
                        }
                        
    
                        $total += $income[$key];
                    }

                    return view ('operations.operations', [
                        'sales' => $sales, 
                        'listers' => $listers, 
                        'sellers' => $sellers, 
                        'role' => 'admin', 
                        'details' => $details,
                        'income' => $income,
                        'total' => $total,
                        'nSales' => $nSales
                    ]);
                } 

                return view('operations.operations', [
                    'sales' => $sales,
                    'role' => 'admin',
                    'income' => 0,
                    'total' => 0,
                    'nSales' => 0
                ]);
                
            } else {
                $member = Membership::where('user_id', $user->id)->where('team_id', $team->id)->get();

                if ($member[0]->role != 'agent') {
                    $members = $team->users;
                    $sales = Sale::where('team_id', $team->id)->paginate(4);

                    if (!empty($sales)) {   
                        $listers = [];
                        $sellers = [];
                        $details = [];
                        $nSales = 0;
                        $income = [];
                        $level = Level::where('user_id', $user->id)->get();
                        $total = 0;
    
                        foreach ($sales as $key => $sale) {
                            $listers[] = $sale->lister;
                            $sellers[] = $sale->seller;
                            $details[] = $sale->detail;
                            $auxComm[] = $sale->commission;
                            $nSales++;
        
                            foreach ($sale->collaborators as $collaborator) {
                                $auxComm[$key] -= $collaborator->commission;
                            }
                            
                            $income[] = ($sale->amount / 100) * (($auxComm[$key] / 10000) * (($level[0]->level / 100) / 2));
        
                            $total += $income[$key];
                        }
    
                        return view ('operations.operations', [
                            'sales' => $sales, 
                            'listers' => $listers, 
                            'sellers' => $sellers, 
                            'role' => 'admin', 
                            'details' => $details,
                            'income' => $income,
                            'total' => $total,
                            'nSales' => $nSales
                        ]); 
                    } else {
                        return view('operations.operations', [
                            'sales' => $sales,
                            'role' => 'admin'
                        ]);
                    }
                } else {
                    $sales = Sale::where('seller_id', $user->id)->orwhere('lister_id', $user->id)->where('team_id', $user->current_team_id)->paginate(4);
                
                    if (!empty($sales)) {   
                        $listers = [];
                        $sellers = [];
                        $details = [];
                        $nSales = 0;
                        $income = [];
                        $level = Level::where('user_id', $user->id)->get();
                        $total = 0;
    
                        foreach ($sales as $key => $sale) {
                            $listers[] = $sale->lister;
                            $sellers[] = $sale->seller;
                            $details[] = $sale->detail;
                            $auxComm[] = $sale->commission;
        
                            if ($sale->lister->id == $user->id || $sale->seller->id == $user->id) {
                                $nSales++;
                            }
        
                            foreach ($sale->collaborators as $collaborator) {
                                $auxComm[$key] -= $collaborator->commission;
                            }
                            
                            $income[] = ($sale->amount / 100) * (($auxComm[$key] / 10000) * (($level[0]->level / 100) / 2));
                            
                            if ($sale->seller->id == $user->id && $sale->lister->id == $user->id) {
                                $income[$key] *= 2;
                            }
        
                            $total += $income[$key];
                        }
    
                        return view ('operations.operations', [
                            'sales' => $sales, 
                            'listers' => $listers, 
                            'sellers' => $sellers, 
                            'role' => 'agent', 
                            'details' => $details,
                            'income' => $income,
                            'total' => $total,
                            'nSales' => $nSales
                        ]); 
                    } else {
                        return view('operations.operations', [
                            'sales' => $sales, 
                            'role' => 'agent'
                        ]);
                    }
                }
            }
        } else {
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');
    }
}
