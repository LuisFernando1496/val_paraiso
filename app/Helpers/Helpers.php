<?php
use App\Models\Address;
use App\Models\Business;
use App\Models\Buy;
use App\Models\BuyInventory;
use App\Models\CashRegister;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientHasFile;
use App\Models\CostPrice;
use App\Models\Credit;
use App\Models\Expense;
use App\Models\ExpenseHasSale;
use App\Models\ExpenseHasSaleHasCostPrice;
use App\Models\File;
use App\Models\Inventory;
use App\Models\Office;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteCostService;
use App\Models\Sale;
use App\Models\SaleHasCostPrice;
use App\Models\SaleHasCredit;
use App\Models\SaleHasService;
use App\Models\Service;
use App\Models\Shipment;
use App\Models\ShipmentHasInventory;
use App\Models\Transfer;
use App\Models\TransferInventory;
use App\Models\Trolley;
use App\Models\User;
use App\Models\UserHasCashRegister;
use App\Models\UserHasCashRegisterHasCostPrice;
use App\Models\Vendor;
use App\Models\VendorHasProduct;
use App\Models\VendorHasProductHasFile;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;



function getDataModels($user, $models)
{
    $acceso = validateUser($user);
   
    switch ($models) {
        case 'App\Models\Expense': 
                                if($acceso == 1){
                                    $data = $models::pluck('title', 'id');
                                }else{
                                    $data = $models::where('office_id', $user->office_id)
                                    ->pluck('title', 'id');
                                }
                                return $data;

        case 'App\Models\Client':
                                if($acceso == 1){
                                    $data = $models::select(DB::raw("CONCAT(name,' ',last_name,' ',second_last_name)As name"), 'id')->pluck('name', 'id');
                                }else{
                                    $data = $models::where('office_id', $user->office_id)
                                    ->select(DB::raw("CONCAT(name,' ',last_name,' ',second_last_name)As name"), 'id')->pluck('name', 'id');
                                }
                                return $data;

        case 'App\Models\Credit':
                                if($acceso == 1){
                                    $data = $models::orderBy('id','DESC')->paginate(5);
                                }else{
                                    $data = $models::join('clients','clients.id','credits.client_id')->where('clients.office_id', $user->office_id)
                                    ->orderBy('credits.id','DESC')->paginate(5);
                                }

                                return $data;
        

        default:
            return 'No existe el modelo';
    }
}
function validateUser($user)
{
    if ($user->id == 1 ) {
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