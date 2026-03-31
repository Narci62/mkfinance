@php
//fonction permettant de definir la bar de progession
function getprogress($project){
$investor = $project->investment->count();
$investor_needed = $project->totalFundedNeeded / $project->InvestmentAmountfix;

return ($investor*100) / $investor_needed;
}
@endphp