<style>
    .mt-2 {
        margin-top: 10px;
    }
</style>
 
@foreach($products as $product)
    @php
        // Generate unique ID-safe string from product name (plan name)
        $planId = strtolower(preg_replace('/\s+/', '_', $product["product_name"]));

        $brand_price_query = DB::table('companies_product_prices')
            ->where("cid", "=", $id)
            ->where("plan_type", "=", $plan_type)
            ->where("brand_name", "=", $product->product_name)
            ->where("brand_id", "=", $product->id);

        if ($agent_id != 0) {
            $brand_price_query->where("agent_id", "=", $agent_id);
        }

        $brand_price = (array) $brand_price_query->first();
    @endphp

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                   href="#collapseOne_{{ $product["id"] }}">
                    {{ $product["product_name"] }}
                </a>
            </h4>
        </div>

        <div id="collapseOne_{{ $product["id"] }}" class="panel-collapse collapse {{ $brand_price ? 'in' : '' }}">
            <div id="message_product_{{ $product["id"] }}"></div>

            <form method="post" onsubmit="return false" id="product_{{ $product["id"] }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product["id"] }}">
                <input type="hidden" name="company_id" value="{{ $id }}">
                <input type="hidden" name="agent_id" value="{{ $agent_id }}">
                <input type="hidden" name="plan_type" value="{{ $plan_type }}">
                <input type="hidden" name="product_name" value="{{ $product["product_name"] }}">
                <input type="hidden" name="action" id="action_sub" value="{{ $brand_price ? 'update' : 'add' }}">

                <div class="panel-body">
                    @for ($i = 1; $i <= 31; $i++)
                        <div class="col-md-1 mt-2">
                            <label for="{{ $planId }}_p_day_{{ $i }}" class="control-label">Day {{ $i }}</label>
                        </div>
                        <div class="col-md-1 mt-2">
                            <input
                                type="text"
                                style="color:green;"
                                class="form-control"
                                id="{{ $planId }}_p_day_{{ $i }}"
                                name="p_day_{{ $i }}"
                                value="{{ $brand_price['day_' . $i] ?? '0.00' }}"
                            >
                        </div>
                    @endfor

                    <div style="clear: both"></div>
                    <hr/>

                    <div class="row">
                        <div class="col-md-3 mt-2 text-right">
                            <label for="{{ $planId }}_after_30_days" class="control-label">Over 30 Days</label>
                        </div>
                        <div class="col-md-4 mt-2">
                            <input
                                style="color:green;"
                                type="text"
                                class="form-control"
                                id="{{ $planId }}_after_30_days"
                                name="after_30_days"
                                value="{{ $brand_price['after_30_days'] ?? '0.00' }}"
                            >
                        </div>
                    </div>

                    <div class="row mt-3">
                        <button
                            onclick="updateProductPrices('product_{{ $product["id"] }}')"
                            class="btn btn-success pull-right"
                            style="margin-right: 2%;">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach


