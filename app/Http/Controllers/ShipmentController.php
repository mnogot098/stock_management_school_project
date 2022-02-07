<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\ShipmentTypes;
use App\Models\Product;
use App\Models\Invoice;
class ShipmentController extends Controller
{
    /**
     * Displaying a list of the shipments
    */
    function index(){
        $shipments = Shipment::orderBy('date', 'DESC')->paginate(4);
        return view('shipments.index', ['shipments' => $shipments]);
    }

    /**
     * Displaying the form for adding a new shipment
    */
    function add(){ 
        // Retrieving shipment types
        $shipmentTypes = ShipmentTypes::get();
        // Retrieving products
        $products = Product::get();
        //Passing Data to the view                                 
        return view('shipments.add', ['shipmentTypes' => $shipmentTypes, 'products' => $products]);
    }

    /**
     * Storing the newly added shipment
     */
    function store(Request $request){
        //Validating input
        $request->validate([
           'date' => 'required|date',
           'shipment_type_id' => 'required',
           'quantity' => 'required',
           'product_id' => 'required',
           'total_price' => 'required'
        ]);
        //When the quantity available in stock is insufficient when making an outgoing shipment
        $shipment_type = ShipmentTypes::find($request->shipment_type_id);
        if($shipment_type->type === "Outgoing"){
            $product = Product::select('quantity')->where('id',$request->product_id)->first();
            if($request->quantity > $product->quantity){
                return back()->withErrors('The quantity available in stock is insufficient (in stock : '.$product->quantity.')');
            }
        }
        //store the newly added product and return a success message
        Shipment::create($request->all());
        return redirect()->back()->with('success', 'Shipment added successfully!');
    }

    /**
     * Displaying the form for updating a shipment
    */
    function edit($id){
        // Retrieving shipment types
        $shipmentTypes = ShipmentTypes::get();
        // Retrieving products
        $products = Product::get();
        //Retrieving the product info 
        $shipment = Shipment::find($id);
        return view('shipments.edit', ['shipment' => $shipment, 'shipmentTypes' => $shipmentTypes, 'products' => $products]);
    }

    /**
     * Updating a shipment
    */
    function update(Request $request, $id){
        //Validation 
        $request->validate([
            'date' => 'required|date',
            'shipment_type_id' => 'required',
            'quantity' => 'required',
            'product_id' => 'required',
            'total_price' => 'required'
         ]);
        // Retrieving the shipment
        $shipment = Shipment::find($id);
        //Updating the fields
        $shipment->date =  $request->date;
        $shipment->shipment_type_id = $request->shipment_type_id;
        $shipment->product_id = $request->product_id;
        //When the quantity available in stock is insufficient when making an outgoing shipment
        if($shipment->shipment_type->type === "Outgoing"){
            
            if($request->quantity > $shipment->product->quantity){
                return back()->withErrors('The quantity available in stock is insufficient(in stock : '.$shipment->product->quantity.')');
            }
        }
        $shipment->quantity = $request->quantity;
        $shipment->total_price = $request->total_price;
        $shipment->save();
        //If updated successully redirect back with success message
        return back()->with('success', 'Shipment updated successfully!');
    }

    /**
     * Marking a shipment as complete and change database data accordingly
     */
    function markAsComplete($id){
        // Retrieving the shipment
        $shipment = Shipment::find($id);
        //updating database
        if($shipment->shipment_type->type === "Outgoing"){
            //Subtract the quantity from stock
            $shipment->product->quantity -= $shipment->quantity;
            $shipment->product->save();

        }else if($shipment->shipment_type->type === "Incoming"){
            //Add the quantity to stock
            $shipment->product->quantity += $shipment->quantity;
            $shipment->product->save();
            //Create an incoice
            $invoice = new Invoice;
            $invoice->supplier_id = $shipment->product->supplier_id;
            $invoice->amount = $shipment->total_price;
            $invoice->save();
        }
        //mark the shipment as complete in database
        $shipment->finalized = 1;
        $shipment->save();
        return back();
    }

    /**
     * Deleting a shipment 
    */
    function delete($id){
        //Retrieving the shipment from database and deleting it
        Shipment::destroy($id);
        return back();
    }
}
