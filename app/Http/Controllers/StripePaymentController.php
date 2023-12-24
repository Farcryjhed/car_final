<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Car;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('stripe.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        $carId = $request->input('car_id');
        $carName = $request->input('car_name');
        $carRate = $request->input('car_rate');
        $carDate = $request->input('car_date');

        $car = Car::find($carId);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            Stripe\Charge::create([
                'amount' => $carRate * 100,
                'currency' => 'php',
                'source' => $request->stripeToken,
                'description' => "Payment for {$carName}",
            ]);

            $car->status = 'Rented';
            $car->save();

            $rental = new \App\Models\Rental;
            $rental->car_id = $carId;
            $rental->date = $carDate;
            $rental->status = 'Rented';
            $rental->save();

            return back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
