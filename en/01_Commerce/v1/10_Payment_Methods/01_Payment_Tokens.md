Payment Tokens let Commerce store a reference to a customer’s payment method at the payment provider, so the same customer can pay again without re-entering card or bank details. Typical uses include subscription renewals, membership rebills, and optional “save my card for next time” on regular checkout.

Commerce stores **gateway references** (customer ID, mandate ID, payment method ID, etc.) in the `comPaymentToken` object. Sensitive card or bank data never touches your MODX database.

## 1. Storefront and configuration

### Supported gateways

| Gateway | Status        | Notes                                                                                                                              |
|---------|---------------|------------------------------------------------------------------------------------------------------------------------------------|
| **Mollie** | Fully enabled | Implements `PaymentTokenGatewayInterface`. Uses Mollie Customers and Mandates (`sequenceType: first` / `recurring`).               |
| **Stripe** | Coming soon   | We've been working on Stripe support but did not want to delay the initial 1.11 release more until this was complete. Coming soon! |

Only gateways that implement `PaymentTokenGatewayInterface` participate in the checkout UI and automatic token storage. Other gateways continue to work for one-off payments only.

Third-party or custom gateways can add support by implementing the same interface (see [section 2](#2-technical-implementation)).

### How it works at checkout

1. **Logged-in customers** may see a **Saved Payment Methods** list at the top of the payment step (if they have active tokens for available payment methods).
2. Below that, **New Payment Methods** lists the normal gateway options.
3. For gateways that support token storage, an optional **Save payment method for future use** checkbox appears (unless the cart forces storage—see below).
4. On submit:
- Choosing a **saved token** charges off-session via `chargeStoredPaymentToken()`.
- Choosing a **new method** runs the usual `submit()` flow; after a successful payment, Commerce may call `storePaymentToken()` depending on cart and consent.

**Guests** cannot save or reuse payment tokens. The saved-methods block and save checkbox only appear when a `user` is set on the order.

### Products that require a stored payment method

Product types can declare that checkout **must** use a gateway that supports tokens and that a token **must** be stored after the first successful payment through the new `requirePaymentToken()` method on `comProduct`.

In the core, this is hardcoded to false, however custom product types can turn this on.

```php
protected $requirePaymentToken = true;

public function requirePaymentToken(): bool
{
return (bool)$this->requirePaymentToken;
}
```

When any line item’s product indicates it requires a PaymentToken:

- Only payment methods whose gateway implements `PaymentTokenGatewayInterface` are shown.
- The “save payment method” checkbox is **hidden** (storage is mandatory).
- After payment succeeds, Commerce **always** stores a token (checkout return, immediate success, and webhooks).

This is for subscriptions, recurring donations, or any product that will be charged again later.

For ordinary one-off orders, storage is **opt-in** via the checkbox.

### Default checkout template

The default payment step template is `core/components/commerce/templates/default/frontend/checkout/payment-method.twig`. Copy the relevant blocks into your theme if you override checkout templates.

#### Form and saved payment methods

```twig
<form method="POST" action="{{ current_url }}" class="c-choose-payment-form" id="c-choose-payment-form">
    <input type="hidden" name="choose_payment_method" value="0">

    {% if user and stored_payment_tokens|length > 0 %}
    <h3>{{ lex('commerce.checkout_saved_payment_methods') }}</h3>
    {% for token in stored_payment_tokens %}
    <div class="c-method-wrapper c-payment-token-wrapper">
        <input  type="radio"
                name="choose_payment_method"
                class="c-method-radio c-payment-token-radio"
                id="payment-token-{{ token.id }}"
                value="token/{{ token.payment_method.id }}/{{ token.id }}"
                {% if loop.first %}checked="checked"{% endif %}
        >
        <div class="c-method-section c-payment-token-section">
            <label for="payment-token-{{ token.id }}" tabindex="0">
                {{ token.payment_method.name }} - {{ token.description }}
                {# optional fee display #}
            </label>
        </div>
    </div>
    {% endfor %}
    <h3>{{ lex('commerce.checkout_new_payment_methods') }}</h3>
    {% endif %}
```

**Important:** Saved tokens are submitted as `choose_payment_method` with a `value` of `token/{payment_method_id}/{token_id}`. This way users have to pick either a payment method OR a token, not both.

The payment step parses this and calls `setPaymentToken($tokenId)` when a token is used.

#### New payment methods and optional save checkbox

```twig
    {% for method in payment_methods %}
    <div class="c-method-wrapper c-payment-method-wrapper">
        <input  type="radio"
                name="choose_payment_method"
                class="c-method-radio c-payment-method-radio"
                id="payment-method-{{ method.id }}"
                value="{{ method.id }}"
                {% if not user or stored_payment_tokens|length == 0 %}
                {% if loop.first %}checked="checked"{% endif %}
                {% endif %}
        >
        {# method label, description, gateway_form ... #}

        {% if method.gateway_form|length > 0 or (user and not requires_payment_token and method.supports_token_storage) %}
        <div class="c-method-gateway-form c-payment-method-gateway-form">
            {% autoescape false %}
            {{ method.gateway_form }}
            {% endautoescape %}

{# v v new code starts here v v #}
            {% if user and not requires_payment_token and method.supports_token_storage %}
            <div class="c-save-payment-method-wrapper">
                <label>
                    <input type="checkbox"
                           name="payment_method[{{ method.id }}][save_payment_method]"
                           value="1"
                           id="save-payment-method-{{ method.id }}">
                    {{ lex('commerce.checkout_save_payment_method') }}
                    <span>{{ lex('commerce.checkout_save_payment_method.desc') }}</span>
                </label>
            </div>
            {% endif %}
{# ^ ^ new code ends here ^ ^ #}
        </div>
        {% endif %}
    </div>
    {% endfor %}
</form>
```

#### Template placeholders

| Placeholder | Description                                                                                   |
|-------------|-----------------------------------------------------------------------------------------------|
| `user` | MODX user for the order (or empty for guests). Tokens are only available for logged-in users. |
| `stored_payment_tokens` | Active tokens for this user, filtered to methods/gateways available for the current order.    |
| `requires_payment_token` | `true` if any cart product requires token storage.                                            |
| `payment_methods[]` | Each method includes `supports_token_storage` (boolean), `gateway_form`, pricing, etc.        |

New lexicon keys used in the default template include `commerce.checkout_saved_payment_methods`, `commerce.checkout_new_payment_methods`, `commerce.checkout_save_payment_method`, and `commerce.checkout_save_payment_method.desc`.

### Stripe Payment Element (redirect return URL)

If you've customised the stripe_paymentelement.twig template, you will need to review that against the default once we re-enable the Stripe support for this feature in an upcoming release candidate. Various changes were necessary for this to work correctly.

### Manager: customer payment tokens

In Commerce’s customer admin (with the Customers module enabled), **Payment Tokens** lists stored methods per user. Managers can:

- Set a token as default
- Activate / deactivate (without deleting at the gateway)
- Delete (runs gateway `deletePaymentToken()` when implemented)

Customers manage tokens through checkout usage; there is no separate storefront “wallet” page in core beyond the payment step for the moment.

### Key things to keep in mind

1. **Login required** — Saving and reusing tokens is tied to `modUser`. Use checkout steps that require login when you depend on tokens.
2. **Gateway capability** — `supports_token_storage` in templates comes from `instanceof PaymentTokenGatewayInterface`. Do not show save UI for gateways that do not implement it.
3. **Mandatory vs optional storage** — `requires_payment_token` on products forces storage and restricts gateways; the save checkbox is only for optional storage on normal products.
4. **Payment method availability** — Saved tokens are only listed if their `comPaymentMethod` is still available for the order (availability rules, conditional gateways, etc.).
5. **Mollie method filtering** — For carts that require tokens, Mollie limits methods to those that support `sequenceType: first` (cached from the Mollie API). Methods that cannot create mandates are hidden.
6. **Off-session charges** — Repeat charges use provider APIs (Mollie `sequenceType: recurring`, Stripe `off_session` PaymentIntents). Failures (expired card, revoked mandate) surface as normal failed transactions; handle them in your renewal/subscription logic.
7. **Webhooks and redirects** — Token storage runs after successful payment in the payment step **and** in the webhook handler, so async confirmations still persist tokens when appropriate.wd s
8. **Events** — various events were added for module integrations.
9. **PCI scope** — You store opaque IDs and descriptions only.

---

## 2. Technical implementation

### Data model

**`comPaymentToken`** (`commerce_payment_token`):

| Field | Purpose |
|-------|---------|
| `user` | MODX user ID |
| `payment_method` | `comPaymentMethod` used when the token was created |
| `gateway_token` | Provider-side reusable ID (e.g. Mollie mandate ID, Stripe `pm_…`) |
| `gateway_customer_id` | Provider customer ID (e.g. Mollie `cst_…`, Stripe `cus_…`) |
| `type` | Method type slug (`card`, `directdebit`, `creditcard`, …) |
| `description` | Human-readable label shown in checkout/admin |
| `is_default` | Default token for the user (per payment method when first created) |
| `active` | Soft enable/disable |
| `created_on` / `last_used_on` | Timestamps |

**`comTransaction`** links to a token via `payment_method_token` and sets `is_recurring` when charging a stored token.

### Interfaces

**`PaymentTokenInterface`** — Ephemeral object returned by a gateway when extracting credentials from a completed payment:

- `getGatewayToken()` — ID used for subsequent charges
- `getGatewayCustomerId()` — Customer ID at the provider (nullable)
- `getType()` — Type string stored on `comPaymentToken`
- `getDescription()` — Display string

Implementations: `MolliePaymentToken`, `StripePaymentToken`.

**`PaymentTokenGatewayInterface`** — Opt-in gateway capability (same pattern as `WebhookGatewayInterface`):

```php
public function storePaymentToken(comTransaction $transaction): ?comPaymentToken;
public function chargeStoredPaymentToken(comTransaction $transaction, comPaymentToken $token): TransactionInterface;
public function updatePaymentToken(comPaymentToken $token, array $data): bool;
public function deletePaymentToken(comPaymentToken $token): bool;
```

### `PaymentTokenHelper`

`modmore\Commerce\Gateways\Helpers\PaymentTokenHelper::saveToken()` centralizes persistence:

- Requires an order with a logged-in user
- Upserts by `(user, payment_method, gateway_customer_id, gateway_token)`
- Sets first token per user/method as default
- Links `comTransaction.payment_method_token`
- Dispatches `commerce.payment_token.stored`

Gateways should build a `PaymentTokenInterface` from the completed payment, then delegate saving to the helper.

### Checkout flow (`Payment` step)

| Step | Behavior |
|------|----------|
| `getPaymentMethods()` | Sets `supports_token_storage`; hides methods without `PaymentTokenGatewayInterface` when `hasProductsRequiringPaymentToken()`. |
| `getStoredPaymentTokens()` | Loads active tokens for the user; skips methods/gateways unavailable for the order. |
| `setPaymentMethod()` | Sets transaction property `save_payment_method` from `payment_method[{id}][save_payment_method]`. |
| `setPaymentToken()` | Initiates transaction, calls `chargeStoredPaymentToken()`, updates `last_used_on`. |
| `handleResult()` / `checkTransaction()` | After `isPaid()`, calls `storePaymentToken()` when required product or opt-in consent is present. |

Consent for storage is true when:

- Any product has `requirePaymentToken() === true`, **or**
- `save_payment_method` is in submitted data **or** stored as a transaction property (redirect/webhook).

### Webhook handler

`modmore\Commerce\Webhook\Handler` mirrors the same rules when a webhook marks a transaction completed (including a second attempt if the transaction was already completed but the token was not saved yet).

### Adding support to a custom gateway

1. **Implement `PaymentTokenGatewayInterface`** on your gateway class (in addition to `GatewayInterface` / webhooks as needed).

2. **Create a `PaymentTokenInterface` implementation** that maps your provider’s IDs and a display description.

3. **`storePaymentToken(comTransaction $transaction)`**
- Load the completed payment at the provider using `$transaction->get('reference')`.
- Verify status is successful and that the payment was created in “save for reuse” mode (provider-specific).
- Extract customer + reusable payment identifier.
- Return `PaymentTokenHelper::saveToken($commerce, $this->method, $transaction, $yourToken)`.

4. **`chargeStoredPaymentToken(comTransaction $transaction, comPaymentToken $token)`**
- Read `gateway_token` and `gateway_customer_id` from `$token`.
- Create an off-session / recurring charge for `$transaction->get('amount')`.
- Set `$transaction->reference`, `$transaction->is_recurring = true`, log, return a `TransactionInterface` implementation your gateway already uses.

5. **`deletePaymentToken` / `updatePaymentToken`**
- Call provider APIs to revoke or update; return boolean success.
- Admin delete in Commerce should call `deletePaymentToken()` before removing the row (extend admin delete if you add custom UI).

6. **Initial payment (`submit`)** — When the cart requires a token or the user opted in, configure the provider’s “first” or “setup” flow so `storePaymentToken()` can extract credentials after success (Mollie: `sequenceType: first` + customer; Stripe: customer on Intent + `setup_future_usage`).

7. **`view()` / frontend** — Render any extra fields; for optional save, rely on the default checkbox name `payment_method[{methodId}][save_payment_method]` or document custom names and map them in `setPaymentMethod()`.

8. **Test**
- First checkout stores token (required product + opt-in).
- Second checkout with `choose_payment_method = token/{methodId}/{tokenId}` charges without redirect (or with provider-specific async flow). This checks the token belongs to the logged in user.
- Webhook-only completion still stores token when `save_payment_method` property is set.
- Invalid/expired token fails gracefully on renewal.

### Events

| Constant | When |
|----------|------|
| `Commerce::EVENT_PAYMENT_TOKEN_STORED` | After new token saved via helper |
| `Commerce::EVENT_PAYMENT_TOKEN_UPDATED` | Reserved for updates |
| `Commerce::EVENT_PAYMENT_TOKEN_DELETED` | Reserved for deletions |

Event object: `modmore\Commerce\Events\PaymentToken` — `getToken()` returns `comPaymentToken`.

## Related files

| Area | Path |
|------|------|
| Payment step | `core/components/commerce/src/Frontend/Steps/Payment.php` |
| Default template | `core/components/commerce/templates/default/frontend/checkout/payment-method.twig` |
| Interfaces | `core/components/commerce/src/Gateways/Interfaces/PaymentTokenGatewayInterface.php`, `PaymentTokenInterface.php` |
| Helper | `core/components/commerce/src/Gateways/Helpers/PaymentTokenHelper.php` |
| Mollie gateway | `core/components/commerce/src/Gateways/Mollie.php` |
| Stripe gateway | `core/components/commerce/src/Gateways/Stripe.php` |
| Webhooks | `core/components/commerce/src/Webhook/Handler.php` |
| Schema | `core/components/commerce/model/schema/commerce.mysql.schema.xml` (`comPaymentToken`) |
| Admin grid | `core/components/commerce/src/Admin/Modules/Customers/PaymentTokensGrid.php` |
