<?php 

use App\Customer;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', function() {
        $customers = Customer::orderBy('created_at', 'asc')->get();
        
        return view('customers', [
            'customers' => $customers
        ]);
    });

    Route::get('/customer/{phoneId}', function($phoneId) {
        $customer = Customer::where('phoneId', $phoneId)->first();
        return response()->json($customer);
    });

    Route::put('/customer/{phoneId}', function(Request $request, $phoneId) {
        $customer = Customer::where('phoneId', $phoneId)->first();
        if ($request->has('currentBalance')) {
            $customer->currentBalance = $request->currentBalance;
        }
        $customer->isBillPastDue = $request->isBillPastDue == "1" ? true : false;
        $customer->save();
        return redirect('/');
    });

    Route::post('/customer', function(Request $request) {
        $validator = Validator::make($request->all(), [
            'phoneId' => 'required|unique:customers|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'currentBalance' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('/')->withInput()
                ->withErrors($validator);
        }
        
        $customer = new Customer;
        $customer->phoneId = $request->phoneId;
        $customer->firstName = $request->firstName;
        $customer->lastName = $request->lastName;
        $customer->currentBalance = $request->currentBalance;
        $customer->isBillPastDue = $request->isBillPastDue == "1" ? true : false;
        $customer->save();

        return redirect('/');
    });

//});
