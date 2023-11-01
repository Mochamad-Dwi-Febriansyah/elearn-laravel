<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\ClassModel;
use App\Models\SettingModel;
use App\Models\User;
use App\Models\StudentAddFeesModel; 
use Stripe\Stripe;
use Illuminate\Support\Facades\Session;  
use App\Exports\ExportCollectFees;
// use Maatwebsite\Excel;
use Maatwebsite\Excel\Facades\Excel;

class FeesCollectionController extends Controller
{ 
    public function collect_fees(Request $request){ 
        $data['getClass'] = ClassModel::getRecord(); 
        
        if(!empty($request->all())){
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        
        $data['header_title'] = "Collect Fees";
        return view('admin.fees_collection.collect_fees', $data);
    }
    public function collect_fees_report(){
        $data['getClass'] = ClassModel::getRecord();
        $data['getRecord'] = StudentAddFeesModel::getRecord(); 
        $data['header_title'] = "Collect Fees Report";
        return view('admin.fees_collection.collect_fees_report', $data);
    }

    public function export_collect_fees_report(Request $request){
        return Excel::download(new ExportCollectFees,  'CollectFeesReport_'.date('d-m-Y').'.xls');
    }
    public function collect_fees_add($student_id){
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Add Collect Fees";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id); 
        return view('admin.fees_collection.add_collect_fees', $data);
    }
    public function collect_fees_insert($student_id, Request $request){ 
        $getStudent = User::getSingleClass($student_id);

        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id); 

        if(!empty($request->amount)){
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount){     
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();
        
                return redirect()->back()->with('success', 'Fees successfully Add');
            }else{
                return redirect()->back()->with('error', 'Your Amount go to greather than remaining amount');
            }
        }else{
            return redirect()->back()->with('error', 'You need add your amount atleast 1$');
        }  
    }

    // student side

    public function CollectFeesStudent(Request $request){
        $student_id = Auth::user()->id;
        
        $data['getFees'] = StudentAddFeesModel::getFees($student_id); 
        
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        
        $data['header_title'] = "Fees Collection";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id); 
        return view('student.my_fees_collection', $data);
    }
    public function CollectFeesStudentPayment(Request $request){
        $getStudent = User::getSingleClass(Auth::user()->id);
        
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id); 
        
        if(!empty($request->amount)){
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount){                     
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();  

                if($request->payment_type == 'Paypal'){
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "Student Fees";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('student/paypal/payment-error');
                    $query['return'] = url('student/paypal/payment-success'); 
 
                    $query_string = http_build_query($query);

                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?'.$query_string);

                    exit();

                }elseif($request->payment_type == 'Stripe'){ 
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;
                    // dd($setApiKey);

                    Stripe::setApiKey($setApiKey); 
                    $finalprice = $request->amount * 100; 
                    
                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'unit_amount' => intval($finalprice),
                                'product_data' => [
                                    'name' => 'Student Fees',
                                    'description' => 'Student Fees',
                                    'images' => [ url('public/dist/img/user2-160x160.jpg') ],
                                ],
                            ],
                        'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('student/stripe/payment-success'),
                        'cancel_url' => url('student/stripe/payment-error'),
                    ]); 

                    $payment->stripe_session_id = $session['id'];
                    $payment->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = $setPublicKey;

                    return view('stripe_charge', $data);
 
                }
                // return redirect()->back()->with('success', 'Fees successfully Add');
            }else{
                return redirect()->back()->with('error', 'Your Amount go to greather than remaining amount');
            }
        }else{
            return redirect()->back()->with('error', 'You need add your amount atleast 1$');
        }
    }
    
    public function PaymentSuccessStripe(Request $request){
        $getSetting = SettingModel::getSingle();  
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first(); 
        \Stripe\Stripe::setApiKey($setApiKey);
        $getData = \Stripe\Checkout\Session::retrieve($trans_id);

        if(!empty($getData->id) && $getData->id == $trans_id && !empty($getFee) && $getData->status == 'complete' && $getData->payment_status == 'paid'){
                $getFee->is_payment = 1;
                $getFee->payment_data = json_encode($getData);
                $getFee->save();

                Session::forget('stripe_session_id');

                return redirect('student/fees_collection')->with('success', 'Your Payment Successfully');
        }else{
            return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
        }
    }
    public function PaymentError(){
        return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
    }
    public function PaymentSuccess(Request $request){
        if(!empty($request->item_number) && !empty($request->st) && $request->st == "Completed"){
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fees)){
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();

                return redirect('student/fees_collection')->with('error', 'Your Payment Succesfully');
            }else{
                return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
            }
        }else{
            return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
        }
    } 

// parent side
    public function CollectFeesStudentParent($student_id, Request $request){
        $data['getFees'] = StudentAddFeesModel::getFees($student_id); 
 
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        
        $data['header_title'] = "Fees Collection";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id); 
        return view('parent.my_fees_collection', $data);
    }
    public function CollectFeesStudentPaymentParent($student_id, Request $request){  
        $getStudent = User::getSingleClass($student_id);
        
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id); 
        
        if(!empty($request->amount)){
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount){                     
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();  

                if($request->payment_type == 'Paypal'){
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "Student Fees";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('parent/paypal/payment-error/' .$student_id);
                    $query['return'] = url('parent/paypal/payment-success/'.$student_id); 
 
                    $query_string = http_build_query($query);

                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?'.$query_string);

                    exit();

                }elseif($request->payment_type == 'Stripe'){
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;
                    // dd($setApiKey);

                    Stripe::setApiKey($setApiKey); 
                    $finalprice = $request->amount * 100; 
                    
                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'unit_amount' => intval($finalprice),
                                'product_data' => [
                                    'name' => 'Student Fees',
                                    'description' => 'Student Fees',
                                    'images' => [ url('public/dist/img/user2-160x160.jpg') ],
                                ],
                            ],
                        'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('parent/stripe/payment-success/'.$student_id),
                        'cancel_url' => url('parent/stripe/payment-error/' .$student_id),
                    ]); 

                    $payment->stripe_session_id = $session['id'];
                    $payment->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = $setPublicKey;

                    return view('stripe_charge', $data);
 
                }
                // return redirect()->back()->with('success', 'Fees successfully Add');
            }else{
                return redirect()->back()->with('error', 'Your Amount go to greather than remaining amount');
            }
        }else{
            return redirect()->back()->with('error', 'You need add your amount atleast 1$');
        }
    } 

    public function PaymentErrorParent($student_id){
        return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again');
    }
    public function PaymentSuccessParent($student_id,Request $request){
        if(!empty($request->item_number) && !empty($request->st) && $request->st == "Completed"){
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fees)){
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();

                return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', 'Your Payment Succesfully');
            }else{
                return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again');
            }
        }else{
            return redirect('parent//my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again');
        }
    }
    public function PaymentSuccessStripeParent($student_id,Request $request){
        $getSetting = SettingModel::getSingle();  
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first(); 
        \Stripe\Stripe::setApiKey($setApiKey);
        $getData = \Stripe\Checkout\Session::retrieve($trans_id);

        if(!empty($getData->id) && $getData->id == $trans_id && !empty($getFee) && $getData->status == 'complete' && $getData->payment_status == 'paid'){
                $getFee->is_payment = 1;
                $getFee->payment_data = json_encode($getData);
                $getFee->save();

                Session::forget('stripe_session_id');

                return redirect('parent/my_student/fees_collection/'.$student_id)->with('success', 'Your Payment Successfully');
        }else{
            return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again');
        }
    }
}
