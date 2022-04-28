<?php


use Illuminate\Support\Facades\DB;



function getDataModels($user, $models)
{
    $acceso = validateUser($user);

    switch ($models) {
        case 'App\Models\Expense':
            if ($acceso == 1) {
                $data = $models::where('status', true)->paginate(10);
            } else {
                $data = $models::where('status', true)->where('office_id', $user->office_id)
                    ->paginate(10);
            }
            return $data;

        case 'App\Models\Client':
            if ($acceso == 1) {
                $data = $models::select(DB::raw("CONCAT(name,' ',last_name,' ',second_last_name)As name"), 'id')->pluck('name', 'id');
            } else {
                $data = $models::where('office_id', $user->office_id)
                    ->select(DB::raw("CONCAT(name,' ',last_name,' ',second_last_name)As name"), 'id')->pluck('name', 'id');
            }
            return $data;

        case 'App\Models\Credit':
            if ($acceso == 1) {
                $data = $models::orderBy('id', 'DESC')->paginate(5);
            } else {
                $data = $models::join('clients', 'clients.id', 'credits.client_id')->where('clients.office_id', $user->office_id)
                    ->orderBy('credits.id', 'DESC')->paginate(5);
            }
            return $data;
        case 'App\Models\Office':
            if ($acceso == 1) {
                $data = $models::join('businesses', 'businesses.id', '=', 'offices.business_id')
                    ->select(DB::raw("CONCAT(offices.name, ' - ',businesses.name) AS name"), 'offices.id')->pluck('name', 'id');
            } else {
                $data = $models::join('businesses', 'businesses.id', '=', 'offices.business_id')
                    ->where('offices.id', $user->office_id)
                    ->select(DB::raw("CONCAT(offices.name, ' - ',businesses.name) AS name"), 'offices.id')->pluck('name', 'id');
            }
            return $data;

        case 'App\Models\User':
            if ($acceso == 1) {
                $data = $models::all();
            } else {
                $data = $models::where('office_id', $user->office_id)->get();
            }
            return $data;

        default:
            return 'No existe el modelo';
    }
}

function getDataModelsSearch($user, $models, $search)
{

    $acceso = validateUser($user);
    switch ($models) {
        case 'App\Models\User':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->where('id', '!=', $user->id)
                                        ->paginate(5);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->orWhere('last_name', 'like' . '%', $search . '%')->orWhere('second_last_name', 'like' . '%', $search . '%')
                                        ->where('office_id', $user->office_id)->paginate(5);
                                }
                                 return $data;

        case 'App\Models\Warehouse':
                                    if ($acceso == 1) {
                                        $data = $models::where('title', 'like', '%' . $search . '%')->paginate(5);
                                    } else {
                                        $data = $models::where('title', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(5);
                                    }
                                   return $data;

        case 'App\Models\Category':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->paginate(5);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(5);
                                }
                                return $data;

        case 'App\Models\Vendor':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->paginate(5);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(5);
                                }
                                return $data;

        case 'App\Models\Product':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->paginate(10);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(10);
                                }
                                    return $data;

        case 'App\Models\Service':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->paginate(10);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(10);
                                }
                                  return $data;

        case 'App\Models\Client':
                                if ($acceso == 1) {
                                    $data = $models::where('name', 'like', '%' . $search . '%')->paginate(1);
                                } else {
                                    $data = $models::where('name', 'like' . '%', $search . '%')->where('office_id', $user->office_id)->paginate(10);
                                }
                               return $data;

        case 'App\Models\Credit':
                                if ($acceso == 1) {
                                    $data = $models::join('clients', 'clients.id', 'credits.client_id')->where('clients.name', 'like', '%' . $search . '%')
                                        ->select(
                                            DB::raw("CONCAT(clients.name, '  ',clients.last_name, ' ',clients.second_last_name) AS client"),
                                            'credits.id',
                                            'credits.amount',
                                            'credits.created_at',
                                            'credits.available'
                                        )
                                        ->paginate(5);
                                } else {
                                    $data = $models::join('clients', 'clients.id', 'credits.client_id')
                                        ->where('id', 'like' . '%', $search . '%')->where('office_id', $user->office_id)
                                        ->select(
                                            DB::raw("CONCAT(clients.name, '  ',clients.last_name, ' ',clients.second_last_name) AS client"),
                                            'credits.id',
                                            'credits.amount',
                                            'credits.created_at',
                                            'credits.available'
                                        )
                                        ->paginate(5);
                                }
                                return $data;

        case 'App\Models\Sale':
                            if($acceso == 1){
                                $data = $models::where('folio','like','%'.$search.'%')->paginate(5);
                            }
                            return $data;
        case 'App\Models\Quote':
                            if($acceso == 1){
                                $data = $models::where('folio','like','%'.$search.'%')->paginate(1);
                            }
                            return $data;
        default:
            return 'No existe el modelo';
            break;
    }
}
function validateUser($user)
{
    if ($user->id == 1) {
        return true;
    } else {
        return false;
    }
}



// Address
// Business
// Buy
// BuyInventory
// CashRegister
// Category
// Client
// ClientHasFile
// CostPrice
// Credit
// Expense
// ExpenseHasSale
// ExpenseHasSaleHasCostPrice
// File
// Inventory
// Office
// Payment
// Product
// Quote
// QuoteCostService
// Sale
// SaleHasCostPrice
// SaleHasCredit
// SaleHasService
// Service
// Shipment
// ShipmentHasInventory
// Transfer
// TransferInventory
// Trolley
// User
// UserHasCashRegister
// UserHasCashRegisterHasCostPrice
// Vendor
// VendorHasProduct
// VendorHasProductHasFile
// Warehouse