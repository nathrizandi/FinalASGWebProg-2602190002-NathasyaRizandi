<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required',
            'instagram_username' => 'required',
            'hobbies_field' => 'required|array|min:3',
            'mobile_number' => 'required',
        ]);
        $hobbies = implode(',', (array) $request->input('hobbies_field'));
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'instagram_username' => $validatedData['instagram_username'],
            'hobbies_field' => $hobbies,
            'mobile_number' => $validatedData['mobile_number'],
            'register_price' => rand(100000,125000),
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'The email does not match our database records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function update_paid(Request $request)
{
    $validatedData = $request->validate([
        'payment_amount' => 'required|numeric|min:0',
        'price' => 'required|numeric',
    ]);

    $paymentAmount = $validatedData['payment_amount'];
    $price = $validatedData['price'];
    $difference = $paymentAmount - $price;

    $user = Auth::user();

    if ($difference < 0) {
        return redirect()->back()->with('error', 'Underpaid: $' . number_format(-$difference, 2));
    } elseif ($difference > 0) {
        return redirect()->route('handle.overpayment', [
            'amount' => $difference,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    } else {
        $user->has_paid = true;
        $user->save();
        return redirect()->route('user.index')->with('success', 'Payment Success!');
    }
}

    public function handleOverpayment(Request $request)
    {
        $amount = $request->input('amount');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');

        return view('overpayment', [
            'amount' => $amount,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    }

    public function processOverpayment(Request $request)
    {
        $action = $request->input('action');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');
        $user = Auth::user();

        if ($action === 'accept') {
            $amount = $request->input('amount');
            $user->coins += $amount;
            $user->has_paid = true;
            $user->save();


            return redirect()->route('user.index')->with('success', 'Added to your wallet!');
        } else {
            return redirect()->route('pay')->with('error', 'Please enter the correct amount!');
        }
    }
}
