<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Customer;

class BillingController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Show billing page with plans.
     */
    public function index()
    {
        $plans = Plan::where('is_active', true)
            ->where('price', '>', 0)
            ->orderBy('sort_order')
            ->get();

        $user = auth()->user();
        $activeSubscription = $user->activeSubscription;

        return view('billing.index', compact('plans', 'activeSubscription'));
    }

    /**
     * Create Stripe checkout session.
     */
    public function checkout(Request $request, Plan $plan)
    {
        $user = $request->user();

        // Create or get Stripe customer
        if (!$user->stripe_customer_id) {
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => [
                    'user_id' => $user->id,
                ],
            ]);
            $user->update(['stripe_customer_id' => $customer->id]);
        }

        // Create checkout session
        $session = Session::create([
            'customer' => $user->stripe_customer_id,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $plan->stripe_price_id,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('billing.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('billing.index'),
            'metadata' => [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
            ],
        ]);

        return redirect($session->url);
    }

    /**
     * Handle successful payment.
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if ($sessionId) {
            $session = Session::retrieve($sessionId);
            // Webhook will handle the subscription creation
        }

        return redirect()->route('billing.index')
            ->with('success', 'Subscription activated successfully!');
    }

    /**
     * Cancel subscription.
     */
    public function cancel()
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription;

        if ($subscription && $subscription->stripe_subscription_id) {
            $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_subscription_id);
            $stripeSubscription->cancel();

            $subscription->update([
                'status' => 'canceled',
                'ends_at' => now()->addDays(30), // Grace period
            ]);
        }

        return redirect()->route('billing.index')
            ->with('success', 'Subscription canceled. Access continues until the end of the billing period.');
    }
}
