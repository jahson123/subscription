<template>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <div class="form-check" id="status">
            <input class="form-check-input" type="radio" :name="data.msisdn" id="active" value="active" v-model="data.status" required checked>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>
        <div class="form-check" id="status">
            <input class="form-check-input" type="radio" :name="data.msisdn" id="inactive" v-model="data.status" required value="inactive">
            <label class="form-check-label" for="inactive">
                Inactive
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="service" class="form-label">Service</label>
        <input type="text" class="form-control" id="service" placeholder="Ex: Astro" v-model="data.service">
    </div>
    <div class="mb-3">
        <label for="msisdn" class="form-label">Charge Price</label> &nbsp;
        <InputNumber v-model="data.charge_price" id="msisdn" mode="decimal" :minFractionDigits="2" :allowEmpty="false" />
    </div>
</template>

<script>
import InputNumber from 'primevue/inputnumber';


export default({
    components: {
        InputNumber
    },
    props: {
        data: {
            type: Object,
            default: {}
        },
    },
})
</script>
