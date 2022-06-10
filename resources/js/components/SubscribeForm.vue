<template>
    <div class="mb-3">
        <label for="msisdn" class="form-label">Msisdn</label>
        <input type="number" class="form-control" id="msisdn" placeholder="Ex: 12345" v-model="data.msisdn" required>
    </div>
    <div class="mb-3">
        <label for="msisdn" class="form-label">Shortcode</label>
        <select class="form-select" id="msisdn" aria-label="shortcode" v-model="data.shortcode">
            <option value="1111">1111</option>
            <option value="2222">2222</option>
            <option value="3333">3333</option>
            <option value="4444">4444</option>
            <option value="5555">5555</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="keyword" class="form-label">Keyword</label>
        <select class="form-select" id="keyword" aria-label="keyword" v-model="data.keyword">
            <option value="AA">AA</option>
            <option value="BB">BB</option>
            <option value="CC">CC</option>
            <option value="DD">DD</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <div class="form-check" id="status">
            <input class="form-check-input" type="radio" name="status" id="active" value="active" v-model="data.status" checked>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
        <div class="form-check" id="status">
            <input class="form-check-input" type="radio" name="status" id="inactive" v-model="data.status" value="inactive">
            <label class="form-check-label" for="inactive">
                Inactive
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="service" class="form-label">Service</label>
        <input type="text" class="form-control" id="service" placeholder="Ex: Astro" v-model="data.service" required>
    </div>
    <div class="mb-3">
        <label for="msisdn" class="form-label">Charge Price</label> &nbsp;
        <InputNumber v-model="data.charge_price" id="msisdn" mode="decimal" :minFractionDigits="2" :allowEmpty="false" />
    </div>
    <button type="button" class="btn btn-primary" @click="createSubscribe()">Submit</button>
</template>

<script>
import InputNumber from 'primevue/inputnumber';

export default ({
    components: {
        InputNumber
    },
    props: {
        data: {
            type: Object,
            default: {}
        },
        createSubscribe: Function,
    },
})
</script>
