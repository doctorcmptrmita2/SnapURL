<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Handle Stripe webhooks.
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            case 'customer.subscription.created':
            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;

            case 'invoice.payment_succeeded':
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;
        }

        return response()->json(['received' => true]);
    }

    /**
     * Handle checkout session completed.
     */
    private function handleCheckoutSessionCompleted($session)
    {
        $userId = $session->metadata->user_id ?? null;
        $planId = $session->metadata->plan_id ?? null;

        if (!$userId || !$planId) {
            return;
        }

        $user = User::find($userId);
        $plan = Plan::find($planId);

        if (!$user || !$plan) {
            return;
        }

        // Update user plan
        $user->update(['plan_id' => $plan->id]);
    }

    /**
     * Handle subscription updated.
     */
    private function handleSubscriptionUpdated($subscription)
    {
        $user = User::where('stripe_customer_id', $subscription->customer)->first();

        if (!$user) {
            return;
        }

        $plan = Plan::where('stripe_price_id', $subscription->items->data[0]->price->id)->first();

        if (!$plan) {
            return;
        }

        Subscription::updateOrCreate(
            ['stripe_subscription_id' => $subscription->id],
            [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'stripe_customer_id' => $subscription->customer,
                'status' => $subscription->status,
                'trial_ends_at' => $subscription->trial_end ? now()->setTimestamp($subscription->trial_end) : null,
                'ends_at' => $subscription->cancel_at ? now()->setTimestamp($subscription->cancel_at) : null,
            ]
        );

        $user->update(['plan_id' => $plan->id]);
    }

    /**
     * Handle subscription deleted.
     */
    private function handleSubscriptionDeleted($subscription)
    {
        $subscriptionModel = Subscription::where('stripe_subscription_id', $subscription->id)->first();

        if ($subscriptionModel) {
            $subscriptionModel->update([
                'status' => 'canceled',
                'ends_at' => now(),
            ]);

            // Reset user to free plan
            $freePlan = Plan::where('slug', 'free')->first();
            if ($freePlan) {
                $subscriptionModel->user->update(['plan_id' => $freePlan->id]);
            }
        }
    }

    /**
     * Handle invoice payment succeeded.
     */
    private function handleInvoicePaymentSucceeded($invoice)
    {
        // Subscription is active, no action needed
    }

    /**
     * Handle invoice payment failed.
     */
    private function handleInvoicePaymentFailed($invoice)
    {
        $user = User::where('stripe_customer_id', $invoice->customer)->first();

        if ($user) {
            $subscription = $user->activeSubscription;
            if ($subscription) {
                $subscription->update(['status' => 'past_due']);
            }
        }
    }
}
